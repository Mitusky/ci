<html>
<head>
	<title>Sign in</title>
</head>
<style type="text/css">
	input {
		margin:10px;
	}
</style>
<body>
	<h1>This is a Sign In Page.</h1>
	<form action="/Ci/index.php/user/signIn" method="post">
		用户名：<input type="text" name="username" /><br>
		密  码：<input type="password" name="password"/><br>
		<input type="submit" value="Sign In" />
	</form>
</body>
</html>