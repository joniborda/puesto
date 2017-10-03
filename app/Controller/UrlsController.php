<?php
App::uses('AppController', 'Controller');
/**
 * Urls Controller
 *
 * @property Url $Url
 * @property PaginatorComponent $Paginator
 * @property Search.PrgComponent $Search.Prg
 */
class UrlsController extends AppController {

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
		$this->Url->recursive = 0;
		$this->set('urls', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Url->exists($id)) {
			throw new NotFoundException(__('Invalid url'));
		}
		$options = array('conditions' => array('Url.' . $this->Url->primaryKey => $id));
		$this->set('url', $this->Url->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Url->create();
			if ($this->Url->save($this->request->data)) {
				$this->Session->setFlash(__('The url has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The url could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$grupos = $this->Url->Grupo->find('list');
		$this->set(compact('grupos'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
        $this->Url->id = $id;
		if (!$this->Url->exists($id)) {
			throw new NotFoundException(__('Invalid url'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Url->save($this->request->data)) {
				$this->Session->setFlash(__('The url has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The url could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Url.' . $this->Url->primaryKey => $id));
			$this->request->data = $this->Url->find('first', $options);
		}
		$grupos = $this->Url->Grupo->find('list');
		$this->set(compact('grupos'));
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
		$this->Url->id = $id;
		if (!$this->Url->exists()) {
			throw new NotFoundException(__('Invalid url'));
		}
		if ($this->Url->delete()) {
			$this->Session->setFlash(__('Url deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Url was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_find method
	 *
	 * @return void
	 */
	public function admin_find() {
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Url->parseCriteria($this->Prg->parsedParams());
		$this->set('urls', $this->Paginator->paginate());
		$this->render('admin_index');
	}

	public function admin_cargar() {
		$this->cargar_todas_url();
	}
}
