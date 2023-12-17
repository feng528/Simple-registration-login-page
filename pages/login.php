<!-- project/pages/login.php -->

<?php
	include_once('../config/db_config.php');
	
	// 处理用户提交的登录表单
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 获取用户提交的数据
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// 查询数据库，检查用户名是否存在
		$check_username_sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $conn->query($check_username_sql);
		
		if ($result->num_rows > 0) {
			// 用户名存在，验证密码
			$row = $result->fetch_assoc();
			if (password_verify($password, $row['password_hash'])) {
				// 启动会话
				session_start();
				
				// 记录用户信息到 $_SESSION
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				
				// 登录成功，重定向到管理后台
				header("Location: dashboard.php");
				exit();
			} else {
				$error_message = "密码输入错误";
			}
		} else {
			$error_message = "用户名不存在";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
</head>
<body>
<h1>登录</h1>

<?php
	// 输出登录结果消息
	if (isset($error_message)) {
		echo "<p style='color: red;'>$error_message</p>";
	}
?>

<!-- 登录表单 -->
<form method="post" action="">
    <label for="username">用户名:</label>
    <input type="text" name="username" id="username" required><br>

    <label for="password">密码:</label>
    <input type="password" name="password" id="password" required><br>
    <br>
    <button type="submit">登录</button>
</form>
<br>
<a href="../index.php">返回首页</a>&nbsp;&nbsp;
<a href="register.php">没有账号？去注册</a>
</body>
</html>