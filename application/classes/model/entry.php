<?php defined('SYSPATH') or die ('Hacking attemp! :)');

class Model_Entry extends Model {
    public function insert_entry($title, $slug, $content,$author,$date){
        $query = db::insert('entries', array('title','slug','content', 'author','date'))->values(array($title, $slug, $content, $author, $date))->execute();
        return $query;
    }
    public function get_entries($limit, $offset){
        return $query = db::select()->from('entries')->order_by('id', 'DESC')->limit($limit)->offset($offset)->execute()->as_array();
    }
    public function get_entries_list(){
        return $query = DB::select()->from('entries')->order_by('id', 'DESC')->execute()->as_array();
    }
    public function delete_entry($id){
        return $query = db::delete('entries')->where('id', '=', array($id))->execute();
    }
    public function get_entry_by_id($id){
        return $query = db::select()->from('entries')->where('id', '=', array($id))->as_object()->execute();
    }
    public function update_entry($title,$content,$id){
        return $query = DB::update('entries')->set(array('title' => $title, 'content' => $content))->where('id', '=', $id)->execute();
    }
    public function get_count(){
        return $query = DB::select(array('COUNT("*")','count'))->from('entries')->execute()->get('count');
        
    }
}
