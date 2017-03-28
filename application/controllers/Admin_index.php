<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_index extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        //$this->load->library('parser');
    }

    public function index() {
        $userLists = $this->userList();
        if ($userLists === false) {
            $this->load->view('admin_login');
        } else {
            //$this->parser->parse('admin_index2', array('userList' => $userList));
            $this->load->view('admin_index2', array('userLists' => $userLists));
        }
    }

    public function adminLogin() {
        /*$this->session->unset_userdata('ad_id');
        $this->session->unset_userdata('ad_name');*/
        $ad_id = $this->session->userdata('ad_id');
        /*if (isset($_SESSION['ad_id']) && $_SESSION['ad_id'] == '-1') {
            $this->load->view('admin_login');
            //return;
        }*/

        $ad_name = $this->input->post('ad_name', TRUE);
        $ad_psd = $this->input->post('ad_psd', TRUE);
        //$this->session->unset_userdata('ad_id');
//var_dump($_SESSION['ad_id']);
        if (!isset($_SESSION['ad_id']) && empty($ad_name) && empty($ad_psd)) {
            $this->load->view('admin_login');
            return;
        } elseif ((isset($_SESSION['ad_id']) && $_SESSION['ad_id'] == '-1') && (empty($ad_name) || empty($ad_psd))) {
            exit(json_encode(array('err' => '1', 'msg' => '用户名和密码不能为空', 'con' => '')));
        }

        $ad_psd = md5($ad_psd);
        $res = $this->user_model->check_adminInfo($ad_name, $ad_psd);

        if ($res) {
            //存入session
            $arr = array(
                'ad_id'     =>  $res['uid'],
                'ad_name'   =>  $res['username']
            );
            $this->session->set_userdata($arr);

            $userLists = $this->userList();
            
            //传给前台
            $data = array(
                'ad_id'     =>  $res['uid'],
                'ad_name'   =>  $res['username']
            );
            $data['userLists'] = $userLists !== false ? $userLists : '';

            //$this->parser->parse('admin_index2', $data);
            $this->load->view('admin_index2', $data);
        } else {
            $arr = array(
                'ad_id'     =>  '-1'
            );
            $this->session->set_userdata($arr);
            exit(json_encode(array('err' => '1', 'msg' => '用户名或密码错误', 'con' => '')));
        }
    }

    public function userList() {
        $ad_name = $this->session->userdata('ad_name');
        if(empty($ad_name)) {
            return false;
        } else {
            $userLists = $this->user_model->get_userList();
            foreach ($userLists as $key => $userList) {
                $userLists[$key]['sex'] = ($userList['sex'] == '1') ? '男' : '女';
            }
            //var_dump($userList);
            //$R= json_encode(array('err' => '0', 'msg' => '', 'con' => $userLists));
            //var_dump($R);
            //return $R;
            return $userLists;
        }
    }

    //管理员添加用户
    public function addUserInfo() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $sex      = $this->input->post('sex', TRUE);
        $mobile   = $this->input->post('mobile', TRUE);
        $email    = $this->input->post('email', TRUE);
        $birthday = $this->input->post('birthday', TRUE);
        $rank     = $this->input->post('rank', TRUE);

        if (empty($username) || empty($password)) {
            exit(json_encode(array('err' => '1', 'msg' => '用户名和密码不能为空', 'con' => '')));
        }
        if (empty($mobile)) {
            exit(json_encode(array('err' => '1', 'msg' => '手机号码不能为空', 'con' => '')));
        }
        if (empty($email)) {
            exit(json_encode(array('err' => '1', 'msg' => '邮箱不能为空', 'con' => '')));
        }

        $mb = $this->is_mobile($mobile);
        if(!$mb){  
            exit(json_encode(array('err'=>-1,'msg'=>'不是合法的手机号码！')));  
        }

        $em = $this->is_email($email);
        if (!$em) {
            exit(json_encode(array('err'=>-1,'msg'=>'电子邮件格式不正确！')));
        }

        $res = $this->user_model->get_userInfo_byUsername($username);
        $res2 = $this->user_model->get_userInfo_byMobile($mobile);
        if ($res) {
            exit(json_encode(array('err' => '1', 'msg' => '用户已存在', 'con' => '')));
        } elseif($res2) {
            exit(json_encode(array('err' => '1', 'msg' => '手机号码已存在', 'con' => '')));
        } else {
            $res3 = $this->user_model->insert_user($username, md5($password), $sex, $mobile, $email, $birthday, $rank);
            if($res3 > 0) {
                exit(json_encode(array('err' => '0', 'msg' => '添加成功！', 'con' => $res3)));
            } else {
                exit(json_encode(array('err' => '1', 'msg' => '添加失败！', 'con' => '')));
            };
        }
    }

    public function editUserInfo() {//var_dump('expression');
        $uid      = $this->input->post('uid', TRUE);
        $username = $this->input->post('username', TRUE);
        $sex      = $this->input->post('sex', TRUE);
        $mobile   = $this->input->post('mobile', TRUE);
        $email    = $this->input->post('email', TRUE);
        $birthday = $this->input->post('birthday', TRUE);
        $rank     = $this->input->post('rank', TRUE);
        
        if (empty($uid) || empty($username) || empty($sex) || empty($mobile) || empty($email) || empty($birthday) || empty($rank)) {
            exit(json_encode(array('err' => '1', 'msg' => '修改字段不能为空！', 'con' => '')));
        }

        $res = $this->user_model->ad_update_userinfo($uid, $username, $sex, $mobile, $email, $birthday, $rank);
        //echo $this->db->last_query();
        if ($res) {
            $userList = $this->userList();
            //$this->parser->parse('admin_index2', array('userList' => $userList));
            //$this->load->view('admin_index2', array('userList' => $userList));
            exit(json_encode(array('err' => '0', 'msg' => '修改成功！', 'con' => '')));
        } else {
            exit(json_encode(array('err' => '1', 'msg' => '修改失败！', 'con' => '')));
        }
    }

    public function delUserInfo() {
        $uid      = $this->input->post('uid', TRUE);
        $res = $this->user_model->del_user($uid);
        if($res) {
            exit(json_encode(array('err' => '0', 'msg' => '删除成功！', 'con' => '')));
        } else {
            exit(json_encode(array('err' => '1', 'msg' => '删除失败！', 'con' => '')));
        }
    }

    //退出
    public function signOut() {
        $this->session->unset_userdata('ad_id');
        $this->session->unset_userdata('ad_name');
        exit(json_encode(array('err' => '0', 'msg' => '', 'con' => 'admin_login')));
    }

    //验证手机号码是否合法
    public function is_mobile($mobile) {
        return preg_match('/^1[34578]\d{9}$/', $mobile);
    }

    //验证邮箱是否合法
    public function is_email($email){
        $regex = '/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[-_a-z0-9][-_a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})$/i';  
        return preg_match($regex, $email);
    }
}