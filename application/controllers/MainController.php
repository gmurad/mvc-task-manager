<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends  Controller{
	private $listSize = 3;
	private $totalItems;
	protected $paginator;
	private $tasks;
	protected $pageNum;
	public function __construct($route, $pageNum){
		$strUrlPage = $route['controller'].'/'. $route['action'];
		$this->pageNum = $pageNum;

		parent::__construct($route);
		
		$this->totalItems = $this->model->db->getColumn("SELECT COUNT(id) as 'count_tasks' FROM tasks") * 1 ;
		$this->paginator = $this->utils->getPaginator($this->totalItems, $this->listSize, $strUrlPage);

	}

	public function indexAction(){
		$this->tasks = $this->model->getTasks($this->pageNum);
		$this->view->render('Task manager', $this->tasks, $this->paginator);
	}

	public function insertAction(){

		if(isset($_POST['insert_form'])){
			$userName = $_POST['user_name'];
			$email = $_POST['email'];
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (user_name, email, task) VALUES ('$userName', '$email', '$task')";
			$this->model->db->doQuery($sql);

			header("Location: {$_SERVER['HTTP_REFERER']}");
		}

	}

}