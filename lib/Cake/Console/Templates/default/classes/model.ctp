<?php
/**
 * Model template file.
 *
 * Used by bake to create new Model files.
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
 * @package       Cake.Console.Templates.default.classes
 * @since         CakePHP(tm) v 1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

echo "<?php\n";
echo "App::uses('{$plugin}AppModel', '{$pluginPath}Model');\n";
?>
/**
 * <?php echo $name ?> Model
 *
<?php
foreach (array('hasOne', 'belongsTo', 'hasMany', 'hasAndBelongsToMany') as $assocType) {
	if (!empty($associations[$assocType])) {
		foreach ($associations[$assocType] as $relation) {
			echo " * @property {$relation['className']} \${$relation['alias']}\n";
		}
	}
}
?>
 */
class <?php echo $name ?> extends <?php echo $plugin; ?>AppModel {

<?php if ($useDbConfig !== 'default'): ?>
/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = '<?php echo $useDbConfig; ?>';

<?php endif;

if ($useTable && $useTable !== Inflector::tableize($name)):
	$table = "'$useTable'";
	echo "/**\n * Use table\n *\n * @var mixed False or table name\n */\n";
	echo "\tpublic \$useTable = $table;\n\n";
endif;

if ($primaryKey !== 'id'): ?>
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = '<?php echo $primaryKey; ?>';

<?php endif; ?>

<?php if ($displayField): ?>
/**
 * Display field
 *
 * @var string
 */
	public $displayField = '<?php echo $displayField; ?>';
	
<?php endif;
	if (!empty($virtualFields)): ?>
	/**
 * Display field
 *
 * @var string
 */
	public $virtualFields = array('virtual' => 'CONCAT(<?php echo $name . '.' .$virtualFields[0] ?>, \' \', <?php echo $name . '.' . $virtualFields[1]?>)');
<?php endif;
if (!empty($validate)):
	echo "/**\n * Validation rules\n *\n * @var array\n */\n";
	echo "\tpublic \$validate = array(\n";
	foreach ($validate as $field => $validations):
		echo "\t\t'$field' => array(\n";
		foreach ($validations as $key => $validator):
			echo "\t\t\t'$key' => array(\n";
			echo "\t\t\t\t'rule' => array('$validator'),\n";
			echo "\t\t\t\t//'message' => 'Your custom message here',\n";
			echo "\t\t\t\t//'allowEmpty' => false,\n";
			echo "\t\t\t\t//'required' => false,\n";
			echo "\t\t\t\t//'last' => false, // Stop validation after this rule\n";
			echo "\t\t\t\t//'on' => 'create', // Limit validation to 'create' or 'update' operations\n";
			echo "\t\t\t),\n";
		endforeach;
		echo "\t\t),\n";
	endforeach;
	echo "\t);\n";
endif;

foreach ($associations as $assoc):
	if (!empty($assoc)):
?>

