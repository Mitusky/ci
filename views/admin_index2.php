<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>User Management</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/Ci-User/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/Ci-User/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="/Ci-User/assets/css/bootstrap-datetimepicker.min.css" />
	</head>
	<style type="text/css">
		.navigation {
			margin-bottom: 0;
			background-color: #438EB9;
		}
		.font-size-16 {
			color: #fff;
			font-size: 1.8rem;
		}
		.modal-style {
			width: 28.5rem;
		}

		.btn {
			margin-bottom: 0.2rem;
		}
		.addBtn { margin-right: 1rem !important; }
		.signOut { margin-right: 1rem !important; }
		.menu { text-align: right; }
		.bgc-fff { background-color: #fff; }

		.m-b-0-5 { margin: 0.5rem; }
		.m-b-0-65 { margin: 0.65rem; }
	</style>
	<body>
		<div id="navbar" class="navbar navbar-default ace-save-state navigation">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="admin_index" class="navbar-brand">
						<small class="font-size-16">
							<i class="fa fa-leaf"></i>
							Backstage Management System
						</small>
					</a>
				</div>

			</div><!-- /.navbar-container -->
		</div>
		<div class="main-content">
			<div class="page-content">
				<!-- <div class=" row"> -->
					<div class="menu">
						<button class="btn m-b-0-5 addBtn">添 加</button>
						<button class="btn m-b-0-5 signOut">退 出</button>
					</div>
					<div class="table-responsive">
						<table id="grid-table" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>UID</th>
									<th>UserName</th>
									<th>Sex</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Birthday</th>
									<th>Rank</th>
									<th>AddTime</th>
									<th class="text-center"> 操 作 </th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($userLists as $i => $userList): ?>
									<tr id="<? echo $i; ?>">
										<?php foreach ($userList as $key => $info): ?>
										<td class="<?=$key; ?>"><?php echo $info; ?></td>
										<?php endforeach ?>
										<td class="text-center">
											<button class="btn editBtn">修 改</button>
											<button class="btn delBtn">删 除</button>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				<!-- </div> -->
			</div>
		</div>

		<!--模态框-->
		<div class="addModal">
			<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-whatever="@mdo">Open modal for @mdo</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->
			<div class="modal fade" id="addUserInfo" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-style" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="exampleModalLabel">New message</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal">
								<div class="m-b-0-5">
									<label for="UserName" class="control-label">UserName:</label>
									<input type="text" class="form-control" id="UserName">
		 						</div>
								<div class="m-b-0-5">
									<label for="Password" class="control-label">Password:</label>
									<input type="password" class="form-control" id="Password">
		 						</div>
		 						<div class="m-b-0-5">
									<label for="Password2" class="control-label">RePassword:</label>
									<input type="password" class="form-control" id="Password2">
		 						</div>
		 						<div class="m-b-0-5">
		 							<label for="sex" class="control-label">Sex: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<label class="radio-inline"> 
										<input type="radio" name="Sex" class="Sex1" value="1" checked="checked"> 男
									</label>
									<label class="radio-inline">
										<input type="radio" name="Sex" class="Sex2" value="2"> 女
									</label>
		 						</div>
		 						<div class="m-b-0-5">
									<label for="Mobile" class="control-label">Mobile:</label>
									<input type="text" class="form-control" id="Mobile">
		 						</div>
		 						<div class="m-b-0-5">
									<label for="Email" class="control-label">Email:</label>
									<input type="text" class="form-control" id="Email">
		 						</div>
		 						<div class="input-group m-b-0-65 date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						        	<span class="input-group-addon width-6-6 bgc-fff">Birthday</span>
						        	<input class="form-control BirthdayDate bgc-fff" size="16" type="text" value="" readonly="">
						        	<span class="input-group-addon bgc-fff"><span class="fa fa-remove birthdayRemove"></span></span>
						        	<span class="input-group-addon bgc-fff"><span class="fa fa-calendar"></span></span>
						        </div>
						        <div class="input-group m-b-0-65">
									<span class="input-group-addon width-6-6 bgc-fff">Rank</span>
									<select id="Rank" class="form-control">
										<option value ="1">普通会员</option>
										<option value ="2">一级会员</option>
										<option value ="3">二级会员</option>
										<option value ="4">三级会员</option>
										<option value ="5">四级会员</option>
										<option value ="6">五级会员</option>
										<option value ="7">管理员</option>
									</select>
						        </div>
	
								<!-- <div class="m-b-0-5">
									<label for="message-text" class="control-label">Message:</label>
									<textarea class="form-control" id="message-text"></textarea>
								</div> -->
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary confirm addUserinfo">Send message</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--编辑模态框-->
		<div class="editModal">
			<div class="modal fade" id="editUserInfo" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-style" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="EditModalLabel">Edit message</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal">
								<input type="hidden" class="EditId" value="" />
								<div class="m-b-0-5">
									<label for="EditUserName" class="control-label">UserName:</label>
									<input type="text" class="form-control" id="EditUserName">
		 						</div>
		 						<div class="m-b-0-5">
		 							<label for="EditSex" class="control-label">Sex: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<label class="radio-inline"> 
										<input type="radio" name="EditSex" class="EditSex1" value="1" checked="checked"> 男
									</label>
									<label class="radio-inline">
										<input type="radio" name="EditSex" class="EditSex2" value="2"> 女
									</label>
		 						</div>
		 						<div class="m-b-0-5">
									<label for="EditMobile" class="control-label">Mobile:</label>
									<input type="text" class="form-control" id="EditMobile">
		 						</div>
		 						<div class="m-b-0-5">
									<label for="EditEmail" class="control-label">Email:</label>
									<input type="text" class="form-control" id="EditEmail">
		 						</div>
		 						<div class="input-group m-b-0-65 date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						        	<span class="input-group-addon width-6-6 bgc-fff">Birthday</span>
						        	<input class="form-control EditBirthdayDate bgc-fff" size="16" type="text" value="" readonly="">
						        	<span class="input-group-addon bgc-fff"><span class="fa fa-remove EditBirthdayRemove"></span></span>
						        	<span class="input-group-addon bgc-fff"><span class="fa fa-calendar"></span></span>
						        </div>
						        <div class="input-group m-b-0-65">
									<span class="input-group-addon width-6-6 bgc-fff">Rank</span>
									<select id="EditRank" class="form-control">
										<option value ="1">普通会员</option>
										<option value ="2">一级会员</option>
										<option value ="3">二级会员</option>
										<option value ="4">三级会员</option>
										<option value ="5">四级会员</option>
										<option value ="6">五级会员</option>
										<option value ="7">管理员</option>
									</select>
						        </div>
	
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary confirm editUserinfo">Send message</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--END-->

		<script src="/Ci-User/assets/js/jquery-2.1.4.min.js"></script>
		<script src="/Ci-User/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/Ci-User/assets/js/bootstrap-datetimepicker.js"></script>
		<script type="text/javascript">
		$(function(){

			$(".form_date").datetimepicker({
		    	language: 'fr',
		    	format: 'yyyy-mm-dd',
		    	weekStart: 1,
		    	todayBtn: 1,
		    	autoclose: 1,
		    	todayHighlight: 1,
		    	startView: 2,
		    	minView: 2,
		    	forceParse: 0
		    });


		    $(".birthdayRemove").on("click", function() {
				$(".BirthdayDate").val('');
			});

			$(".EditBirthdayRemove").on("click", function() {
				$(".EditBirthdayDate").val('');
			});

			//alert('haha');
			$(".addBtn").on("click", function() {
				$("#UserName").val('');
				$("#Password").val('');
				$("#Password2").val('');
				$(".Sex1").attr("checked", true);
				$("#Mobile").val('');
				$("#Email").val('');
				$(".BirthdayDate").val('1990-01-01');
				$("#Rank").val('1');

				$("#addUserInfo").modal('show');
			});

			$(".editBtn").on("click", function() {
				var tr = $(this).parent().parent();
				//var td = $(this).parent();
				//var id = tr.attr("id");
				var uid = tr.find($(".uid")).text();
				var username = tr.find($(".username")).text();
				//var password = tr.find($(".password")).text();
				var sex = tr.find($(".sex")).text();
				sex = (sex == '男') ? 1 : 2;
				var mobile = tr.find($(".mobile")).text();
				var email = tr.find($(".email")).text();
				var birthday = tr.find($(".birthday")).text();
				var rank = tr.find($(".rank")).text();

				$(".EditId").val(uid);
				$("#EditUserName").val(username);
				//$("#Password").val('');
				console.log(sex);
				//$(".Sex1").attr("checked", true);
				//$("input[name=EditSex]").removeAttr("checked");
				$(":radio[name='EditSex'][value='" + sex + "']").prop("checked", "checked");
				$("#EditMobile").val(mobile);
				$("#EditEmail").val(email);
				$(".EditBirthdayDate").val(birthday);
				$("#EditRank").val(rank);
				//console.log(uid, "<br>", username, "<br>", sex, "<br>", mobile, "<br>", email, "<br>", birthday, "<br>", rank);

				$("#editUserInfo").modal('show');
			})

			$(".addUserinfo").on("click", function(){
				//var uid = $(".uid").val();
				var username = $("#UserName").val();
				var password = $("#Password").val();
				var psd2 = $("#Password2").val();
				var sex = $(":radio[name='Sex']:checked").val();
				var mobile = $("#Mobile").val();
				var email = $("#Email").val();
				var birthday = $(".BirthdayDate").val();
				var rank = $("#Rank").val();

				if (password != psd2) {
					alert("两次密码不一致！");
					return false;
				};

				$.ajax({
					url: "addUserInfo",
					type: "POST",
					data: {"username": username, "password": password, "sex": sex, "mobile": mobile, "email": email, "birthday": birthday, "rank": rank},
					dataType: "JSON",
					success: function(data) {
						if (data.err == 0) {
							$("#addUserInfo").modal('hide');
							alert(data.msg+"新增uid为："+data.con);
							window.location.reload();
						}else{
							alert(data.msg);
						}
					},
					error: function(e) {
						console.log(e);
					}
				});
			});

			$(".editUserinfo").on("click", function() {
				var uid = $(".EditId").val();
				var username = $("#EditUserName").val();console.log(username);
				var sex = $(":radio[name='EditSex']:checked").val();
				var mobile = $("#EditMobile").val();
				var email = $("#EditEmail").val();
				var birthday = $(".EditBirthdayDate").val();
				var rank = $("#EditRank").val();

				$.ajax({
					url: "editUserInfo",
					type: "POST",
					data: {"uid": uid, "username": username, "sex": sex, "mobile": mobile, "email": email, "birthday": birthday, "rank": rank},
					dataType: "JSON",
					success: function(data) {
						if (data.err == 0) {
							$("#editUserInfo").modal('hide');
							alert(data.msg);
							window.location.reload();
						}else{
							alert(data.msg);
						}
					},
					error: function(e) {
						console.log(e);
					}
				});
			});

			$(".delBtn").on("click", function() {
				var tr = $(this).parent().parent();
				var uid = tr.find($(".uid")).text();
				if(window.confirm('你确定要删除吗？')){
	                $.ajax({
						url: "delUserInfo",
						type: "POST",
						data: {"uid": uid},
						dataType: "JSON",
						success: function(data) {
							if (data.err == 0) {
								alert(data.msg);
								window.location.reload();
							} else {
								alert(data.msg);
							}
						},
						error: function(e) {
							console.log(e);
						}
					});

	            }else{
	                return false;
	            }
				
			});

			$(".signOut").on("click", function() {
				
				$.ajax({
					url: "signOut",
					type: "POST",
					data: {},
					dataType: "JSON",
					success: function(data) {
						window.location.href = "adminLogin";
					},
					error: function(e) {
						console.log(e);
					}
				});
			});
			
		});
		</script>
	</body>
</html>