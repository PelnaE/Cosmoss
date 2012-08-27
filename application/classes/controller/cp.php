<?php

defined('SYSPATH') or die('Fuck you!');

class Controller_CP extends Controller_Template {

    public function action_index() {
        $this->template->page_title = 'Admin CP';
        $this->template->content = View::factory('cp/home');
    }

    public function action_sign_out() {
        $this->template->page_title = 'Logout';
        $session = Session::instance();
        $user_session = $session->get('user');
        if (empty($user_session)) {
            throw new Exception('Login to logout!');
        }
        $session->delete('user');
        $this->request->redirect('cp');
    }

    public function action_sign_in() {
        $this->template->page_title = 'Sign In';
        $post_nick = $this->request->post('nick');
        $post_password = $this->request->post('password');
        $post_cookie = $this->request->post('cookie');
        if (empty($post_nick) and empty($post_password)) {
            throw new Exception('Please input your nick and password!');
        }
        $model_for_user = Model::factory('user');
        $check_user_data = $model_for_user->check_user_data($post_nick, $post_password);
        if (!$check_user_data) {
            throw new Exception('Check you login data!');
        }
        Session::instance()->set('user', $post_nick);
        if(!empty($post_cookie)){
        Cookie::set('user', $post_nick);
        }
        $this->request->redirect('cp');
    }    

}