	//The Associations below have been created with all possible keys, those that are not needed can be removed
<?php
		break;
	endif;
endforeach;

foreach (array('hasOne', 'belongsTo') as $assocType):
	if (!empty($associations[$assocType])):
		$typeCount = count($associations[$assocType]);
		echo "\n/**\n * $assocType associations\n *\n * @var array\n */";
		echo "\n\tpublic \$$assocType = array(";
		foreach ($associations[$assocType] as $i => $relation):
			$out = "\n\t\t'{$relation['alias']}' => array(\n";
			$out .= "\t\t\t'className' => '{$relation['className']}',\n";
			$out .= "\t\t\t'foreignKey' => '{$relation['foreignKey']}',\n";
			$out .= "\t\t\t'conditions' => '',\n";
			$out .= "\t\t\t'fields' => '',\n";
			$out .= "\t\t\t'order' => ''\n";
			$out .= "\t\t)";
			if ($i + 1 < $typeCount) {
				$out .= ",";
			}
			echo $out;
		endforeach;
		echo "\n\t);\n";
	endif;
endforeach;

if (!empty($associations['hasMany'])):
	$belongsToCount = count($associations['hasMany']);
	echo "\n/**\n * hasMany associations\n *\n * @var array\n */";
	echo "\n\tpublic \$hasMany = array(";
	foreach ($associations['hasMany'] as $i => $relation):
		$out = "\n\t\t'{$relation['alias']}' => array(\n";
		$out .= "\t\t\t'className' => '{$relation['className']}',\n";
		$out .= "\t\t\t'foreignKey' => '{$relation['foreignKey']}',\n";
		$out .= "\t\t\t'dependent' => false,\n";
		$out .= "\t\t\t'conditions' => '',\n";
		$out .= "\t\t\t'fields' => '',\n";
		$out .= "\t\t\t'order' => '',\n";
		$out .= "\t\t\t'limit' => '',\n";
		$out .= "\t\t\t'offset' => '',\n";
		$out .= "\t\t\t'exclusive' => '',\n";
		$out .= "\t\t\t'finderQuery' => '',\n";
		$out .= "\t\t\t'counterQuery' => ''\n";
		$out .= "\t\t)";
		if ($i + 1 < $belongsToCount) {
			$out .= ",";
		}
		echo $out;
	endforeach;
	echo "\n\t);\n\n";
endif;

if (!empty($associations['hasAndBelongsToMany'])):
	$habtmCount = count($associations['hasAndBelongsToMany']);
	echo "\n/**\n * hasAndBelongsToMany associations\n *\n * @var array\n */";
	echo "\n\tpublic \$hasAndBelongsToMany = array(";
	foreach ($associations['hasAndBelongsToMany'] as $i => $relation):
		$out = "\n\t\t'{$relation['alias']}' => array(\n";
		$out .= "\t\t\t'className' => '{$relation['className']}',\n";
		$out .= "\t\t\t'joinTable' => '{$relation['joinTable']}',\n";
		$out .= "\t\t\t'foreignKey' => '{$relation['foreignKey']}',\n";
		$out .= "\t\t\t'associationForeignKey' => '{$relation['associationForeignKey']}',\n";
		$out .= "\t\t\t'unique' => 'keepExisting',\n";
		$out .= "\t\t\t'conditions' => '',\n";
		$out .= "\t\t\t'fields' => '',\n";
		$out .= "\t\t\t'order' => '',\n";
		$out .= "\t\t\t'limit' => '',\n";
		$out .= "\t\t\t'offset' => '',\n";
		$out .= "\t\t\t'finderQuery' => '',\n";
		$out .= "\t\t\t'deleteQuery' => '',\n";
		$out .= "\t\t\t'insertQuery' => ''\n";
		$out .= "\t\t)";
		if ($i + 1 < $habtmCount) {
			$out .= ",";
		}
		echo $out;
	endforeach;
	echo "\n\t);\n\n";
endif;
?>

<?php if (!empty($filterArgs)) : ?>

public $actsAs = array('Search.Searchable', 'Containable');

