<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Analisa_model extends Model
{
    protected $table = 'tbl_analisa';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['analisa', 'short', 'file', 'user_id']; 
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertAnalisa($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateAnalisa($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->protect(false)->update();
        return $query ? true : false;
    }

    public function deleteAnalisa($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    public function getAnalisa()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_analisa.analisa';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('analisa',$search)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('analisa',$search)
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    public function getDetailAnalisa($id)
    {
        $query  = $this->table($this->table)
                ->where('deleted_at', null)
                ->where('_id', $id)
                ->countAllResults();
                if ($query > 0) {
                    $result = $this->table($this->table)
                            ->where('deleted_at', null)
                            ->where('_id', $id)
                            ->get()
                            ->getRowArray();
                }else{
                    $result = array();
                }
        return $result;
    }
}
