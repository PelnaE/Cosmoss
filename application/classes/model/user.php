<?php defined('SYSPATH') or die('Hacking attemp!');

class Model_User extends Model
{
    public function check_user_data($nick,$password)
    {
        return DB::select()
        ->from('users')
        ->where('nick', '=', $nick)
        ->and_where('password', '=', $password)
        ->execute();
    }

    public function get_user_by_session_id($nick)
    {
        return DB::select('name')
        ->from('users')
        ->where('nick', '=', $nick)
        ->execute();
    }
}
