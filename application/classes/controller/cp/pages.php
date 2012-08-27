<?php defined('SYSPATH') or die('Hacking attemp!');

class Controller_CP_Pages extends Controller_Template
{

    public function action_index()
    {
        $this->template->page_title = 'List of pages';
        $view                       = View::factory('cp/pages/list');
        $page                       = new Model_Page();
        $view->pages                = $page->get_pages();
        $this->template->content    = $view->render();
    }

    public function action_edit()

    {
        $page_id = $this->request->param('id');

        if (!$page_id) {
            throw new Exception('ID must be set!');
        }

        $this->template->page_title = 'Edit page #' . $page_id;
        $view                       = View::factory('cp/pages/edit');
        $page                       = new Model_Page();
        $pages                       = $page->get_page_by_id($page_id);

        if (!$pages) {
            throw new Exception('Not found!');
        }

        if ($this->request->method() === Request::POST) {

            if (!Security::check($this->request->post('csrf_token'))) {

                throw new HTTP_Exception_401("Bad token!");
            }

            $post_title   = $this->request->post('title');
            $post_content = $this->request->post('content');

            $data         = array(
                'title'   => $post_title,
                'content' => $post_content,
                );

            $update_page  = $page->update_page($data, $page_id);

            if (!$update_page) {
                throw new Exception('Check fields!');
            }

            Session::instance()->set('Page.success', true);
            $this->request->redirect('cp/pages/edit/' . $page_id);

        }

        $view->pages             = $pages;
        $view->success           = Session::instance()->get_once('Page.success');
        $this->template->content = $view->render();

    }

    public function action_delete()
    {
        $this->template->page_title = 'Delete Page';
        $page_id                    = $this->request->param('id');

        if (!$page_id) {
            throw new Exception('ID must not be empty!');
        }

        $page        = new Model_Page();
        $delete_page = $page->delete_page($page_id);

        if (!$delete_page) {
            throw new Exception('Error with deleting page!');
        }

        $this->request->redirect('cp/pages');
    }

    public function action_create()
    {
        $this->template->page_title = 'Create Page';
        $user                       = new Model_User();
        $session                    = Session::instance()->get('user');
        $view                       = View::factory('cp/pages/create');
        $view->author               = $user->get_user_by_session_id($session);

        if ($this->request->method() === Request::POST) {
            if (!Security::check($this->request->post('csrf_token'))) {

                throw new HTTP_Exception_401("Bad token!");
            }
            $post_title   = $this->request->post('title');
            $post_content = $this->request->post('content');
            $post_author  = $this->request->post('author');
            $post_date    = time();

            if (
                empty($post_title) &&
                empty($post_content) &&
                empty($post_author) &&
                empty($post_date
                    ))
            {
                throw new Exception('Please don`t make empty fields!');
            }

            $page        = new Model_Page();

            $data        = array(
                'title' => $post_title,
                'content' => $post_content,
                'author'  => $post_author,
                'date'    => $date,
                );

            $insert_page = $page->insert_page($data);

            if (!$insert_page) {
                throw new Exception('Check if you are connected to database!');
            }

            $this->request->redirect('cp/pages');

        }

        $this->template->content = $view->render();

    }

}
