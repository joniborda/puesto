<?php
App::uses('AppModel', 'Model');
/**
 * Grupo Model
 *
 * @property Url $Url
 */
class Grupo extends AppModel {
	
	public $useDbConfig = 'usuarios';

	public $useTable = 'grupo';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'descripcion';
	
	public $primaryKey = 'descripcion';


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Url' => array(
			'className' => 'Url',
			'joinTable' => 'grupo_url',
			'foreignKey' => 'grupo',
			'associationForeignKey' => 'url_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
	);
	public $hasMany = array(
		'UsuariosGrupo' => array(
			'className' => 'UsuariosGrupo',
			'foreignKey' => 'grupo',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);



public $actsAs = array('Search.Searchable', 'Containable');

	/**
	 * Criteria for search
	 *
	 * @var string
	 */
	public $filterArgs = array(
		'busqueda_general' => array('type' => 'expression', 'method' => 'searchGeneral', 'field' => '"Grupo"."descripcion"::text ILIKE ?', 'encode' => true),
		'descripcion' => array('type' => 'expression', 'method' => 'searchDescripcion', 'field' => '"Grupo"."descripcion"::text ILIKE ?', 'encode' => true),
	);

	public function searchDescripcion($data = array()) {
		return '%' . $data['descripcion'] . '%';
	}
	public function searchGeneral($data = array()) {
		return '%' . $data['busqueda_general'] . '%';
	}
}