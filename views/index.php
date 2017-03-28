<html>
<head>
	<title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<!--script type="text/javascript" src="/js/prompt.js"></script-->
</head>
<style type="text/css">
	header {position: relative;}
	.operation {
		position: fixed;
		right: -10px;
		top: 50px;
	}
	.btn {
		width: 50px;
		height: 50px;
		background-color: lightgreen;
		margin-right: 20px;
	}

	.btn a {
		margin-right: 50px;
		color: white;
		font-size: 14px;
		line-height: 50px;
		text-align: center;
		display:block;
		width: 50px;
    	height: 50px; 
    	border: solid 1px #fff;
	}

	.btn a:link{text-decoration:none;}
	.btn a:visited{text-decoration:none;}
	.btn a:active{text-decoration:none;}

	.content {
		background-color: pink;
		font-size: 16px;
		width: 300px;
		height: 250px;
		text-align: center;
		padding-top: 150px;
		margin: auto auto;
	}
	p, h1{
		text-align: center;
	}

	.prompt {
		position: relative;
		margin: auto auto;
	}

	.prompt>div {
		background-color: lightgreen;
		width: 150px;
		height: 50px;
		padding-top: 0;
		border: solid 1px #eee;
		position: absolute;
		margin-left: 535px;
    	margin-top: -200px;
	}
</style>
<body>
	<header>
		<h1>Welcome to my homepage</h1>
		<p>My name is MItusky.</p>
		<div class="operation">
			<div class="btn register">
				<a href="/Ci-User/views/user/register.php">注 册</a>
			</div>
			<div class="btn sign-in">
				<a href="/Ci-User/views/user/sign_in.php">登 录</a>
			</div>
			<div class="btn sign-out">
				<a href="/Ci-User/index.php/user/signOut">退 出</a>
			</div>
		</div>
		
	</header>
	<div>
		<p>Write your content here.</p>
		<?php if (!empty($username)): ?>
			<div class="content"><p> Hello <?php echo $username; ?> ! <br> You are welcome. <br> This is your new house.</p></div>
		<?php else: ?>
			<div class="content"><p> Hello! <br> This is your new house.</p></div>
		<?php endif ?>
	</div>
	<!--<div class="prompt">
		<div open>
			<p>注册成功</p>
		</div>
	</div>-->
	<footer>
		<p>Posted by: Mitusky</p>
 		<p>Contact information: <a href="mailto:871661091@qq.com">871661091@qq.com</a>.</p>
	</footer>
</body>
</html>