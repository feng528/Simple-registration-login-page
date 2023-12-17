<!-- project/config/db_config.php -->

<?php
	
	$servername = "127.0.0.1";
	$username = "root";
	$password = "123456";
	$database = "project";
	
	// 创建连接
	$conn = new mysqli($servername, $username, $password, $database);
	
	// 检测连接
	if ($conn->connect_error) {
		die("数据库连接失败: " . $conn->connect_error);
	}

?>