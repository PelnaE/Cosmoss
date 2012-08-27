<?php defined('SYSPATH') or die('Hacking attemp!');

class Model_Page extends Model {
    public function create_page($title,$content){
        return $query = DB::insert('pages', array('title', 'content'))->values(array($title,$content))->execute();
    }
    public function get_pages(){
        return $query = DB::select()->from('pages')->order_by('id', 'DESC')->execute();
    }
    public function get_page_by_id($page_id){
        return $query = DB::select()->from('pages')->where('id', '=', $page_id)->execute();
    }
    public function update_page($title,$content,$id){
        return $query = DB::update('pages')->set(array('title' => $title, 'content' => $content))->where('id', '=', $id)->execute();
    }
    public function delete_page($id){
        return $query = db::delete('pages')->where('id', '=', array($id))->execute();
    }
    public function insert_page($title,$content,$author,$date){
        $query = db::insert('pages', array('title','content', 'author','date'))->values(array($title, $content, $author, $date))->execute();
        return $query;
    }
}