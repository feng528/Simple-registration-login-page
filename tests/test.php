<!-- project/tests/test.php -->

<?php
	
	include_once('../config/db_config.php');
	
	// 在测试文件中连接数据库并记录测试信息
	if ($conn->connect_error) {
		$error_message = "数据库连接失败: " . $conn->connect_error;
		logTestResult($error_message);
	} else {
		logTestResult("数据库连接成功!");
	}
	
	// 关闭连接
	$conn->close();
	
	// 自定义函数，用于记录测试结果到日志文件
	function logTestResult($message) {
		$logFilePath = "test.log";
		$logMessage = date('Y-m-d H:i:s') . " - $message" . PHP_EOL;
		file_put_contents($logFilePath, $logMessage, FILE_APPEND);
	}

?>