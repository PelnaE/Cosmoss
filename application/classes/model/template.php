<?php defined('SYSPATH') or die('Fuck you!');

class Controller_Template extends Kohana_Controller_Template {
    public $template = 'templates/default';
    function before(){
        parent::before();
        $config = Kohana::$config->load('common');
        $this->template->site_name = $config->site_name;
        $this->template->stylesheets = $config->stylesheets;
        $this->template->scripts = $config->scripts;
    }
}