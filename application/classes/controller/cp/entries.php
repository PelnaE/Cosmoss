<?php

defined('SYSPATH') or die('Hacking attemp!');

class Controller_CP_Entries extends Controller_Template {

    public function action_index()
    {
        $this->template->page_title = 'List of Entries';
        $entry                      = new Model_Entry();
        $view                       = View::factory('cp/entries/list');
        $view->entries              = $entry->get_entries_list();
        $this->template->content    = $view->render();
    }

    public function action_edit()
    {
        $this->template->page_title = 'Edit Entry';
        $entry_id                   = $this->request->param('id');
        $view                       = View::factory('cp/entries/edit');

        if (empty($entry_id)) {
            throw new Exception('ID must not be empty!');
        }

        $entry = new Model_Entry();
        $entry = $entry->get_entry_by_id($entry_id);

        if (!$entry) {
            throw new Exception('Not found!');
        }

        if ($this->request->method() === Request::POST) {
             if (!Security::check($this->request->post('csrf_token'))) {

                throw new HTTP_Exception_401("Bad token!");
            }
            $post_title = $this->request->post('title');
            $post_content = $this->request->post('content');
            $data         = array(
                'title' => $post_title,
                'content' => $post_content,
                );

            $update_entry = $entry->update_entry($data, $entry_id);

            if (!$update_entry) {
                throw new Exception('Check fields!');
            }

            Session::instance()->set('Entry.success', true);

            $this->request->redirect('cp/entries/edit/' . $entry_id);

        }

        $view->entries           = $entry;
        $view->success           = Session::instance()->get_once('Entry.success');
        $this->template->content = $view->render();
    }

    public function action_delete()
    {

        $this->template->page_title = 'Delete Entry';

        $entry_id = $this->request->param('id');

        if (!$entry_id) {
            throw new Exception('ID must not be empty!');
        }

        $entry = new Model_Entry();

        if (!Security::check($this->request->param('id2'))) {

                throw new HTTP_Exception_401("Bad token!");
            }
        $delete_entry = $entry->delete_entry($entry_id);

        if (!$delete_entry) {
            throw new Exception('Error with deleting entry!');
        }

        $this->request->redirect('cp/entries');

    }

    public function action_write()
    {

        $this->template->page_title = 'Write Article';

        $user         = new Model_User();
        $session      = Session::instance()->get('user');
        $view         = View::factory('cp/entries/write');
        $view->author = $users->get_user_by_session_id($session);

        if ($this->request->method() === Request::POST) {

            if (!Security::check($this->request->post('csrf_token'))) {

                throw new HTTP_Exception_401("Bad token!");
            }

            $post_title = $this->request->post('title');
            $post_slug = $this->request->post('slug');
            $post_content = $this->request->post('content');
            $post_author = $this->request->post('author');
            $post_date = time();

            if (empty($post_title) and empty($post_content) and empty($post_author) and empty($post_date)) {
                throw new Exception('Please don`t make empty fields!');
            }

            if(empty($post_slug)){
                $post_slug = URL::title($post_title, '_');
            }

            $entry = new Model_Entry();

            $data         = array(
                'title'   => $post_title,
                'slug'    => $post_slug,
                'content' => $post_content,
                'author'  => $post_author,
                'date'    => $post_date
                );

            $insert_entry = $entry->insert_entry($data);
            if (!$insert_entry) {
                throw new Exception('Check if you are connected to database!');
            }
            $this->request->redirect('cp/entries/write/');
        }
        $this->template->content = $view->render();
    }

}
