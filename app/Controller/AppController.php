<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'RequestHandler',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Usuario',
					'fields' => array(
						'username' => 'usuario_login',
						'password' => 'contrasenia',
					),
				),
			),
			'loginAction' => array('controller' => 'usuarios', 'action' => 'login', 'admin' => true),
			'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => true),
			'logoutRedirect' => array('controller' => 'usuarios', 'action' => 'login', 'admin' => true),
			'authorize' => array('Controller'),
			'authError' => 'No tiene permisos para ingresar a esta sección',
		),
	);

	public $theme = "Cakestrap";
	public $layout = 'private';
	public $grupo = '';

	public $url_permitidas = array(
		'admin/pages/display',
		'admin/usuarios/logout',
		'admin/index/index',
		'/index/index',
		'/pages/display',
	);
	const ADMIN_GROUP = 'administrador';
	const EDIT_GROUP = 'editar';
	const ORDEN_PAGO = 'orden_pago';
	const PEDIDO = 'pedido';
	const DOCUMENTOS = 'documentos';

	public function beforeFilter() {
		
		if (!empty($_REQUEST['usuario_login']) && !empty($_REQUEST['contrasenia'])) {
			$this->request->data['Usuario'] = array(
				'usuario_login' => $_REQUEST['usuario_login'],
				'contrasenia' => $_REQUEST['contrasenia']
			);

			$this->Auth->login ();
		}

		$this->request->params['admin'] = 'admin';
		$this->historial();
		$this->set('current_user', $this->Auth->user());
		$this->set('current_url', $this->getUrl(true));
		$this->set('current_controller', Inflector::underscore($this->request->controller));
		$this->set('current_action', $this->request->action);
 		
		setlocale(LC_TIME, 'Spanish');
		setlocale(LC_TIME, 'es_AR.utf8');

	}

	public function beforeRender() {
	}

	public function getLayout() {
		$this->layout = 'private';
	}

	public function isAuthorized() {
		$this->set('is_admin', false);
		$url_string = Inflector::underscore($this->getUrl());

		$this->loadModel('UsuariosGrupo');

		if ($usuario = $this->Auth->user()) {

			if (empty($usuario['Grupo'])) {

				$user = $usuario;
				$usuario = $this->getModel('Usuario')->find(
					'first',
					array(
						'conditions' => array(
							'usuario_login' => $usuario['usuario_login'],
						),
						'recursive' => '2',
					)
				);

				if (!empty($usuario['Grupo'])) {
					$user['Grupo'] = $usuario['Grupo'];
				}

				$this->Session->write($this->Auth->getSessionkey(), $user);
			}

			if ($this->isPerfil()) {
				return true;
			}

			if (!empty($usuario['Grupo'])) {

				foreach ($usuario['Grupo'] as $grupo) {

					switch ($grupo['descripcion']) {
						case self::ADMIN_GROUP:
							$this->set('is_admin', true);
							return true;
							break;
					}

					foreach ($grupo['Url'] as $url) {
						if (Inflector::underscore(trim($url['descripcion'])) == $url_string) {
							return true;
						}
					}
				}
			}

			if (array_search($url_string, $this->url_permitidas) !== false) {
				return true;
			}

			$this->Session->setFlash('No tiene permisos para ingresar a esta sección', 'flash/error');
			$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));

			if (!$this->request->is('ajax')) {
				//$this->Session->setFlash($this->getUrl(), 'flash/error');
			}
		}
	}

	/**
	 * Get URL prefix/controller/action
	 *
	 * @return string
	 */
	public function getUrl($without_prefix = false) {

		if ($without_prefix) {
			return '/' . $this->request->controller . '/' .
			str_replace($this->params['prefix'] . '_', '', $this->request->action);
		}

		return $this->params['prefix'] . '/' . $this->request->controller . '/' .
		str_replace($this->params['prefix'] . '_', '', $this->request->action);

	}

	/**
	 * Return load model once
	 *
	 * @param String $model
	 *
	 * @return AppModel
	 */
	public function getModel($model) {
		if (!isset($this->{$model}) && $this->{$model} == null) {
			$this->loadModel($model);
		}
		return $this->{$model};
	}

	/**
	 * Save Historial
	 *
	 */
	private function historial() {

		$extension = substr($_SERVER['REQUEST_URI'], -4);

		if ($extension == '.png' || $extension == '.jpg' || $extension == 'jpeg' || $extension == '.doc' || $extension == '.pdf') {
			return;
		}

		if (!empty($this->data) && $this->request->action != 'admin_login') {
			$historial['Historial']['parametros'] = serialize($this->data);
		}
		$this->loadModel('Historial');

		$historial['Historial']['usuario'] = $this->Auth->user('usuario_login');
		$historial['Historial']['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$historial['Historial']['navegador'] = $_SERVER['HTTP_USER_AGENT'];
		$historial['Historial']['ip'] = $this->get_client_ip();

		$this->Historial->save($historial);
	}

	public function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} else if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} else if (getenv('HTTP_X_FORWARDED')) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} else if (getenv('HTTP_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} else if (getenv('HTTP_FORWARDED')) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} else if (getenv('REMOTE_ADDR')) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}

	/**
	 * Retorna true si es el perfil del usuario de session
	 *
	 * @return boolean
	 */
	private function isPerfil() {
		$url_string = Inflector::underscore($this->getUrl());
		if (
			$url_string === 'admin/usuarios/perfil'
			&& is_array($this->passedArgs)
			&& $this->Auth->user('id') == $this->passedArgs[0]
		) {
			// es el perfil del usuario
			return true;
		}
	}

	protected function cargar_todas_url() {
		$controllpull = App::objects('Controller');

		foreach ($controllpull as $controller) {

			if ($controller != 'AppController') {

				include_once $controller . '.php';

				$class = new ReflectionClass($controller);
				$actions = $class->getMethods(ReflectionMethod::IS_PUBLIC);

				$parentMethods = get_class_methods(get_parent_class($controller));

				$new_action = array();
				foreach ($actions as $a) {
					$new_action[] = $a->name;
				}

				$actions = array_diff($new_action, $parentMethods);
				$na = array();
				foreach ($actions as $a) {
					$na[] = str_replace('admin_', '', $a);
				}

				foreach ($na as $url) {
					$urls[] = 'admin/' . str_replace('_controller', '', Inflector::underscore($controller)) . '/' . $url;
				}

			}
		}

		$this->loadModel('Url');

		foreach ($urls as $url) {

			$url_model = $this->Url->find('first', 
				array(
					'conditions' => array(
						'descripcion' => $url
					),
					'recursive' => -1,
					'fields' => 'Url.id'
				)
			);

			if (empty($url_model)) {
				$this->Url->create();
				try {
					$this->Url->save(array('descripcion' => $url));
				} catch (PDOException $e) {
					echo "No se puedo guarar " . $url;
				}
			}
		}
		die();
	}

	/**
	 * Guardar archivo
	 *
	 * @param string $id			La clave primaria
	 * @param string $input_file	El input file
	 * @param string $input_name	El nombre del input
	 * @param string $folder		La carpeta en donde se va a guardar
	 *
	 * @return boolean
	 */
	protected function saveFile($id = null, $input_file = null, $input_name = null, $folder = 'onu_tratado') {
	
		if ($input_file == null || $input_name == null) {
			return false;
		}
		if($input_file['name'] != '') {
			$file = true;
			//ERRORES
			$error[0] = "El archivo debe ser menor a 50mb.";
	
			//variables
			$filename = str_replace(",()/\-_Âª^[]", '', $this->stripAccents(trim(urldecode($input_file['name']))));
			$tamano_archivo = $input_file['size'];
			$tmp_name = $input_file['tmp_name'];
	
			// COMPRUEBA QUE SEA MENOR DE 50 MB...
			if ($tamano_archivo > 51200000) {
				$this->Session->setFlash($error[0], 'flash/error');
				return false;
			}
	
			$directory = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'files' . DS . $folder . DS . $input_name . DS . $id;
			if (!is_dir($directory)) {
				@mkdir($directory);
			}
			
			$uploadfile = $directory . DS . $filename;
			
			$status = move_uploaded_file($tmp_name, $uploadfile);
			if ($status == false) {
				$this->Session->setFlash('No se puedo cargar el archivo', 'flash/error');
				return false;
			}
	
			return true;
		}
	}

	public function stripAccents($cadena = null ){
	    $originales = 'Ã€Ã�Ã‚ÃƒÃ„Ã…Ã†Ã‡ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ã�Ã‘Ã’Ã“Ã”Ã•Ã–Ã˜Ã™ÃšÃ›ÃœÃ�ÃžÃŸÃ Ã¡Ã¢Ã£Ã¤Ã¥Ã¦Ã§Ã¨Ã©ÃªÃ«Ã¬Ã­Ã®Ã¯Ã°Ã±Ã²Ã³Ã´ÃµÃ¶Ã¸Ã¹ÃºÃ»Ã½Ã½Ã¾Ã¿Å”Å•';
	    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	    $cadena = utf8_decode($cadena);
	    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
	    $cadena = strtolower($cadena);
    	return utf8_encode($cadena);
	}

	/**
	 * Guarda una imagen
	 *
 	 * @param string $key 			Una clave para el nombre del archivo
	 * @param string $input_file 	El input que se pasa para cargar la imagen
	 * @param string $input_name 	El nombre del campo
	 * @param string $folder 		El nombre de la carpeta en donde se va a guardar. 
	 * @return boolean
	 */
	protected function saveImage($key = null, $input_file = null, $input_name = null, $folder = 'Foto') {
		if ($input_file == null || $input_name == null) {
			return false;
		}
	
		App::import('Vendor', 'ImageTool');
		$foto = false;
		if($input_file['name'] != '') {
			$foto = true;
			//ERRORES
			$error[0] = "El archivo debe estar en formato JPG.";
			$error[1] = "La imagen no puede sobrepasar los 2 MB.";
			$error[2] = "La imagen no pudo ser subida correctamente.";
	
			$tmp_name = $input_file['tmp_name'];
		}
	
		if ($foto == true) {

			$folder_new = FILE_PATH . DS . $input_name;
			
			if (!file_exists(FILE_PATH)) {
				mkdir(FILE_PATH);
			}

			if (!file_exists($folder_new)) {
				mkdir($folder_new);
			}

			$uploadfile = $folder_new . DS . $input_file['name']; //Direccion del archivo subido
			// original
			$status = move_uploaded_file($tmp_name, $uploadfile);
			if ($status) { //Si se sube correctamente devuelve verdadero
				chmod($uploadfile, 0644);
			}
		} else {
			$this->Session->setFlash(__('El registro fue guardado correctamente.'), 'flash/success');
			return false;
		}
	}

	protected function deleteFileByCarpeta($folder) {
		$files = scandir($folder);

		if (is_array($files)) {
			foreach ($files as $file) {
				if (is_file($folder . DS . $file)) {
					unlink($folder . DS . $file);
				}
			}
		}
	}

}