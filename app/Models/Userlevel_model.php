<?php namespace App\Admin\Models;

use CodeIgniter\Model;

/**
* 
*/
class Userlevel_model extends Model
{
	protected $table = 'tbl_userlevel';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['user_level','menu_id'];

    public function insertUserlevel($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function deleteUserlevel($user_level,$menu_id)
    {
        $query = $this->table($this->table)
                ->where('user_level',$user_level)
                ->where('menu_id',$menu_id)
                ->delete();
        return $query ? true : false;
    }
}