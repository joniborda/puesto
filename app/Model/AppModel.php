<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	/**
	 * Desde el campo pasado como string busco la provincia, departamento, localidad
	 * 
	 * @param String $field
	 * @return string
	 */
	protected function __search_ubicacion($field) {
		$split = split(',',$field);
		
		$query = 'SELECT l.cod_loc ' .
				'FROM unificado.provincias AS p '.
				'LEFT JOIN unificado.departamentos_g AS d ON d.cod_prov = p.cod_pcia_relacion ' .
				'LEFT JOIN unificado.localidades AS l ON d.cod_depto = l.cod_dpto ' .
				'WHERE l.cod_dpto NOT IN(2008,2011,2013,2012,2003,2015,2014,2002,2007,2018,2017,2016,2010,2009,2001,2004,2021,2006,2020,2019,2005) ' .
				'AND (';
		switch (count($split)) {
			case 3:
				$query .= 'CONCAT(trim(descripcion), \', \', TRIM(nom_depto), \', \', TRIM(nom_loc)) ILIKE \'%' . pg_escape_string ( trim($field) ) . '%\' ';
				break;
			case 2:
				// provincia, departamento
				$query .= '(TRIM(nom_depto)		 	ILIKE \'%' . pg_escape_string (trim( $split[1]) ) . '%\' ' .
						'AND TRIM(descripcion) 		ILIKE \'%' . pg_escape_string ( trim($split[0]) ) . '%\' )' .
						// departamento, localidad
				'OR (TRIM(nom_loc)		 	ILIKE \'%' . pg_escape_string (trim( $split[1]) ) . '%\' ' .
				'AND TRIM(nom_depto) 		ILIKE \'%' . pg_escape_string ( trim($split[0]) ) . '%\' )'.
				// provincia, localidad
				'OR (TRIM(nom_loc)		 	ILIKE \'%' . pg_escape_string (trim( $split[1]) ) . '%\' ' .
				'AND TRIM(descripcion) 		ILIKE \'%' . pg_escape_string ( trim($split[0]) ) . '%\' )';
				break;
			case 1:
				// solo por provincia
				$query .= 'TRIM(descripcion) 		ILIKE \'%' . pg_escape_string (trim( $split[0]) ) . '%\' ';
		}
		$query .= ')';
		
		return $query;
	}

	public function getByid($id) {
		return $this->find(
			'first',
			array(
				'conditions' => array(
					$this->name . '.' . $this->primaryKey => $id
				)
			)
		);
	}

	public function validarAnio($campo){

		$num = strlen($campo);

		if ($num<4 || $num>4) 
			return false;
		
		else
			return true;

	}

	public 	function solo_letras($cadena){ 
		$permitidos = "áéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOP QRSTUVWXYZ "; 

		for ($i=0; $i<strlen($cadena); $i++){ 
			if (strpos($permitidos, substr($cadena,$i,1))===false){ 
				//no es válido; 
				return false; 
			} 
		}  
		//si estoy aqui es que todos los caracteres son validos 
		return true; 
	}  


	public function validarInteger(&$campo)
	{
		// si tiene cualquier cosa menos un menos(-) delante y cualquier no digito.
		if (preg_match('/^[^-]\D/', $campo)) {
			return false;
		}
		
		$campo = (int)$campo;

		if ($campo >= -2147483648 && $campo <= 2147483647) {
			return true;
		}
		return false;
	}

	public function validarDNI($documento = null) {
		$documento = (int)$documento;
		if (
			strlen($documento) < 6 ||
			strlen($documento) > 8
		) {
			return false;

		}
		return true;
	}

	public function validarBigint($campo)
	{
		// si tiene cualquier cosa menos un menos(-) delante y cualquier no digito.
		if (preg_match('/^[^-]\D/', $campo)) {
			return false;
		}

		// ojo porque con un float no funciona, tiene que ser string
		if ($campo >= "-9223372036854775808" && $campo <= "9223372036854775807") {
			return true;
		}
		return false;
	}

	public function validarTime($campo)
	{
		if (preg_match("/(2[0-3]|[01][0-9]|10):([0-5][0-9])/", $campo)) {
			return true;
		}
		return false;
	}

	public function validarDate($campo)
	{
		$arr = explode('/', $campo);
		if (count($arr) < 3) {
			return false;
		}

		return checkdate($arr[1], $arr[0], $arr[2]);
	}

	public function validarMail($campo) {
		if (!filter_var($campo, FILTER_VALIDATE_EMAIL)) {
		  return false;
		}
		return true;
	}

	/**
	*	Returna si $campo1 es mayor a $campo2
	*
	*/
	public function compararFecha($campo1, $campo2) {
		$fecha1 = DateTime::createFromFormat('d/m/Y', $campo1);
		
		if (!$fecha1) {
			return false;
		}

		$fecha2 = DateTime::createFromFormat('d/m/Y', $campo2);
		
		if (!$fecha2) {
			return false;
		}

		return $fecha1 > $fecha2;
	}

	/**
	*	Returna si el campo1 es mayor al campo2
	*
	*/
	public function compararTiempo($campo1, $campo2)
	{
		if (!$this->validarTime($campo1) || !$this->validarTime($campo2)) {
			return false;
		}

		$split_campo1 = explode(':', $campo1);
		$split_campo2 = explode(':', $campo2);
		if ($split_campo1[0] > $split_campo2[0]) {
			return true;
		} elseif ($split_campo1[0] == $split_campo2[0]) {
			if ($split_campo1[1] > $split_campo2[1]) {
				return true;
			}
		}

		return false;
	}
}
