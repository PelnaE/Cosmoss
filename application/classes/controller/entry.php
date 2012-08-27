<?php defined('SYSPATH') or die('Fuck you!');

class Controller_Entry extends Controller_Template
{
    public function action_view()
    {
        $entry_id                   = $this->request->param('id');
        $this->template->page_title = 'Entry #'.$entry_id;
        $slug                       = $this->request->param('slug');

        if (!$entry_id) {
            throw new Exception('ID must not be empty!');
        }

        $entry         = new Model_Entry();
        $view          = View::factory('entries/view');
        $view->entries = $entry->get_entry_by_id($entry_id);

        if (!$view->entries) {
            throw new Exception('There is not any entry with this ID!');
        }

        $this->template->content = $view->render();
    }
}
