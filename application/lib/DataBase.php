<?php

namespace application\lib;
use PDO;

class DataBase
{
	protected $db;
	
	function __construct(){
		$config = require 'application/config/db.php';
		$this->db = new PDO("mysql:host={$config['host']};dbname={$config['name']}", $config['user'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}

	public function doQuery($sql){
		$query = $this->db->query($sql);
		return $query;
	}

	public function getRows($sql){
		$queryResult = $this->doQuery($sql);
		return $queryResult->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getRow($sql){
		$queryResult = $this->doQuery($sql);
		return $queryResult->fetch(PDO::FETCH_ASSOC);
	}

	public function getColumn($sql){
		$queryResult = $this->doQuery($sql);
		return $queryResult->fetchColumn();
	}
	
}