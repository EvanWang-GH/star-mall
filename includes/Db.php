<?php
class Db
{
	// 数据库连接信息
	private $host = 'localhost';
	private $user = 'username';
	private $password = 'pwd';
	private $dbname = 'shopping';

	// 数据库连接对象
	public $conn;

	// 构造函数，用于连接数据库
	public function __construct()
	{
		$this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
	}

	// 执行查询语句
	public function query($sql)
	{
		return $this->conn->query($sql);;
	}

	// 获取单行记录
	public function fetch_row($sql)
	{
		$result = $this->query($sql);
		return $result->fetch_array();
	}

	// 获取多行记录
	public function fetch_list($sql)
	{
		$result = $this->query($sql);
		$rows = [];
		while ($row = $result->fetch_array()) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function error()
	{
		return $this->conn->error;
	}

	public function close()
	{
		$this->conn->close();
	}
}
