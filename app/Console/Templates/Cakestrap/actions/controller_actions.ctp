<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$imprimir[0] = false;
$imprimir[1] = false;
$imprimir[2] = false;
?>

/**
 * <?php echo $admin ?>index method
 *
 * @return void
 */
	public function <?php echo $admin ?>index() {
		$this->_cargar_modelos();
	}

/**
 * <?php echo $admin ?>view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin ?>view($id = null) {
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
		$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->find('first', $options));
	}

<?php $compact = array(); ?>
	/**
	 * <?php echo $admin ?>add method
	 *
	 * @return void
	 */
 <?php $tiene_persona = false;
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc) {
		foreach ($modelObj->{$assoc} as $associationName => $relation) {


			if (!empty($associationName)) {

			// 	$otherModelName = $this->_modelName($associationName);
			$otherModelName = $associationName;
				if ($otherModelName == 'Persona') {
					$tiene_persona = true;
					}
				elseif ($otherModelName == 'Provincia') {
					$imprimir[0] = true;
				}
				elseif ($otherModelName == 'Localidad') {
					$imprimir[1] = true;
				}
				elseif ($otherModelName == 'Departamento') {
					$imprimir[2] = true;
				}
			}
		}
	}

	if($imprimir[0] == true && $imprimir[1] == true && $imprimir[2] == true) { ?>
	public function admin_update_select($provincia, $region = null) {
		if ($region == null)
		{
			$options = $this-><?php echo $currentModelName; ?>->Departamento->find('list', array('conditions'=>array('provincia_id'=>$provincia)));
		}
		else
		{
			$options = $this-><?php echo $currentModelName; ?>->Localidad->find('list', array('conditions'=>array('departamento_id'=>$region)));
		}
		
		$this->set('options', $options);
		$this->render('/Elements/update_select', 'ajax');
	}
<?php } 
?>
	public function <?php echo $admin ?>add(<?php echo ($tiene_persona == true? '$persona_id':'');?>) {
		if ($this->request->is('post')) {
			$this-><?php echo $currentModelName; ?>->create();
			$this->request->data['<?php echo $currentModelName; ?>']['usuario_id'] = $this->Auth->user('id');
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('El registro fue agregado correctamente.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('El registro fue agregado correctamente.'), array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('No se pudo agregar el registro. Por favor, vuelva a intentarlo.'), 'flash/error');
<?php endif; ?>
			}
		}
		
<?php if ($tiene_persona):?>
		if ($persona_id == null) {
	 		$this->Session->setFlash(__('Error al agregar.'), 'flash/error');
	 		$this->redirect(array('action' => 'index'));
	 	}
	 	
	 	$exists = $this-><?php echo $currentModelName;?>->find('first', array(
	 			'conditions' => array(
	 					$this->modelClass . '.persona_id' => $persona_id
	 			),
	 			'recursive' => -1,
	 			'callbacks' => false,
	 			'fields' => $this-><?php echo $currentModelName?>->primaryKey
	 	));
	 	
	 	if ($exists) {
	 		$this->redirect(array('action' => 'edit',$exists['<?php echo $currentModelName;?>'][$this-><?php echo $currentModelName?>->primaryKey]));
	 	}
<?php endif;?>
		if (!empty($this->request->query)) {
			foreach ($this->request->query as $key => $value) {
				$this->request->data['<?php echo $currentModelName;?>'][$key] = $value;
			}
		}
		<?php if ($tiene_persona):?>
		$persona = $this-><?php echo $currentModelName;?>->Persona->find('first', 
			array(
					'conditions' => array('Persona.id' => $persona_id),
					'recursive' => -1,
					'fields' => array($this-><?php echo $currentModelName;?>->Persona->displayField,'id')
			)
		);
		$this->set(compact('persona'));
		<?php endif;?>
		
		$this->_cargar_modelos();
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>edit($id = null) {
        $this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['<?php echo $currentModelName; ?>']['usuario_id'] = $this->Auth->user('id');
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('El registro fue guardado correctamente.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('El registro fue guardado correctamente.'), array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('No se pudo editar el registro. Por favor, vuelva a intentarlo.'), 'flash/error');
<?php endif; ?>
			}
		} else {
			$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
			$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
		}
		$this->_cargar_modelos();
	}

