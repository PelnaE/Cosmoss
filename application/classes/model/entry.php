<?php defined('SYSPATH') or die ('Hacking attemp! :)');

class Model_Entry extends Model
{

    public function insert_entry(array $data)
    {
        return DB::insert('entries', array_keys($data))
        ->values(array_values($data))
        ->execute();
    }

    public function get_entries($limit, $offset)
    {
        return DB::select()
        ->from('entries')
        ->order_by('id', 'DESC')
        ->limit($limit)
        ->offset($offset)
        ->execute()
        ->as_array();
    }

    public function get_entries_list()
    {
        return DB::select()
        ->from('entries')
        ->order_by('id', 'DESC')
        ->execute()
        ->as_array();
    }

    public function delete_entry($id)
    {
        return DB::delete('entries')
        ->where('id', '=', array($id))
        ->execute();
    }

    public function get_entry_by_id($id)
    {
        return DB::select()
        ->from('entries')
        ->where('id', '=', array($id))
        ->as_object()
        ->execute();
    }

    public function update_entry($title,$content,$id)
    {
        return DB::update('entries')
        ->set(array('title' => $title, 'content' => $content))
        ->where('id', '=', $id)
        ->execute();
    }

    public function get_count()
    {
        return DB::select(array('COUNT("*")','count'))
        ->from('entries')
        ->execute()
        ->get('count');
    }

}
