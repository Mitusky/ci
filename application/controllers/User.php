<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}

	//加载用户档案
	public function profile() {

		if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
			exit(json_encode(array('err' => '1', 'msg' => 'Please sign in.', 'con' => '')));
		} else {
			$res = $this->user_model->get_userInfo_byUid($_SESSION['user_id']);
			$username = 'lisi';
			$data = array(
				'uid'		=>	$_SESSION['user_id'],
				'username'	=>	$res['username']
			);
			$this->load->view('user/user_profile', $data);
		}
	}

	//注册
	public function register() {
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		if (empty($username) || empty($password)) {
			exit(json_encode(array('err' => '1', 'msg' => '用户名和密码不能为空', 'con' => '')));
		}

		$res = $this->user_model->get_userInfo_byUsername($username);
		if ($res) {
			exit(json_encode(array('err' => '1', 'msg' => '用户已存在', 'con' => '')));
		} else {
			$res2 = $this->user_model->insert_user($username, md5($password));
			$uid = $this->db->insert_id();
			if($res2) {
				//存入session
				$arr = array(
					'user_id'	=>	$res['uid'],
					'user_name'	=>	$res['username']
				);
				$this->session->set_userdata($arr);

				$data = array(
					'username'	=>	$username,
					'content'	=>	'注册成功！'
				);
				$this->load->view('index', $data);
			} else {
				exit(json_encode(array('err' => '1', 'msg' => '注册失败！', 'con' => '')));
			};
		}
	}

	//登录
	public function signIn() {
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		if (empty($username) || empty($password)) {
			exit(json_encode(array('err' => '1', 'msg' => '用户名和密码不能为空', 'con' => '')));
		}

		$password = md5($password);
		$res = $this->user_model->get_userInfo_byNameAndPsd($username, $password);
		if ($res) {
			//存入session
			$arr = array(
				'user_id'	=>	$res['uid'],
				'user_name'	=>	$res['username']
			);
			$this->session->set_userdata($arr);
			//传给前台
			$data = array(
				'uid'		=>	$res['uid'],
				'username'	=>	$res['username']
			);
			$this->load->view('index', $data);
		} else {
			exit(json_encode(array('err' => '1', 'msg' => '用户名或密码错误', 'con' => '')));
		}
	}

	//修改密码
	public function modfiyInfo() {
		$uid = $this->session->userdata('user_id');
		$username = $this->session->userdata('user_name');

		if(!isset($uid) || empty($uid)){
			exit(json_encode(array('err' => '1', 'msg' => 'Please sign in.', 'con' => '')));
		}

		$oldpsd = $this->input->post('oldpsd', TRUE);
		$newpsd = $this->input->post('newpsd', TRUE);

		if (empty($oldpsd) || empty($newpsd)) {
			exit(json_encode(array('err' => '1', 'msg' => '原密码和新密码不能为空', 'con' => '')));
		}

		$oldpsd = md5($oldpsd);
		$newpsd = md5($newpsd);
		$res = $this->user_model->get_userInfo_byNameAndPsd($username, $oldpsd);
		if ($res) {
			$res2 = $this->user_model->update_userinfo($uid, $newpsd);
			if ($res2) {
				$this->load->view('index', $data);
				exit(json_encode(array('err' => '0', 'msg' => '修改成功！', 'con' => '')));
			} else {
				exit(json_encode(array('err' => '1', 'msg' => '修改失败！', 'con' => '')));
			}
			$data = array(
				'username'	=>	$username
			);
			$this->load->view('index', $data);
		} else {
			exit(json_encode(array('err' => '1', 'msg' => '密码错误', 'con' => '')));
		}

	}

	//退出
	public function signOut() {
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_name');
		$this->load->view('index');
	}
}