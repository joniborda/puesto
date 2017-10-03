<?php
App::uses('AppModel', 'Model');
/**
 * Usuario Model
 *
 * @property RuvGroup $RuvGroup
 */
class Usuario extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'usuarios';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'usuario';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'usuario_login';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'usuario_login';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Grupo' => array(
			'className' => 'Grupo',
			'joinTable' => 'usuario_grupo',
			'foreignKey' => 'usuario',
			'associationForeignKey' => 'grupo',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

public $actsAs = array('Search.Searchable', 'Containable');

	/**
	 * Criteria for search
	 *
	 * @var string
	 */
	public $filterArgs = array(
		'busqueda_general' => array('type' => 'query', 'method' => 'searchbusqueda_general', 'encode' => true),
		'nombre_completo' => array('type' => 'expression', 'method' => 'searchNombre', 'field' => 'LOWER("Usuario"."nombre_completo"::text) SIMILAR TO (?)', 'encode' => true),
		'usuario_login' => array('type' => 'expression', 'method' => 'searchUsuario_login', 'field' => 'LOWER("Usuario"."usuario_login"::text) SIMILAR TO (?)', 'encode' => true),
		'borrado' => array('type' => 'expression', 'method' => 'searchBorrado', 'field' => 'LOWER("Usuario"."borrado"::text) SIMILAR TO (?)', 'encode' => true),
		'modified' => array('type' => 'subquery', 'method' => 'searchModified', 'field' => '"Usuario"."modified"', 'encode' => true),
		'modified_desde' => array('type' => 'subquery', 'method' => 'searchModified_entre', 'field' => '"Usuario"."id"', 'encode' => true),
		'modified_hasta' => array('type' => 'expression', 'method' => null, 'field' => 'true', 'encode' => true),
		'created' => array('type' => 'subquery', 'method' => 'searchCreated', 'field' => '"Usuario"."created"', 'encode' => true),
		'created_desde' => array('type' => 'subquery', 'method' => 'searchCreated_entre', 'field' => '"Usuario"."id"', 'encode' => true),
		'created_hasta' => array('type' => 'expression', 'method' => null, 'field' => 'true', 'encode' => true),
		'contrasenia' => array('type' => 'expression', 'method' => 'searchContrasenia', 'field' => 'LOWER("Usuario"."contrasenia"::text) SIMILAR TO (?)', 'encode' => true),
	);

	public function searchNombre($data = array()) {
		$data['nombre_completo'] = str_replace(',', '%|%', $data['nombre_completo']);

		if (substr($data['nombre_completo'], strlen($data['nombre_completo'])-1, 1) === '%|%') {
			$data['nombre_completo'] = substr($data['nombre_completo'], 0, strlen($data['nombre_completo'])-1);
		}
		return '%' . $data['nombre_completo'] . '%';
	}

	public function searchUsuario_login($data = array()) {
		$data['usuario_login'] = str_replace(',', '%|%', $data['usuario_login']);

		if (substr($data['usuario_login'], strlen($data['usuario_login'])-1, 1) === '%|%') {
			$data['usuario_login'] = substr($data['usuario_login'], 0, strlen($data['usuario_login'])-1);
		}
		return '%' . $data['usuario_login'] . '%';
	}

	public function searchBorrado($data = array()) {
		$data['borrado'] = str_replace(',', '%|%', $data['borrado']);

		if (substr($data['borrado'], strlen($data['borrado'])-1, 1) === '%|%') {
			$data['borrado'] = substr($data['borrado'], 0, strlen($data['borrado'])-1);
		}
		return '%' . $data['borrado'] . '%';
	}

	public function searchModified($data = array()) {
		
		$ret = '';
		$comma = false;
		foreach (split(',', $data['modified']) as $value) {
			$fecha = DateTime::createFromFormat('d/m/Y', $value);
			if ($fecha) {

				if ($comma === true) {
					$ret .= ',';
				}

				$ret .= "'" . $fecha->format('Y-m-d') . "'";

				$comma = true;
			}
		}

		return $ret;
	}

	public function searchModified_entre($data = array()) {
	
		$fecha_desde_array = array();
		$fecha_hasta_array = array();
		if (isset($data['modified_desde']) && isset($data['modified_hasta'])) {

			$data['modified_desde'] = str_replace(',,', '', $data['modified_desde']);
			$data['modified_hasta'] = str_replace(',,', '', $data['modified_hasta']);

			foreach (split(',', $data['modified_desde']) as $value) {
				$fecha = DateTime::createFromFormat('d/m/Y', $value);
				if ($fecha) {
					$fecha_desde_array[] = $fecha->format('Y-m-d');
				} else {
					return;
				}
			}

			foreach (split(',', $data['modified_hasta']) as $value) {
				$fecha = DateTime::createFromFormat('d/m/Y', $value);
				if ($fecha) {
					$fecha_hasta_array[] = $fecha->format('Y-m-d');
				} else {
					return;
				}
			}
			$or = array();
			foreach ($fecha_desde_array as $key => $fecha) {
				$or[] = '"' . $this->name . '"."modified" >= \'' . $fecha . '\'' . ' AND modified <= \'' . $fecha_hasta_array[$key] . '\'';

			}
			return $this->getQuery('all', array(
				'conditions' => array(
					'OR' => $or
				),
				'fields' => array($this->primaryKey),
				'recursive' => -1
			));
		}
	}
	public function searchCreated($data = array()) {
		
		$ret = '';
		$comma = false;
		foreach (split(',', $data['created']) as $value) {
			$fecha = DateTime::createFromFormat('d/m/Y', $value);
			if ($fecha) {

				if ($comma === true) {
					$ret .= ',';
				}

				$ret .= "'" . $fecha->format('Y-m-d') . "'";

				$comma = true;
			}
		}

		return $ret;
	}

	public function searchCreated_entre($data = array()) {
	
		$fecha_desde_array = array();
		$fecha_hasta_array = array();
		if (isset($data['created_desde']) && isset($data['created_hasta'])) {

			$data['created_desde'] = str_replace(',,', '', $data['created_desde']);
			$data['created_hasta'] = str_replace(',,', '', $data['created_hasta']);

			foreach (split(',', $data['created_desde']) as $value) {
				$fecha = DateTime::createFromFormat('d/m/Y', $value);
				if ($fecha) {
					$fecha_desde_array[] = $fecha->format('Y-m-d');
				} else {
					return;
				}
			}

			foreach (split(',', $data['created_hasta']) as $value) {
				$fecha = DateTime::createFromFormat('d/m/Y', $value);
				if ($fecha) {
					$fecha_hasta_array[] = $fecha->format('Y-m-d');
				} else {
					return;
				}
			}
			$or = array();
			foreach ($fecha_desde_array as $key => $fecha) {
				$or[] = '"' . $this->name . '"."created" >= \'' . $fecha . '\'' . ' AND created <= \'' . $fecha_hasta_array[$key] . '\'';

			}
			return $this->getQuery('all', array(
				'conditions' => array(
					'OR' => $or
				),
				'fields' => array($this->primaryKey),
				'recursive' => -1
			));
		}
	}

	public function searchContrasenia($data = array()) {
		$data['contrasenia'] = str_replace(',', '%|%', $data['contrasenia']);

		if (substr($data['contrasenia'], strlen($data['contrasenia'])-1, 1) === '%|%') {
			$data['contrasenia'] = substr($data['contrasenia'], 0, strlen($data['contrasenia'])-1);
		}
		return '%' . $data['contrasenia'] . '%';
	}

	public function searchbusqueda_general($data = array()) {
		$data['busqueda_general'] = pg_escape_string($data['busqueda_general']);
		$query = '
		 Usuario.nombre_completo::text ILIKE \'%' . $data['busqueda_general'] . '%\'
 		OR 
		 Usuario.usuario_login::text ILIKE \'%' . $data['busqueda_general'] . '%\'
 		OR 
		 Usuario.borrado::text ILIKE \'%' . $data['busqueda_general'] . '%\'
		OR 
		 Usuario.modified::text ILIKE \'%' . $data['busqueda_general'] . '%\'
 		OR 
		 Usuario.created::text ILIKE \'%' . $data['busqueda_general'] . '%\'
 		OR 
		 Usuario.contrasenia::text ILIKE \'%' . $data['busqueda_general'] . '%\'
		';
		return $query;
	}

	
