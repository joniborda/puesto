<?php
App::uses('AppModel', 'Model');
/**
 * UsuariosGrupo Model
 *
 * @property Usuario $Usuario
 * @property Grupo $Grupo
 */
class UsuariosGrupo extends AppModel {

	public $useDbConfig = 'usuarios';

	public $useTable = 'usuario_grupo';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'usuario';


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
		),
		'Grupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'grupo',
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
			'id' => array('type' => 'expression', 'method' => 'searchId', 'field' => '"UsuariosGrupo"."id"::text ILIKE ?', 'encode' => true),
			'usuario' => array('type' => 'expression', 'method' => 'searchUsuario', 'field' => '"UsuariosGrupo"."usuario"::text ILIKE ?', 'encode' => true),
			'grupo' => array('type' => 'expression', 'method' => 'searchGrupo', 'field' => '"UsuariosGrupo"."grupo"::text ILIKE ?', 'encode' => true),
		);

	public function searchId($data = array()) {
		return '%' . $data['id'] . '%';
}
	public function searchUsuario($data = array()) {
		return '%' . $data['usuario'] . '%';
}
	public function searchGrupo($data = array()) {
		return '%' . $data['grupo'] . '%';
}
}
