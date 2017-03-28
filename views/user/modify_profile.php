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
	<h1>This is a Modify Profile Page.</h1>
	<form action="/Ci/index.php/user/modfiyInfo" method="post">
		原密码：<input type="password" name="oldpsd" /><br>
		新密码：<input type="password" name="newpsd" /><br>
		<input type="submit" value="Confirm" />
	</form>
</body>
</html>