public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['contrasenia'])) {
		$this->data[$this->alias]['contrasenia'] = AuthComponent::password($this->data[$this->alias]['contrasenia']);
	}
	return true;
}

	public function getUsuarioLoginById($id, $model = 'Usuario') {
		$ret = $this->find(
			'first', 
			array(
				'conditions' => array(
					$model . '.id' => $id
				),
				'recursive' => -1,
				'fields' => 'usuario_login'
			)
		);
		
		if ($ret) {
			return $ret[$model]['usuario_login'];
		}
	}

	public function getNombreCompletoById($id, $model = 'Usuario') {
		
		$ret = $this->find(
			'first',
			array(
				'conditions' => array(
						$model . '.id' => $id
				),
				'recursive' => -1,
				'fields' => 'nombre_completo'
			)
		);
		if ($ret) {
			return $ret[$model]['nombre_completo'];
		}
	}
	
	public function getAllByGroup($grupo = null) {
		if (!is_string($grupo)) {
			return;
		}
		
		return $this->find('list', array(
			'joins' => array(
				array(
					'table' => 'usuarios.usuario_grupo',
					'alias' => 'UsuarioGrupo',
					'type' => 'INNER',
					'conditions' => array(
						'UsuarioGrupo.usuario = Usuario.usuario_login'
					)
				),
				array(
					'table' => 'usuarios.grupo',
					'alias' => 'Grupo',
					'type' => 'INNER',
					'conditions' => array(
						'Grupo.descripcion = UsuarioGrupo.grupo'
					)
				),
					
			),
			'conditions' => array(
				'Grupo.descripcion' => $grupo
			),
			'fields' => array('Usuario.usuario_login', 'Usuario.nombre_completo'),
			'order' => 'Usuario.nombre_completo asc nulls first'
		));
	}
}