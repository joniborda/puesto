<?php
App::uses('AppModel', 'Model');
/**
 * Historial Model
 *
 * @property Usuario $Usuario
 */
class Historial extends AppModel {

	public $useDbConfig = 'usuarios';

	public $useTable = 'historial';
	
	public $order = 'id desc';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


public $actsAs = array('Search.Searchable');

	/**
	 * Criteria for search
	 *
	 * @var string
	 */
	public $filterArgs = array(
			'id' => array('type' => 'expression', 'method' => 'searchId', 'field' => '"Historial"."id"::text ILIKE ?', 'encode' => true),
			'usuario_id' => array('type' => 'expression', 'method' => 'searchUsuario_id', 'field' => '"Historial"."usuario_id"::text ILIKE ?', 'encode' => true),
			'url' => array('type' => 'expression', 'method' => 'searchUrl', 'field' => '"Historial"."url"::text ILIKE ?', 'encode' => true),
			'parametros' => array('type' => 'expression', 'method' => 'searchParametros', 'field' => '"Historial"."parametros"::text ILIKE ?', 'encode' => true),
			'navegador' => array('type' => 'expression', 'method' => 'searchNavegador', 'field' => '"Historial"."navegador"::text ILIKE ?', 'encode' => true),
			'ip' => array('type' => 'expression', 'method' => 'searchIp', 'field' => '"Historial"."ip"::text ILIKE ?', 'encode' => true),
			'fecha' => array('type' => 'expression', 'method' => 'searchFecha', 'field' => '"Historial"."fecha"::text ILIKE ?', 'encode' => true),
		);

	public function searchId($data = array()) {
			return '%' . $data['id'] . '%';
}
	public function searchUsuario_id($data = array()) {
			return '%' . $data['usuario_id'] . '%';
}
	public function searchUrl($data = array()) {
			return '%' . $data['url'] . '%';
}
	public function searchParametros($data = array()) {
			return '%' . $data['parametros'] . '%';
}
	public function searchNavegador($data = array()) {
			return '%' . $data['navegador'] . '%';
}
	public function searchIp($data = array()) {
			return '%' . $data['ip'] . '%';
}
	public function searchFecha($data = array()) {
			$fecha = DateTime::createFromFormat('d/m/Y',$data['fecha']);
		if ($fecha) {
			return $fecha->format('Y-m-d');
		}
			return '%' . $data['fecha'] . '%';
}
}
