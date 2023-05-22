<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Materi_model extends Model
{
    protected $table = 'materi';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['materi']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    public function insertMateri($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateMateri($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->protect(false)->update();
        return $query ? true : false;
    }

    public function deleteMateri($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }
    
    public function countAll()
    {
        $query = $this->table($this->table)
                ->where('deleted_at', null)
               ->countAllResults();
        return $query;
    }

    public function getMateri()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'materi._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->like('materi',$search)
                ->orderBy($sort,$order)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->like('materi',$search)
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getMateriById($id)
    {
        $query=$this->table($this->table)
                ->Where('_id',$id)
                ->Limit(1)
                ->get();
        return $query->getRowArray();
    }

    public function combomateriAll()
    {
        $query=$this->table($this->table)
                ->get();
        return $query->getResultArray();
    }

}