/**
 * <?php echo $admin ?>delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		
		$this->request->data['<?php echo $currentModelName; ?>']['usuario_id'] = $this->Auth->user('id');
		if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('El registro fue borrado correctamente.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
<?php else: ?>
			$this->flash(__('El registro fue borrado correctamente.'), array('action' => 'index'));
<?php endif; ?>
		}
<?php if ($wannaUseSession): ?>
		$this->Session->setFlash(__('No se pudo borrar el registro'), 'flash/error');
<?php else: ?>
		$this->flash(__('No se pudo borrar el registro.'), array('action' => 'index'));
<?php endif; ?>
		$this->redirect(array('action' => 'index'));
	}

<?php if ($wannaSearch):?>
	/**
	 * <?php echo $admin;?>find method
	 *
	 * @return void
	 */
	public function <?php echo $admin; ?>find() {
		if ($this->request->is('post')) {

			foreach ($this-><?php echo $currentModelName?>->filterArgs as $key => $value) {
				if (!empty($this->request->data['<?php echo $currentModelName?>'][$key])) {
					if ($key == 'busqueda_general') {
						continue;
					}
					$this->request->data['<?php echo $currentModelName?>'][$key] = implode(',', $this->request->data['<?php echo $currentModelName?>'][$key]);
				}
			}
<?php $fields = $modelObj->schema(true);?>
		}
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this-><?php echo $currentModelName?>->parseCriteria($this->Prg->parsedParams());
		$this-><?php echo $currentModelName; ?>->recursive = 1;
		$this->set('<?php echo $pluralName; ?>', $this->Paginator->paginate());
		$this->render('<?php echo $admin; ?>find_ajax');
	}

