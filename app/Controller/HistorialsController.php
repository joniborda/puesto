<?php
App::uses('AppController', 'Controller');
/**
 * Historials Controller
 *
 * @property Historial $Historial
 * @property PaginatorComponent $Paginator
 * @property Search.PrgComponent $Search.Prg
 */
class HistorialsController extends AppController {

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
		$this->Historial->recursive = 0;
		$this->set('historials', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Historial->exists($id)) {
			throw new NotFoundException(__('Invalid historial'));
		}
		$options = array('conditions' => array('Historial.' . $this->Historial->primaryKey => $id));
		$this->set('historial', $this->Historial->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Historial->create();
			if ($this->Historial->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue agregado correctamente.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo agregar el registro. Por favor, vuelva a intentarlo.'), 'flash/error');
			}
		}
		$usuarios = $this->Historial->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
        $this->Historial->id = $id;
		if (!$this->Historial->exists($id)) {
			throw new NotFoundException(__('Invalid historial'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Historial->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue guardado correctamente.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo editar el registro. Por favor, vuelva a intentarlo.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Historial.' . $this->Historial->primaryKey => $id));
			$this->request->data = $this->Historial->find('first', $options);
		}
		$usuarios = $this->Historial->Usuario->find('list');
		$this->set(compact('usuarios'));
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
		$this->Historial->id = $id;
		if (!$this->Historial->exists()) {
			throw new NotFoundException(__('Invalid historial'));
		}
		if ($this->Historial->delete()) {
			$this->Session->setFlash(__('El registro fue borrado correctamente.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('No se pudo borrar el registro'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_find method
	 *
	 * @return void
	 */
	public function admin_find() {
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Historial->parseCriteria($this->Prg->parsedParams());
		$this->set('historials', $this->Paginator->paginate());
		$this->render('admin_index');
	}
}
