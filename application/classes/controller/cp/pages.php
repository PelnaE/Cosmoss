<?php

defined('SYSPATH') or die('Hacking attemp!');

class Controller_CP_Pages extends Controller_Template {

    public function action_index() {
        $this->template->page_title = 'List of pages';
        $view = View::factory('cp/pages/list');
        $model_for_pages = Model::factory('page');
        $get_pages = $model_for_pages->get_pages();
        $view->pages = $get_pages;
        $this->template->content = $view->render();
    }

    public function action_edit() {
        $page_id = $this->request->param('id');
        if (!$page_id) {
            throw new Exception('ID must be set!');
        }
        $this->template->page_title = 'Edit page #' . $page_id;
        $view = View::factory('cp/pages/edit');
        $model_for_entries = Model::factory('page');
        $pages = $model_for_entries->get_page_by_id($page_id);
        if (!$pages) {
            throw new Exception('Not found!');
        }
        if ($this->request->method() === Request::POST) {
            if (!Security::check($this->request->post('csrf_token'))) {

                throw new HTTP_Exception_401("Bad token!");
            }
            $post_title = $this->request->post('title');
            $post_content = $this->request->post('content');
            $update_page = $model_for_entries->update_page($post_title, $post_content, $page_id);
            if (!$update_page) {
                throw new Exception('Check fields!');
            }
            Session::instance()->set('Page.success', true);
            $this->request->redirect('cp/pages/edit/' . $page_id);
        }
        $view->pages = $pages;
        $view->success = Session::instance()->get_once('Page.success');
        $this->template->content = $view->render();
    }

    public function action_delete() {
        $this->template->page_title = 'Delete Page';
        $page_id = $this->request->param('id');

        if (!$page_id) {
            throw new Exception('ID must not be empty!');
        }
        $model_for_pages = Model::factory('page');
        $delete_page = $model_for_pages->delete_page($page_id);
        if (!$delete_page) {
            throw new Exception('Error with deleting page!');
        }
        $this->request->redirect('cp/pages');
    }

    public function action_create() {
        $this->template->page_title = 'Create Page';
        $model_for_users = Model::factory('user');
        $session = Session::instance();
        $user_session = $session->get('user');
        $author_name = $model_for_users->get_user_by_session_id($user_session);
        $view = View::factory('cp/pages/create');
        $view->author = $author_name;

        if ($this->request->method() === Request::POST) {
            if (!Security::check($this->request->post('csrf_token'))) {

                throw new HTTP_Exception_401("Bad token!");
            }
            $post_title = $this->request->post('title');
            $post_content = $this->request->post('content');
            $post_author = $this->request->post('author');
            $post_date = time();
            if (empty($post_title) and empty($post_content) and empty($post_author) and empty($post_date)) {
                throw new Exception('Please don`t make empty fields!');
            }
            $model_for_pages = Model::factory('page');
            $insert_page = $model_for_pages->insert_page($post_title, $post_content, $post_author, $post_date);
            if (!$insert_page) {
                throw new Exception('Check if you are connected to database!');
            }
            $this->request->redirect('cp/pages');
        }
        $this->template->content = $view->render();
    }

}