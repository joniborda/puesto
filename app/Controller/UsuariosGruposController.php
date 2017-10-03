<?php
App::uses('AppController', 'Controller');
/**
 * UsuariosGrupos Controller
 *
 * @property UsuariosGrupo $UsuariosGrupo
 * @property PaginatorComponent $Paginator
 * @property Search.PrgComponent $Search.Prg
 */
class UsuariosGruposController extends AppController {

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
		$this->UsuariosGrupo->recursive = 0;
		$this->set('usuariosGrupos', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UsuariosGrupo->exists($id)) {
			throw new NotFoundException(__('Invalid usuarios grupo'));
		}
		$options = array('conditions' => array('UsuariosGrupo.' . $this->UsuariosGrupo->primaryKey => $id));
		$this->set('usuariosGrupo', $this->UsuariosGrupo->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UsuariosGrupo->create();
			if ($this->UsuariosGrupo->save($this->request->data)) {
				$this->Session->setFlash(__('The usuarios grupo has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuarios grupo could not be saved. Please, try again.'), 'flash/error');
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
        $this->UsuariosGrupo->id = $id;
		if (!$this->UsuariosGrupo->exists($id)) {
			throw new NotFoundException(__('Invalid usuarios grupo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UsuariosGrupo->save($this->request->data)) {
				$this->Session->setFlash(__('The usuarios grupo has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuarios grupo could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('UsuariosGrupo.' . $this->UsuariosGrupo->primaryKey => $id));
			$this->request->data = $this->UsuariosGrupo->find('first', $options);
		}
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
		$this->UsuariosGrupo->id = $id;
		if (!$this->UsuariosGrupo->exists()) {
			throw new NotFoundException(__('Invalid usuarios grupo'));
		}
		if ($this->UsuariosGrupo->delete()) {
			$this->Session->setFlash(__('Usuarios grupo deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Usuarios grupo was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_find method
	 *
	 * @return void
	 */
	public function admin_find() {
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->UsuariosGrupo->parseCriteria($this->Prg->parsedParams());
		$this->set('usuariosGrupos', $this->Paginator->paginate());
		$this->render('admin_index');
	}
}
