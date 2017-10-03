<?php
App::uses('AppModel', 'Model');
/**
 * GrupoUrl Model
 *
 * @property Grupo $Grupo
 * @property Url $Url
 */
class GruposUrl extends AppModel {

	public $useDbConfig = 'usuarios';

	public $useTable = 'grupo_url';

	public $displayField = 'descripcion';
	
	public $primaryKey = 'descripcion';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Grupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'grupo',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Url' => array(
			'className' => 'Url',
			'foreignKey' => 'url_id',
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
		'id' => array('type' => 'expression', 'method' => 'searchId', 'field' => '"GrupoUrl"."id"::text ILIKE ?', 'encode' => true),
		'grupo' => array('type' => 'subquery', 'method' => 'searchGrupo_id', 'field' => '"GrupoUrl"."grupo"', 'encode' => true),
		'url_id' => array('type' => 'subquery', 'method' => 'searchUrl_id', 'field' => '"GrupoUrl"."url_id"', 'encode' => true),
	);

	public function searchId($data = array()) {
		return '%' . $data['id'] . '%';
	}
	public function searchGrupo_id($data = array()) {
		$query = $this->Grupo->getQuery('all', array(
			'conditions' => array(
				$this->Grupo->name . '.' . $this->Grupo->displayField . ' ilike ?' 
					=> '%'.$data['grupo'] .'%'
			),
			'fields' => array($this->Grupo->primaryKey)
		));
		return $query;
				return '%' . $data['grupo'] . '%';
	}
	public function searchUrl_id($data = array()) {
		$query = $this->Url->getQuery('all', array(
			'conditions' => array(
				$this->Url->name . '.' . $this->Url->displayField . ' ilike ?' 
					=> '%'.$data['url_id'] .'%'
			),
			'fields' => array($this->Url->primaryKey)
		));
		return $query;
				return '%' . $data['url_id'] . '%';
	}
}