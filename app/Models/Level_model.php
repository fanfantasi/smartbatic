<?php namespace App\Admin\Models;

use CodeIgniter\Model;

/**
* 
*/
class Level_model extends Model
{
	protected $table = 'level';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['level']; 

    public function getcomboLevel()
    {
        $query=$this->table($this->table)
                ->Where('level  !=', 'Administrator')
                ->get();
        return $query->getResultArray();
    }

    public function userLevel($id)
    {
        $query=$this->db->table('userlevel')
                ->Where('user_level',$id)
                ->get();
        return $query->getResultArray();
    }


    public function insertLevel($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateLevel($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    public function deleteLevel($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }


    public function getLevel()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'level._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_level']) ? strval($_POST['search_level']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->like('level',$search)
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->table($this->table)
                ->like('level',$search)
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();
        // $query=get();    

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

}