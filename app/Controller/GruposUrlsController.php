<?php
App::uses('AppController', 'Controller');
/**
 * GruposUrls Controller
 *
 * @property GruposUrl $GruposUrl
 * @property PaginatorComponent $Paginator
 * @property Search.PrgComponent $Search.Prg
 */
class GruposUrlsController extends AppController {

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
		$this->GruposUrl->recursive = 0;
		$this->set('gruposUrls', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->GruposUrl->exists($id)) {
			throw new NotFoundException(__('Invalid grupos url'));
		}
		$options = array('conditions' => array('GruposUrl.' . $this->GruposUrl->primaryKey => $id));
		$this->set('gruposUrl', $this->GruposUrl->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->GruposUrl->create();
			if ($this->GruposUrl->save($this->request->data)) {
				$this->Session->setFlash(__('The grupos url has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupos url could not be saved. Please, try again.'), 'flash/error');
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
        $this->GruposUrl->id = $id;
		if (!$this->GruposUrl->exists($id)) {
			throw new NotFoundException(__('Invalid grupos url'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GruposUrl->save($this->request->data)) {
				$this->Session->setFlash(__('The grupos url has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupos url could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('GruposUrl.' . $this->GruposUrl->primaryKey => $id));
			$this->request->data = $this->GruposUrl->find('first', $options);
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
		$this->GruposUrl->id = $id;
		if (!$this->GruposUrl->exists()) {
			throw new NotFoundException(__('Invalid grupos url'));
		}
		if ($this->GruposUrl->delete()) {
			$this->Session->setFlash(__('Grupos url deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Grupos url was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_find method
	 *
	 * @return void
	 */
	public function admin_find() {
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->GruposUrl->parseCriteria($this->Prg->parsedParams());
		$this->set('gruposUrls', $this->Paginator->paginate());
		$this->render('admin_index');
	}
}