	/**
	 * Criteria for search
	 *
	 * @var string
	 */
	public $filterArgs = array(
		'busqueda_general' => array('type' => 'query', 'method' => 'searchbusqueda_general', 'encode' => true),
<?php foreach ($fields as $field => $fieldtype): ?>
<?php $tiene_relacion = false;
	foreach ($associations['belongsTo'] as $i => $relation):
	if ($relation['foreignKey'] == $field): 
?>
		'<?php echo $field?>' => array('type' => 'subquery', 'method' => 'search<?php echo ucfirst($field);?>', 'field' => '"<?php echo $name?>"."<?php echo $field?>"', 'encode' => true),
<?php $tiene_relacion = true;
	endif;
	endforeach;
	if ($tiene_relacion == false):
		if ($fieldtype['type'] == 'date' || $fieldtype['type'] == 'datetime'):?>
		'<?php echo $field?>' => array('type' => 'subquery', 'method' => 'search<?php echo ucfirst($field);?>', 'field' => '"<?php echo $name?>"."<?php echo $field?>"', 'encode' => true),
		'<?php echo $field?>_desde' => array('type' => 'subquery', 'method' => 'search<?php echo ucfirst($field);?>_entre', 'field' => '"<?php echo $name?>"."<?php echo $primaryKey?>"', 'encode' => true),
		'<?php echo $field?>_hasta' => array('type' => 'expression', 'method' => null, 'field' => 'true', 'encode' => true),
<?php	
		elseif ($fieldtype['type'] === 'boolean'):
?>
		'<?php echo $field?>' => array('type' => 'value', 'encode' => true),
<?php else:
?>		'<?php echo $field?>' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>', 'encode' => true),
		'<?php echo $field?>_igual' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>Igual', 'encode' => true),
		'<?php echo $field?>_vacio' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>Vacio', 'encode' => true),
		'<?php echo $field?>_no_vacio' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>NoVacio', 'encode' => true),
<?php		if ($fieldtype['type'] === 'integer'):
?>
		'<?php echo $field?>_mayor' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>Mayor', 'encode' => true),
		'<?php echo $field?>_mayor_igual' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>MayorIgual', 'encode' => true),
		'<?php echo $field?>_menor' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>Menor', 'encode' => true),
		'<?php echo $field?>_menor_igual' => array('type' => 'query', 'method' => 'search<?php echo ucfirst($field);?>MenorIgual', 'encode' => true),

<?php   	endif;
		endif;
	endif;
	endforeach; ?>
	);
<?php $espacios = '';?>
<?php foreach ($fields as $field => $fieldtype): ?>
	public function search<?php echo ucfirst($field);?>($data = array()) {
<?php 
	$tiene_relacion = false;
	foreach ($associations['belongsTo'] as $i => $relation): 
		if ($relation['foreignKey'] == $field): 
			$tiene_relacion = true;
	?>
		return $data['<?php echo $field;?>'];
		<?php break;
		endif;
	endforeach;

	if ($tiene_relacion == false):
		if (($fieldtype['type'] == 'date' || $fieldtype['type'] == 'datetime')):?>		
		$ret = '';
		$comma = false;
		foreach (split(',', $data['<?php echo $field?>']) as $value) {
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
<?php 	else: ?>

		$or = array();
		if (!empty($data['<?php echo $field?>'])) {
			$data['<?php echo $field?>'] = str_replace(',', '%|%', $data['<?php echo $field?>']);

			if (substr($data['<?php echo $field?>'], strlen($data['<?php echo $field?>'])-1, 1) === '%|%') {
				$data['<?php echo $field?>'] = substr($data['<?php echo $field?>'], 0, strlen($data['<?php echo $field?>'])-1);
			}

			$or['LOWER(f_unaccent("<?php echo $name?>"."<?php echo $field?>"::text)) SIMILAR TO (f_unaccent(?))'] = '%' . $data['<?php echo $field?>'] . '%';
		}

		if (!empty($data['<?php echo $field?>_igual'])) {
			
			$data['<?php echo $field?>_igual'] = str_replace(',', '|', $data['<?php echo $field?>_igual']);

			if (substr($data['<?php echo $field?>_igual'], strlen($data['<?php echo $field?>_igual'])-1, 1) === '|') {
				$data['<?php echo $field?>_igual'] = substr($data['<?php echo $field?>_igual'], 0, strlen($data['<?php echo $field?>_igual'])-1);
			}

			$or['f_unaccent("<?php echo $name?>"."<?php echo $field?>"::text) SIMILAR TO (f_unaccent(?))'] = $data['<?php echo $field?>_igual'];
		}

		if (!empty($data['<?php echo $field?>_vacio'])) {
			$or['"<?php echo $name?>"."<?php echo $field?>"::text = ?'] = '';
		}

		if (!empty($data['<?php echo $field?>_no_vacio'])) {
			$or['"<?php echo $name?>"."<?php echo $field?>"::text <> ?'] = '';
		}

		if (!empty($data['<?php echo $field?>_mayor'])) {
			$or['"<?php echo $name?>"."<?php echo $field?>"::text > ?'] = split(',', $data['<?php echo $field?>_mayor'])[0];;
		}

		if (!empty($data['<?php echo $field?>_mayor_igual'])) {
			$or['"<?php echo $name?>"."<?php echo $field?>"::text >= ?'] = split(',', $data['<?php echo $field?>_mayor_igual'])[0];;
		}

		if (!empty($data['<?php echo $field?>_menor'])) {
			$or['"<?php echo $name?>"."<?php echo $field?>"::text < ?'] = split(',', $data['<?php echo $field?>_menor'])[0];;
		}

		if (!empty($data['<?php echo $field?>_menor_igual'])) {
			$or['"<?php echo $name?>"."<?php echo $field?>"::text <= ?'] = split(',', $data['<?php echo $field?>_menor_igual'])[0];;
		}

		return array(
			'<?php echo $espacios;?>OR' => $or
		);

<?php $espacios .= ' ';?>
<?php 	endif;
	endif;?>
	}

<?php if ($tiene_relacion == false && ($fieldtype['type'] == 'date' || $fieldtype['type'] == 'datetime')) : ?>
	public function search<?php echo ucfirst($field);?>_entre($data = array()) {
	
		$fecha_desde_array = array();
		$fecha_hasta_array = array();
		if (isset($data['<?php echo $field;?>_desde']) && isset($data['<?php echo $field;?>_hasta'])) {

			$data['<?php echo $field;?>_desde'] = str_replace(',,', '', $data['<?php echo $field;?>_desde']);
			$data['<?php echo $field;?>_hasta'] = str_replace(',,', '', $data['<?php echo $field;?>_hasta']);

			foreach (split(',', $data['<?php echo $field;?>_desde']) as $value) {
				$fecha = DateTime::createFromFormat('d/m/Y', $value);
				if ($fecha) {
					$fecha_desde_array[] = $fecha->format('Y-m-d');
				} else {
					return;
				}
			}

			foreach (split(',', $data['<?php echo $field;?>_hasta']) as $value) {
				$fecha = DateTime::createFromFormat('d/m/Y', $value);
				if ($fecha) {
					$fecha_hasta_array[] = $fecha->format('Y-m-d');
				} else {
					return;
				}
			}
			$or = array();
			foreach ($fecha_desde_array as $key => $fecha) {
				$or[] = '"' . $this->name . '"."<?php echo $field;?>" >= \'' . $fecha . '\'' . ' AND <?php echo $field;?> <= \'' . $fecha_hasta_array[$key] . '\'';

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
<?php endif; ?>
	public function search<?php echo ucfirst($field);?>Igual($data = array()) {
		return $this->search<?php echo ucfirst($field);?>($data);
	}

	public function search<?php echo ucfirst($field);?>Vacio($data = array()) {
		return $this->search<?php echo ucfirst($field);?>($data);
	}

	public function search<?php echo ucfirst($field);?>NoVacio($data = array()) {
		return $this->search<?php echo ucfirst($field);?>($data);
	}
<?php
	if ($fieldtype['type'] == 'integer'):
?>
	public function search<?php echo ucfirst($field);?>Mayor($data = array()) {
		return $this->search<?php echo ucfirst($field);?>($data);
	}
	public function search<?php echo ucfirst($field);?>MayorIgual($data = array()) {
		return $this->search<?php echo ucfirst($field);?>($data);
	}
	public function search<?php echo ucfirst($field);?>Menor($data = array()) {
		return $this->search<?php echo ucfirst($field);?>($data);
	}
	public function search<?php echo ucfirst($field);?>MenorIgual($data = array()) {
		return $this->search<?php echo ucfirst($field);?>($data);
	}
<?php
	endif;
endforeach; 


?>
	public function searchbusqueda_general($data = array()) {
		$data['busqueda_general'] = pg_escape_string($data['busqueda_general']);
		$query = '
<?php
	$agrego = false;
	foreach ($fields as $field => $fieldtype): ?>
<?php 
	$tiene_relacion = false;
	foreach ($associations['belongsTo'] as $i => $relation): 
		if ($relation['foreignKey'] == $field): 
			$tiene_relacion = true;
			if ($agrego) {
				echo 
'		OR 
';
			}
			$agrego = true;
	?>
		EXISTS 
		(
			SELECT 1 
				FROM "24043".<?php echo $relation['className'];?> as <?php echo $relation['className'];?> 
					WHERE <?php echo strtolower($relation['className']);?>.id = ' . $this->name . '.<?php echo $field;?>
					
					AND <?php echo strtolower($relation['className']);?>.' . $this-><?php echo $relation['className'];?>->displayField . ' ILIKE \'%' . $data['busqueda_general'] . '%\'
		)

<?php break;
		endif;
	endforeach;
	if ($tiene_relacion == false):
		if ($agrego) {
			echo 
' 		OR 
';
		}
		$agrego = true;	
		if ($fieldtype['type'] == 'date' || $fieldtype['type'] == 'datetime'):
?>
		 to_char(<?php echo $name ?>.<?php echo $field?>, \'DD/MM/YYYY\') LIKE \'%' . $data['busqueda_general'] . '%\'
<?php 	else: 
?>
		 f_unaccent(<?php echo $name ?>.<?php echo $field?>::text) ILIKE f_unaccent(\'%' . $data['busqueda_general'] . '%\')
<?php   endif;
	endif;
	endforeach; 
?>
		';
		return $query;
	}
<?php endif;?>
}