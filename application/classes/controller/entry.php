<?php defined('SYSPATH') or die('Fuck you!');

class Controller_Entry extends Controller_Template{
    public function action_view(){
        $entry_id = $this->request->param('id');
        $slug = $this->request->param('slug');
        if(!$entry_id){
            throw new Exception('ID must not be empty!');
        }
        
        $model_for_entries = Model::factory('entry');
        $get_entry = $model_for_entries->get_entry_by_id($entry_id);
        $this->template->page_title = 'Entry #'.$entry_id;
        if(!$get_entry){
            throw new Exception('There is not any entry with this ID!');
        }
        $view = View::factory('entries/view');
        $view->entries = $get_entry;
        $this->template->content = $view->render();
    }
}