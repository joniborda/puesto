<?php
class AdminController extends AppController {
	public function index() {
		$this->redirect(array('controller' => 'pages', 'action' => 'admin_display'));
	}
}
?>