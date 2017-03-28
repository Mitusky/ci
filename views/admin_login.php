<html lang="en"><head>
		<meta charset="utf-8">
		<title>Login Page - Ace Admin</title>

		<meta name="description" content="User login page">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- basic styles -->

		<link href="/Ci-User/assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/Ci-User/assets/css/font-awesome.min.css">

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/Ci-User/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<!--link rel="stylesheet" href="/Ci/assets/css/ace-fonts.css"-->

		<!-- ace styles -->

		<link rel="stylesheet" href="/Ci-User/assets/css/ace.min.css">
		<link rel="stylesheet" href="/Ci-User/assets/css/ace-rtl.min.css">

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/Ci-User/assets/css/ace-ie.min.css" />
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
										<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<span class="white">Backstage Management System</span>
								</h1>
								<h4 class="blue">© Mitusky website</h4>
							</div>
							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												请输入您的信息
											</h4>

											<div class="space-6"></div>

											<form method="post" action="/Ci-User/index.php/admin_index/adminLogin">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="ad_name" placeholder="Username">
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="ad_psd" class="form-control" placeholder="Password">
															<i class="icon-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
													<strong></strong>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace">
															<span class="lbl"> Remember Me</span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="icon-key"></i>
															Login
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div><!-- /widget-main -->
									</div><!-- /widget-body -->
								</div><!-- /login-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->
	

</body></html>