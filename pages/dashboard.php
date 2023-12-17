<!-- project/pages/dashboard.php -->

<?php
	// 启动会话
	session_start();
	
	// 获取用户信息
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	
	// 处理登出操作
	if (isset($_GET['logout'])) {
		// 清除 $_SESSION 数据
		session_unset();
		// 销毁会话
		session_destroy();
		echo "<p>你好，请 <a href='login.php'>登录</a>！</p>";
		exit();
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理后台</title>
</head>
<body>
<h1>管理后台</h1>

<?php
	echo "<p>你好, $username!</p>";
?>

<a href="../index.php">回到首页</a>
<a href="?logout=true">登出</a>
</body>
</html>