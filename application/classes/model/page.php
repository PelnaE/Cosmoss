<?php defined('SYSPATH') or die('Hacking attemp!');

class Model_Page extends Model
{
    public function create_page($title,$content)
    {
        return DB::insert('pages', array('title', 'content'))
        ->values(array($title,$content))
        ->execute();
    }

    public function get_pages()
    {
        return DB::select()->from('pages')
        ->order_by('id', 'DESC')
        ->execute();
    }

    public function get_page_by_id($page_id)
    {
        return DB::select()
        ->from('pages')
        ->where('id', '=', $page_id)
        ->execute();
    }

    public function update_page(array $data, $id)
    {
        return DB::update('pages')
        ->set($data)
        ->where('id', '=', $id)
        ->execute();
    }

    public function delete_page($id)
    {
        return DB::delete('pages')
        ->where('id', '=', array($id))
        ->execute();
    }

    public function insert_page(array $data)
    {
        return DB::insert('pages', array_keys($data))
        ->values(array_values($data))
        ->execute();
    }
}
