<!-- project/pages/register.php -->

<?php
	include_once('../config/db_config.php');
	
	// 处理用户提交的注册表单
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 获取用户提交的数据
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// 对数据进行简单的验证，确保不为空
		if (empty($username) || empty($password)) {
			$error_message = "用户名和密码不能为空";
		} else {
			// 检查用户名是否已存在
			$check_username_sql = "SELECT * FROM users WHERE username = '$username'";
			$result = $conn->query($check_username_sql);
			
			if ($result->num_rows > 0) {
				$error_message = "用户名已存在，请重新输入！";
			} else {
				// 对密码进行哈希处理，建议在实际项目中使用更强大的加密方法
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
				// 插入用户数据到数据库
				$insert_sql = "INSERT INTO users (username, password_hash) VALUES ('$username', '$hashed_password')";
				
				
				if ($conn->query($insert_sql) === TRUE) {
					$success_message = "注册成功，请登录";
				} else {
					$error_message = "注册失败：" . $conn->error;
				}
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册页面</title>
</head>
<body>
<h1>注册</h1>

<?php
	// 输出注册结果消息
	if (isset($error_message)) {
		echo "<p style='color: red;'>$error_message</p>";
	} elseif (isset($success_message)) {
		echo "<p style='color: green;'>$success_message</p>";
	}
?>

<!-- 注册表单 -->
<form method="post" action="">
    <label for="username">用户名:</label>
    <input type="text" name="username" id="username" required><br>

    <label for="password">密码:</label>
    <input type="password" name="password" id="password" required><br>
    <br>
    <button type="submit">提交注册</button>
</form>
<br>
<a href="../index.php">返回首页</a>&nbsp;&nbsp;
<a href="login.php">已有账号？去登录</a>
</body>
</html>