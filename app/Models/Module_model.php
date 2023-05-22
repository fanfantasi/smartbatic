<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Module_model extends Model
{
    protected $table = 'modules';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['title', 'batch', 'jenjang', 'date', 'read','file']; 
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';


    public function deleteModule($id)
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

    public function getModule()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'modules._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('title',$search)
                ->orderBy($sort,$order)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('title',$search)
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getModuleById($id)
    {
        $query=$this->table($this->table)
                ->Where('_id',$id)
                ->Limit(1)
                ->get();
        return $query->getRowArray();
    }
}
