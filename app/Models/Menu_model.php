<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Menu_model extends Model
{
	protected $table = 'menus';

    public function getMenus($id){
        $data=array();
        $query = $this->db->table('userlevel')
                 ->select('menu_id')
                 ->where('user_level',$id)
                 ->get();
        foreach ($query->getResultArray() as $row)
        {
            $data[] =$row['menu_id'];
        }
		$result = $this->table($this->table)
                ->whereIn('_id', $data)
                ->where('is_aktif',1)
                ->orderBy('order','ASC')
                ->get();

        return $result;
	}

    public function getIndukMenu($id){
        $result = $this->table($this->table)
                ->where('is_main', $id)
                ->where('is_aktif',1)
                ->orderBy('order','ASC')
                ->get();

        return $result;
    }

	public function getSubMenus($id, $is_main)
	{
		$result = $this->table($this->table)
                ->select('*')
                ->join('userlevel','menus._id=userlevel.menu_id','INNER')
                ->where('userlevel.user_level', $id)
                ->where('menus.is_main', $is_main)
                ->where('is_aktif',1)
                ->orderBy('menus.order','ASC')
                ->get();
        return $result;
	}
   
   public function getMenuPermission()
    {
        $result = $this->table($this->table)
                ->Where('is_aktif',1)
                ->orderBy('_id','ASC')
                ->get();
        return $result;
    }

    public function getPermission($id)
    {
        $result = $this->db->table('userlevel')
                ->Where('user_level',$id);
        return $result->countAllResults();
    }

    public function getChecked($id,$user)
    {
        $result = $this->db->table('userlevel')
                ->Where('menu_id',$id)
                ->Where('user_level',$user);
        return $result->countAllResults();
    }
}