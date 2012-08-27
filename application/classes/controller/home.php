<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Template
{

    public function action_index()
    {
    	$pagination                 = Pagination::factory(array(
    		'total_items'    => Model::factory('entry')->get_count(),
    		'items_per_page' => 2,
    		'view'           => 'pagination/digg'
    		));
    	$this->template->page_title = 'Home, exacly! :)';
    	$entry                      = new Model_Entry();
    	$view                       = View::factory('home/main');
    	$view->entries              = $entry->get_entries(
            $pagination->items_per_page,
            $pagination->offset
            );
    	$view->pagination           = $pagination;
    	$this->template->content    = $view->render();
    }

}
