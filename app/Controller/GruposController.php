<?php
App::uses('AppController', 'Controller');
/**
 * Grupos Controller
 *
 * @property Grupo $Grupo
 * @property PaginatorComponent $Paginator
 * @property Search.PrgComponent $Search.Prg
 */
class GruposController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Search.Prg');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Grupo->recursive = 0;
		$this->set('grupos', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Grupo->exists($id)) {
			throw new NotFoundException(__('Invalid grupo'));
		}
		$options = array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id));
		$this->set('grupo', $this->Grupo->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Grupo->create();
			if ($this->Grupo->save($this->request->data)) {
				$id = $this->Grupo->getLastInsertID();
				$this->loadModel('UsuariosGrupo');
				if (!empty($this->request->data['Grupo']['Usuario'])) {
					foreach ($this->request->data['Grupo']['Usuario'] as $usuario) {
						$this->UsuariosGrupo->create();

						$this->UsuariosGrupo->save(array(
							'grupo' => $id,
							'usuario' => $usuario
						));
					}
				}

				$this->Session->setFlash(__('The grupo has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupo could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$this->_cargarModelos();
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
        $this->Grupo->id = $id;
		if (!$this->Grupo->exists($id)) {
			throw new NotFoundException(__('Invalid grupo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Grupo->save($this->request->data)) {

				$this->loadModel('UsuariosGrupo');
				$this->UsuariosGrupo->deleteAll(array('grupo' => $id));
				if (!empty($this->request->data['Grupo']['Usuario'])) {
					foreach ($this->request->data['Grupo']['Usuario'] as $usuario) {
						$this->UsuariosGrupo->create();

						$this->UsuariosGrupo->save(array(
							'grupo' => $id,
							'usuario' => $usuario
						));
					}
				}

				$this->Session->setFlash(__('The grupo has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupo could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$grupo = $this->Grupo->find('first', array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id)));

			if (!empty($grupo['UsuariosGrupo'])) {
				$grupo['Usuario'] = array();
				foreach ($grupo['UsuariosGrupo'] as $usuarioGrupo) {
					$grupo['Usuario'][] = array(
						'usuario_login' => $usuarioGrupo['usuario']
					);
				}
			}

			$this->request->data = $grupo;
		}

		$this->_cargarModelos();
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Grupo->id = $id;
		if (!$this->Grupo->exists()) {
			throw new NotFoundException(__('Invalid grupo'));
		}
		if ($this->Grupo->delete()) {
			$this->Session->setFlash(__('Grupo deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Grupo was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_find method
	 *
	 * @return void
	 */
	public function admin_find() {
		if ($this->request->is('post')) {

			foreach ($this->Grupo->filterArgs as $key => $value) {
				if (!empty($this->request->data['Grupo'][$key])) {
					if ($key == 'busqueda_general') {
						continue;
					}
					$this->request->data['Grupo'][$key] = implode(',', $this->request->data['Grupo'][$key]);
				}
			}
		}
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Grupo->parseCriteria($this->Prg->parsedParams());
		$this->Grupo->recursive = 1;

		$this->set('grupos', $this->Paginator->paginate());
		$this->render('admin_find_ajax');
	}

	private function _cargarModelos() {
		$urls = $this->Grupo->Url->find('list');
		$this->loadModel('Usuario');
		$usuarios = $this->Usuario->find('list');
		$this->set(compact('urls', 'usuarios'));
	}
}
