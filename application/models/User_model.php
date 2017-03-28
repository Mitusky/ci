<?php 

class User_model extends CI_Model {
	public $uid;
	public $username;
	public $password;
	public $mobile;
	public $email;
	Public $birthday;
	public $rank;
	public $add_time;

	public $ad_name;
	public $ad_psd;

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //通过用户ID获取用户信息
	public function get_userInfo_byUid($uid)
	{
		$this->uid = $uid;

		$this->db->select('uid, username, sex, mobile, email, birthday, rank, add_time');
		$this->db->where('uid', $uid);
		$query = $this->db->get('user');

		/*$sql = "SELECT `uid`, `username`, `sex`, `mobile`, `email`, `birthday`, `rank`, `add_time` FROM `user` WHERE uid = ?";
		$query = $this->db->query($sql, array($uid));*/
		
		$row = $query->row_array();
		/*foreach ($query->result() as $row)
		{
			$arr = array(
				'uid'		=>	$row->uid,
				'username'	=>	$row->username,
				'mobile'	=>	$row->mobile,
				'email'		=>	$row->email,
				'birthday'	=>	$row->birthday,
				'rank'		=>	$row->rank,
				'add_time'  => $row->add_time
			);
		}*/
		return $row;
	}

	//通过用户名获取用户信息
	public function get_userInfo_byUsername($username)
	{
		$this->username = $username;

		/*$sql = "SELECT `uid`, `username`, `sex`, `mobile`, `email`, `birthday`, `rank`, `add_time` FROM `user` WHERE username = ?";
		$query = $this->db->query($sql, array($username));*/

		$this->db->select('uid, username, sex, mobile, email, birthday, rank, add_time');
		$this->db->where('username', $username);
		$query = $this->db->get('user');

		$row = $query->row_array();
		return $row;
	}

	//通过手机号码获取用户信息
	public function get_userInfo_byMobile($mobile)
	{
		$this->mobile = $mobile;

		/*$sql = "SELECT `uid`, `username`, `sex`, `mobile`, `email`, `birthday`, `rank`, `add_time` FROM `user` WHERE mobile = ?";
		$query = $this->db->query($sql, array($mobile));*/

		$this->db->select('uid, username, sex, mobile, email, birthday, rank, add_time');
		$this->db->where('mobile', $mobile);
		$query = $this->db->get('user');

		$row = $query->row_array();
		return $row;
	}

	//通过用户名和密码获取用户信息
	public function get_userInfo_byNameAndPsd($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
		/*$sql = "SELECT `uid`, `username`, `sex`, `mobile`, `email`, `birthday`, `rank`, `add_time` FROM `user` WHERE username = ? AND password = ?";
		$query = $this->db->query($sql, array($username, $password));*/

		$where = array(
			'username'	=> $username,
			'password'	=> $password
		);
		$this->db->select('uid, username, sex, mobile, email, birthday, rank, add_time');
		$this->db->where($where);
		$query = $this->db->get('user');

		$row = $query->row_array();
		return $row;
	}

	//插入用户信息
	public function insert_user($username, $password, $sex, $mobile, $email, $birthday, $rank)
	{
		$this->username = $username;
		$this->password = $password;
		$this->sex = $sex;
		$this->mobile = $mobile;
		$this->email = $email;
		$this->birthday = $birthday;
		$this->rank = $rank;
		$this->add_time = date("Y-m-d h:i:s");

		$data = array(
			'username'	=> $this->db->escape($username),
    		'password'	=> $this->db->escape($password),
    		'sex'		=> $this->db->escape($sex),
    		'mobile'	=> $this->db->escape($mobile),
    		'email'		=> $this->db->escape($email),
    		'birthday'	=> $this->db->escape($birthday),
    		'rank'		=> $this->db->escape($rank),
    		'add_time'	=> $this->db->escape($this->add_time)
		);
		
		$res = $this->db->insert('user', $data) > 0 ? $this->db->insert_id() : false;

		/*$sql = "INSERT INTO `user` (`username`, `password`, `sex`, `mobile`, `email`, `birthday`, `rank`, `add_time`) VALUES (" . $this->db->escape($username) . ", " .
			$this->db->escape($password) . ", " . $this->db->escape($sex) . ", " . $this->db->escape($mobile) . ", " . $this->db->escape($email) . ", "  . $this->db->escape($birthday) . 
			", " . $this->db->escape($rank) . ", " . $this->db->escape($this->add_time) . ")";
		$res = $this->db->query($sql) > 0 ? $this->db->insert_id() : false;*/
		return $res;
	}

