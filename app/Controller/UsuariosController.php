<?php
App::uses('AppController', 'Controller');
/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 * @property Search.PrgComponent $Search.Prg
 */
class UsuariosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array (
			'Paginator',
			'Search.Prg',
			"Email",
			"Session"
	);

	public function beforeFilter() {
		parent::beforeFilter ();
		$this->Auth->allow ( 'admin_forgetpwd', 'admin_reset' );
	}

	public function admin_forgetpwd() {
		$this->Usuario->recursive = - 1;
		if (! empty ( $this->data )) {
			if (empty ( $this->data ['Usuario'] ['email'] )) {
				$this->Session->setFlash ( 'Debe ingresar su email.', 'flash/error' );
			} else {
				$email = $this->request->data ['Usuario'] ['email'];
				$fu = $this->Usuario->find ( 'first', array (
						'conditions' => array (
								'Usuario.email' => $email 
						) 
				) );
				if ($fu) {
					
					$key = Security::hash ( String::uuid (), 'sha512', true );
					$hash = sha1 ( $fu ['Usuario'] ['email'] . rand ( 0, 100 ) );
					$url = Router::url ( array (
							'controller' => 'usuarios',
							'action' => 'reset' 
					), true ) . '/' . $key . '#' . $hash;
					$ms = $url;
					$ms = wordwrap ( $ms, 1000 );
					// debug($url);
					$fu ['Usuario'] ['tokenhash'] = $key;
					$this->Usuario->id = $fu ['Usuario'] ['usuario_login'];
					if ($this->Usuario->saveField ( 'tokenhash', $fu ['Usuario'] ['tokenhash'] )) {
						
						// ============Email================//
						/* SMTP Options */
						
						$this->Email->smtpOptions = array (
								'port' => '25',
								'timeout' => '30',
								'host' => 'smtp.jus.gov.ar',
								'username' => 'fsuarez@jus.gov.ar' 
						// 'password'=>''
												);
						
						$this->Email->template = 'resetpw';
						$this->Email->from = 'recuperar_password@jus.gov.ar';
						$this->Email->to = $fu ['Usuario'] ['nombre'] . '<' . $fu ['Usuario'] ['email'] . '>';
						$this->Email->subject = 'Reset de contraseña';
						$this->Email->sendAs = 'both';
						
						$this->Email->delivery = 'smtp';
						$this->set ( 'ms', $ms );
						$this->Email->send ();
						$this->set ( 'smtp_errors', $this->Email->smtpError );
						$this->Session->setFlash ( __ ( 'Chequea tu email para resetear tu contraseña', 'flash/success' ) );
						
						// ============EndEmail=============//
					} else {
						$this->Session->setFlash ( "Hubo un error al resetear la contraseña.", 'flash/error' );
					}
				} else {
					$this->Session->setFlash ( 'El email no existe.', 'flash/error' );
				}
			}
		}
	}
	public function admin_reset($token = null) {
		// $this->layout="Login";
		$this->Usuario->recursive = - 1;
		if (! empty ( $token )) {
			$u = $this->Usuario->findBytokenhash ( $token );
			if ($u) {
				$this->Usuario->id = $u ['Usuario'] ['usuario_login'];
				if (! empty ( $this->data )) {
					$this->Usuario->data = $this->data;
					$this->Usuario->data ['Usuario'] ['email'] = $u ['Usuario'] ['email'];
					$new_hash = sha1 ( $u ['Usuario'] ['email'] . rand ( 0, 100 ) ); // created token
					$this->Usuario->data ['Usuario'] ['tokenhash'] = $new_hash;
					
					if ($this->Usuario->save ( $this->User->data )) {
						$this->Session->setFlash ( 'La contraseña fue actualizada.' );
						$this->redirect ( array (
								'controller' => 'usuarios',
								'action' => 'login' 
						) );
					} else {
						
						$this->set ( 'errors', $this->Usuario->invalidFields () );
					}
				}
			} else {
				$this->Session->setFlash ( 'La url no es válida.', 'flash/error' );
			}
		} 

		else {
			$this->redirect ( '/' );
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $usuario_login
 * @return void
 */
	public function admin_view($usuario_login = null) {
		if (!$this->Usuario->exists($usuario_login)) {
			throw new NotFoundException(__('Invalid usuarios table'));
		}
		$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $usuario_login));
		$this->set('usuario', $this->Usuario->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
 	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Usuario->create();
			//$this->request->data['Usuario']['usuario_login'] = $this->Auth->user('usuario_login');
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue agregado correctamente.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo agregar el registro. Por favor, vuelva a intentarlo.'), 'flash/error');
			}
		}
		
		if (!empty($this->request->query)) {
			foreach ($this->request->query as $key => $value) {
				$this->request->data['Usuario'][$key] = $value;
			}
		}
				
		$this->_cargar_modelos();
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $usuario_login
 * @return void
 */
		public function admin_edit($usuario_login = null) {
		$this->Usuario->usuario_login = $usuario_login;
		if (! $this->Usuario->exists ( $usuario_login )) {
			throw new NotFoundException ( __ ( 'Invalid usuarios table' ) );
		}
		if ($this->request->is ( 'post' ) || $this->request->is ( 'put' )) {
			if (empty ( $this->request->data ['Usuario'] ['contrasenia'] )) {
				unset ( $this->request->data ['Usuario'] ['contrasenia'] );
			}
			if ($this->Usuario->save( $this->request->data )) {
				$this->Usuario->UsuarioGrupo->deleteAll(
					array(
						'usuario' => $this->request->data ['Usuario']['usuario_login']
					)
				);

				if (!empty($this->request->data['Grupo']['Grupo'])) {
					foreach ($this->request->data['Grupo']['Grupo'] as $key => $value) {
						$this->Usuario->UsuarioGrupo->create();
						$this->Usuario->UsuarioGrupo->save(
							array(
								'usuario' => $this->request->data ['Usuario']['usuario_login'],
								'grupo' => $value
							)
						);
					}
				}
				$this->Session->setFlash ( __ ( 'The usuarios table has been saved' ), 'flash/success' );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The usuarios table could not be saved. Please, try again.' ), 'flash/error' );
			}
		} else {
			$options = array (
					'conditions' => array (
							'Usuario.' . $this->Usuario->primaryKey => $usuario_login
					) 
			);
			$this->request->data = $this->Usuario->find ( 'first', $options );
		}
		$this->_cargar_modelos();
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $usuario_login
 * @return void
 */
	public function admin_delete($usuario_login = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Usuario->usuario_login = $usuario_login;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Invalid usuarios table'));
		}
		
		$this->request->data['Usuario']['usuario_login'] = $this->Auth->user('usuario_login');
		if ($this->Usuario->delete()) {
			$this->Session->setFlash(__('El registro fue borrado correctamente.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('No se pudo borrar el registro'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * Login action
	 */
	public function admin_login() {
		if ($this->Auth->user ()) {
			$this->redirect ( '/admin' );
		}
		if ($this->request->is ( 'post' ) || $this->request->is ( 'put' )) {
			if ($this->Auth->login ()) {
				$this->redirect ( $this->Auth->redirect () );
				//$this->redirect ($this->Auth->loginRedirect);
			} else {
				$this->Session->setFlash ( __ ( 'El usuario es incorrecto, intente de nuevo.' ), 'default', array (), 'auth' );
			}
		}
	}
	public function admin_logout() {
		$this->redirect ($this->Auth->logout ());
	}

	/**
	 * admin_find method
	 *
	 * @return void
	 */
	public function admin_find() {
		if ($this->request->is('post')) {

			foreach ($this->Usuario->filterArgs as $key => $value) {
				if (!empty($this->request->data['Usuario'][$key])) {
					if ($key == 'busqueda_general') {
						continue;
					}
					$this->request->data['Usuario'][$key] = implode(',', $this->request->data['Usuario'][$key]);
				}
			}
		}
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Usuario->parseCriteria($this->Prg->parsedParams());
		$this->Usuario->recursive = 1;

		$this->set('usuarios', $this->Paginator->paginate());
		$this->request->data['Usuario']['nombre_completo'] = explode(',', $this->request->data['Usuario']['nombre_completo']);
		$this->request->data['Usuario']['usuario_login'] = explode(',', $this->request->data['Usuario']['usuario_login']);
		$this->request->data['Usuario']['borrado'] = explode(',', $this->request->data['Usuario']['borrado']);
		$this->request->data['Usuario']['contrasenia'] = explode(',', $this->request->data['Usuario']['contrasenia']);
		$this->render('admin_find_ajax');
	}

	private function _cargar_modelos() {
		$grupos = $this->Usuario->Grupo->find ( 'list' );
		$this->set ( compact ( 'grupos' ) );
	}
	/**
	 * admin_find Grupo method
	 *
	 * @return void
	 */
	public function admin_select_grupo($grupo = null) {
				
		if (!$this->request->is('post')) {
			if ($grupo == null) {
				throw new NotFoundException(__('Grupo nula'));
			}
			$this->set('grupo', $grupo);
			
		} else {
			
			$grupo = $this->data['grupo'];
			$this->loadModel('UsuariosGrupo');
			
			foreach ($this->data['Usuario'] as $usuario_login => $value) {
				
				$this->UsuariosGrupo->create();
				$this->UsuariosGrupo->save(
					array(
						'grupo' => $grupo,
						'usuario_login' => $usuario_login					)
				);
			}
			$this->redirect(array('controller' => 'Grupos', 'action' => 'edit', $grupo));
		}
		$this->Usuario->recursive = 0;
		$conditions = $this->__filtrar_por_grupo($grupo);

		$this->set('usuarios', $this->Paginator->paginate($conditions));
	}
	
	/**
	 *  method
	 *
	 * @return void
	 */
	public function admin_find_select_grupo() {
		$this->Prg->commonProcess();
		
		$this->Paginator->settings['conditions'] = $this->Usuario->parseCriteria($this->Prg->parsedParams());
		
		$conditions = $this->__filtrar_por_grupo($this->request->data['Usuario']['grupo']);
		
		$this->set('usuarios', $this->Paginator->paginate($conditions));
		
		if (isset($this->request->data['Usuario']['grupo'])) {
			$this->set('grupo', $this->request->data['Usuario']['grupo']);
		}
		
		$this->render('admin_select_grupo');
	}
	
	/**
	 * Prepara la conditions para filtrar los femicidas que no estan en una ficha
	 * 
	 * @param integer $grupo	 * @return multitype:multitype:multitype:NULL
	 */
	private function __filtrar_por_grupo($grupo) {
		// FILTRAR LOS FEMICIDAS DE LA FICHA
		$this->loadModel('UsuariosGrupo');
		
		$UsuariosGrupos = $this->UsuariosGrupo->find('all', array(
				'conditions' => array(
						'grupo' => $grupo				),
				'fields' => 'usuario_login',
				'recursive' => -1
		));
		$sin_UsuariosGrupos = array();
		
		foreach ($UsuariosGrupos as $UsuariosGrupo) {
			$sin_UsuariosGrupos[] = $UsuariosGrupo['UsuariosGrupo']['usuario_login'];
		}
		$conditions = array('NOT' => array('Usuario.id' => $sin_UsuariosGrupos));
		
		return $conditions;
	}
	
	/**
	 * admin_delete_en_grupo method
	 *
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $usuario_login
	 * @param string $grupo	 
	 * @return void
	 */
	public function admin_delete_en_grupo($usuario_login = null, $grupo = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		
		if ($usuario_login == null || $grupo == null) {
			$this->Session->setFlash(__('Id de Grupo o Usuario erróneo'), 'flash/error');
			$this->redirect(array('controller' => 'Grupos', 'action' => 'edit', $grupo));
		}
		
		$conditions = array('conditions' => array('grupo' => $grupo, 'usuario_login' => $usuario_login));
		
		$this->loadModel('UsuariosGrupo');
		
		$UsuariosGrupo = $this->UsuariosGrupo->find('first', $conditions);
		
		if ($UsuariosGrupo == null) {
			$this->Session->setFlash(__('No se encuentra la relación'), 'flash/error');
			$this->redirect(array('controller' => 'Grupos', 'action' => 'edit', $grupo));
		}
		
		$this->UsuariosGrupo->id = $UsuariosGrupo['UsuariosGrupo']['usuario_login'];
		
		if ($this->UsuariosGrupo->delete()) {
			$this->Session->setFlash(__('El registro fue borrado correctamente.'), 'flash/success');
			$this->redirect(array('controller' => 'Grupos', 'action' => 'edit', $grupo));
		}
		$this->Session->setFlash(__('No se pudo borrar el registro'), 'flash/error');
		$this->redirect(array('controller' => 'Grupos', 'action' => 'edit', $grupo));
	}

	public function admin_perfil($usuario_login) {
		if ($usuario_login != $this->Auth->user ( 'usuario_login' )) {
			$this->Session->setFlash ( 'No esta autorizado', 'flash/error' );
			$this->redirect ( array (
					'controller' => 'pages',
					'action' => 'display',
					'home',
					'admin' => true 
			) );
		}
		
		$this->Usuario->id = $usuario_login;
		
		if (! $this->Usuario->exists ( $usuario_login )) {
			throw new NotFoundException ( __ ( 'Invalid usuarios table' ) );
		}
		if ($this->request->is ( 'post' ) || $this->request->is ( 'put' )) {
			
			App::import ( 'Vendor', 'ImageTool' );
			
// 			unset ( $this->request->data ['Usuario'] ['nombre'] );
			unset ( $this->request->data ['Usuario'] ['usuario_login'] );
			unset ( $this->request->data ['Usuario'] ['borrado'] );
			unset ( $this->request->data ['Usuario'] ['id_anterior'] );
			unset ( $this->request->data ['Grupo'] );
			if (empty ( $this->request->data ['Usuario'] ['constrasenia'] )) {
				unset ( $this->request->data ['Usuario'] ['constrasenia'] );
			}
			
			$foto = false;
			$e = false;
			
			if ($this->request->data ['Usuario'] ['imagen'] ['name'] != '') {
				$foto = true;
				// ERRORES
				$error [0] = "El archivo debe estar en formato JPG.";
				$error [1] = "La imagen no puede sobrepasar los 2 MB.";
				$error [2] = "La imagen no pudo ser subida correctamente.";
				
				// variables
				$filename = trim ( $this->data ['Usuario'] ["imagen"] ['name'] );
				$tamano_archivo = $this->data ['Usuario'] ["imagen"] ['size'];
				$tmp_name = $this->data ['Usuario'] ["imagen"] ['tmp_name'];
				
				// SI EL ARCHIVO NO ES JPG
				$palabra = preg_quote ( '.jpg' );
				
				if (! eregi ( $palabra, $filename )) {
					$this->Session->setFlash ( $error [0], 'flash/error' );
					$e = true;
				}
				
				// COMPRUEBA QUE EL JPG SEA MENOR DE 2 MB...
				if ($tamano_archivo > 2048000) {
					$this->Session->setFlash ( $error [1], 'flash/error' );
					$e = true;
				}
			}
			
			if ($e == false) {
				if ($this->Usuario->save ( $this->request->data )) {
					// Cargo de nuevo el usuario porque sino tengo campos con unset
					$options = array (
							'conditions' => array (
									'Usuario.' . $this->Usuario->primaryKey => $usuario_login 
							) 
					);
					$this->request->data = $this->Usuario->find ( 'first', $options );
					
					if ($foto == true) {
						$usuario_login = $this->Auth->user ( 'usuario_login' ); // Recupero la ID del animal
						$uploaddir = "perfiles/"; // Directorio para guardar la imagen del animal
						$filename = $usuario_login . "_" . md5 ( $usuario_login ) . ".jpg";
						$uploadfile = $uploaddir . $filename; // Direccion del archivo subido
						
						$status = ImageTool::resize ( array (
								'input' => $tmp_name,
								'output' => $uploadfile,
								'width' => 50,
								'height' => 50,
								'quality' => 50 
						) );
						
						// SI SE SUBE EL ARCHIVO
						if ($status) { // Si se sube correctamente devuelve verdadero
							chmod ( $uploadfile, 0644 );
							$this->Session->setFlash ( __ ( 'El registro fue guardado correctamente.' ), 'flash/success' );
							// $this->redirect(array('action' => 'index'));
						} else {
							// SI HAY ALGUN ERROR BORRO EL ARCHIVO
							@ unlink ( $uploadfile );
							$this->Session->setFlash ( __ ( 'No se pudo editar el registro. Por favor, vuelva a intentarlo.' ), 'flash/error' );
							// $this->redirect(array('action' => 'index'));
						}
					} else {
						$this->Session->setFlash ( __ ( 'El registro fue guardado correctamente.' ), 'flash/success' );
						// $this->redirect(array('action' => 'index'));
					}
				} else {
					$this->Session->setFlash ( __ ( 'No se pudo editar el registro. Por favor, vuelva a intentarlo.' ), 'flash/error' );
				}
			}
		} else {
			$options = array (
					'conditions' => array (
							'Usuario.' . $this->Usuario->primaryKey => $usuario_login 
					) 
			);
			$this->request->data = $this->Usuario->find ( 'first', $options );
		}
	}
}
