<?php

namespace application\models;

use application\core\Model;


class MainModel extends Model{
	public $countTasks = 3;

	public function getTasks($start = 1){
		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'user_name';
		$offset = $this->countTasks * $start - $this->countTasks;
		$result =  $this->db->getRows("SELECT * FROM tasks ORDER BY $sort LIMIT $offset, $this->countTasks");
		return $result;
	}

	public function getTask($id){
		$result =  $this->db->getRow("SELECT * FROM tasks WHERE id = $id");
		return $result;
	}

}