	//修改用户密码
	public function update_userinfo($uid, $newpsd)
	{
		$this->uid = $uid;
		$this->password = $newpsd;

		$data = array('password' => $newpsd);
		$where = array('uid' => $uid);
		$res = $this->db->update('user', $data, $where) >= 0 ? true : false;

		/*$sql = "UPDATE `user` SET `password` = ? WHERE `uid` = '$uid'";
		$res = $this->db->query($sql, array($newpsd)) >= 0 ? true : false;*/
		return $res;
	}

	//删除用户信息
	public function del_user($uid)
	{
		$this->uid = $uid;

		/*$sql = "DELETE FROM `user` WHERE `uid` = ? AND `rank` < '8'";
		$res = $this->db->query($sql, array($uid)) > 0 ? true : false;*/

		$where = array(
			'uid'	=>	$uid,
			'rank <'=>	'8'
		);
		$res = $this->db->delete('user', $where) > 0 ? true : false;

		return $res;
	}

	//获取用户列表
	public function get_userList()
	{
		/*$sql = "SELECT `uid`, `username`, `password`, `sex`, `mobile`, `email`, `birthday`, `rank`, `add_time` FROM `user` WHERE rank < '8'";
		$query = $this->db->query($sql);*/

		$this->db->select('uid, username, password, sex, mobile, email, birthday, rank, add_time');
		$this->db->where('rank < ', '8');
		$query = $this->db->get('user');

		foreach ($query->result() as $row) {
			$arr[$row->uid] = array(
				'uid'		=>	$row->uid,
				'username'	=>	$row->username,
				//'password'	=>	$row->password,
				'sex'		=>	$row->sex,
				'mobile'	=>	$row->mobile,
				'email'		=>	$row->email,
				'birthday'	=>	$row->birthday,
				'rank'		=>	$row->rank,
				'add_time'	=>	$row->add_time
			);
		}
		return $arr;
	}

	//校验管理员账号
	public function check_adminInfo($ad_name, $ad_psd)
	{
		$this->ad_name = $ad_name;
		$this->ad_psd = $ad_psd;
		/*$sql = "SELECT `uid`, `username` FROM `user` WHERE username = ? AND password = ? AND rank = '8'";
		$query = $this->db->query($sql, array($ad_name, $ad_psd));*/

		$where = array(
			'username'	=>	$ad_name,
			'password'	=>	$ad_psd,
			'rank = '	=>	'8'
		);
		$this->db->select('uid, username');
		$this->db->where($where);
		$query = $this->db->get('user');

		$row = $query->row_array();
		return $row;
	}

	//管理员修改用户信息
	public function ad_update_userinfo($uid, $username, $sex, $mobile, $email, $birthday, $rank)
	{
		$this->uid = $uid;
		$this->username = $username;
		$this->sex = $sex;
		$this->mobile = $mobile;
		$this->email = $email;
		$this->birthday = $birthday;
		$this->rank = $rank;

		$data = array(
			'username'  => $username,
			'sex'		=> $sex,
			'mobile'	=> $mobile,
			'email'		=> $email,
			'birthday'	=> $birthday,
			'rank'		=> $rank
		);
		$where = array(
			'uid'		=> $uid,
			'rank <'	=>	'8'
		);
		$res = $this->db->update('user', $data, $where) >= 0 ? true : false;

		/*$sql = "UPDATE `user` SET `username` = ? , `sex` = ? , `mobile` = ? , `email` = ? , `birthday` = ? , `rank` = ? WHERE rank < '8' AND uid = ? ";
		$res = $this->db->query($sql, array($username, $sex, $mobile, $email, $birthday, $rank, $uid)) >= 0 ? true : false;*/
		return $res;
	}
}