<?php endif;?>
	private function _cargar_modelos() {
<?php
		foreach (array('belongsTo') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					if ($associationName == 'Provincia') $otherModelName = $associationName;
				
								
					$otherPluralName = $this->_pluralName($associationName);
					
					if (!in_array($otherModelName, ['Localidad', 'Departamento'])) {
						echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					}
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if ($imprimir[0] && $imprimir[1]):?>
		$provincia_id_selected = $this-><?php echo $currentModelName; ?>->Localidad->find('first', array('conditions' => array('Localidad.id' => $this->request->data['<?php echo $currentModelName; ?>']['localidad_id']),'fields'=> array('Departamento.provincia_id','Departamento.id')));
		if ($provincia_id_selected) {
			$departamentos = $this-><?php echo $currentModelName; ?>->Localidad->Departamento->find('list', array('conditions' => array('provincia_id' => $provincia_id_selected['Departamento']['provincia_id'])));
			$localidads = $this-><?php echo $currentModelName; ?>->Localidad->find('list', array('conditions' => array('departamento_id' => $provincia_id_selected['Departamento']['id'])));
			
			$this->request->data['<?php echo $currentModelName; ?>']['Provincia'] = $provincia_id_selected['Departamento']['provincia_id'];
			$this->request->data['<?php echo $currentModelName; ?>']['Departamento'] = $provincia_id_selected['Departamento']['id'];
		}
<?php 	endif;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
		?>
	}
<?php 
foreach (array('hasAndBelongsToMany') as $assoc):
	foreach ($modelObj->{$assoc} as $associationName => $relation):
		if (!empty($associationName)):
			$otherModelName = $this->_modelName($associationName);
		
			$field_association = (isset($relation['associationForeignKey']) ? $relation['associationForeignKey'] : $associationName);
			$with = (isset($relation['with']) ? $relation['with'] : $associationName);
			$foreignKey = (isset($relation['foreignKey']) ? $relation['foreignKey'] : $currentModelName);
			
			if ($associationName == 'Provincia') $otherModelName = $associationName;
			
			
			$otherPluralName = $this->_pluralName($associationName);
				
?>
	/**
	 * <?php echo $admin;?>find <?php echo $associationName; ?> method
	 *
	 * @return void
	 */
	public function <?php echo $admin; ?>select_<?php echo $field_association; ?>($<?php echo $field_association;?> = null) {
				
		if (!$this->request->is('post')) {
			if ($<?php echo $field_association;?> == null) {
				throw new NotFoundException(__('<?php echo $associationName?> nula'));
			}
			$this->set('<?php echo $field_association; ?>', $<?php echo $field_association; ?>);
			
		} else {
			
			$<?php echo $field_association;?> = $this->data['<?php echo $field_association;?>'];
			$this->loadModel('<?php echo $with; ?>');
			
			foreach ($this->data['<?php echo $currentModelName; ?>'] as $<?php echo $foreignKey; ?> => $value) {
				
				$this-><?php echo $with; ?>->create();
				$this-><?php echo $with; ?>->save(
					array(
						'<?php echo $field_association;?>' => $<?php echo $field_association;?>,
						'<?php echo $foreignKey ?>' => $<?php echo $foreignKey; ?>
					)
				);
			}
			$this->redirect(array('controller' => '<?php echo $associationName?>s', 'action' => 'edit', $<?php echo $field_association;?>));
		}
		$this-><?php echo $currentModelName?>->recursive = 0;
		$conditions = $this->__filtrar_por_<?php echo $field_association?>($<?php echo $field_association;?>);

		$this->set('<?php echo $pluralName ?>', $this->Paginator->paginate($conditions));
	}
	
	/**
	 *  method
	 *
	 * @return void
	 */
	public function <?php echo $admin; ?>find_select_<?php echo $field_association; ?>() {
		$this->Prg->commonProcess();
		
		$this->Paginator->settings['conditions'] = $this-><?php echo $currentModelName?>->parseCriteria($this->Prg->parsedParams());
		
		$conditions = $this->__filtrar_por_<?php echo $field_association?>($this->request->data['<?php echo $currentModelName?>']['<?php echo $field_association;?>']);
		
		$this->set('<?php echo $pluralName ?>', $this->Paginator->paginate($conditions));
		
		if (isset($this->request->data['<?php echo $currentModelName?>']['<?php echo $field_association;?>'])) {
			$this->set('<?php echo $field_association;?>', $this->request->data['<?php echo $currentModelName?>']['<?php echo $field_association;?>']);
		}
		
		$this->render('admin_select_<?php echo $field_association;?>');
	}
	
	/**
	 * Prepara la conditions para filtrar los femicidas que no estan en una ficha
	 * 
	 * @param integer $<?php echo $field_association; ?>
	 * @return multitype:multitype:multitype:NULL
	 */
	private function __filtrar_por_<?php echo $field_association; ?>($<?php echo $field_association; ?>) {
		// FILTRAR LOS FEMICIDAS DE LA FICHA
		$this->loadModel('<?php echo $with; ?>');
		
		$<?php echo $with; ?>s = $this-><?php echo $with; ?>->find('all', array(
				'conditions' => array(
						'<?php echo $field_association; ?>' => $<?php echo $field_association; ?>
				),
				'fields' => '<?php echo $foreignKey; ?>',
				'recursive' => -1
		));
		$sin_<?php echo $with; ?>s = array();
		
		foreach ($<?php echo $with; ?>s as $<?php echo $with; ?>) {
			$sin_<?php echo $with; ?>s[] = $<?php echo $with; ?>['<?php echo $with; ?>']['<?php echo $foreignKey; ?>'];
		}
		$conditions = array('NOT' => array('<?php echo $currentModelName; ?>.id' => $sin_<?php echo $with; ?>s));
		
		return $conditions;
	}
	
	/**
	 * admin_delete_en_<?php echo $field_association; ?> method
	 *
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @param string $<?php echo $field_association; ?>
	 
	 * @return void
	 */
	public function admin_delete_en_<?php echo strtolower($associationName)?>($id = null, $<?php echo $field_association; ?> = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		
		if ($id == null || $<?php echo $field_association; ?> == null) {
			$this->Session->setFlash(__('Id de <?php echo $associationName?> o <?php echo $currentModelName; ?> erróneo'), 'flash/error');
			$this->redirect(array('controller' => '<?php echo $associationName?>s', 'action' => 'edit', $<?php echo $field_association; ?>));
		}
		
		$conditions = array('conditions' => array('<?php echo $field_association; ?>' => $<?php echo $field_association; ?>, '<?php echo $foreignKey; ?>' => $id));
		
		$this->loadModel('<?php echo $with; ?>');
		
		$<?php echo $with; ?> = $this-><?php echo $with; ?>->find('first', $conditions);
		
		if ($<?php echo $with; ?> == null) {
			$this->Session->setFlash(__('No se encuentra la relación'), 'flash/error');
			$this->redirect(array('controller' => '<?php echo $associationName?>s', 'action' => 'edit', $<?php echo $field_association; ?>));
		}
		
		$this-><?php echo $with; ?>->id = $<?php echo $with; ?>['<?php echo $with; ?>']['id'];
		
		if ($this-><?php echo $with; ?>->delete()) {
			$this->Session->setFlash(__('El registro fue borrado correctamente.'), 'flash/success');
			$this->redirect(array('controller' => '<?php echo $associationName?>s', 'action' => 'edit', $<?php echo $field_association; ?>));
		}
		$this->Session->setFlash(__('No se pudo borrar el registro'), 'flash/error');
		$this->redirect(array('controller' => '<?php echo $associationName?>s', 'action' => 'edit', $<?php echo $field_association; ?>));
	}

<?php 
			$compact[] = "'{$otherPluralName}'";
		endif;
	endforeach;
endforeach; 
?>