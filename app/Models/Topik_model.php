<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Topik_model extends Model
{
    protected $table = 'topic';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['thema', 'batch', 'date', 'jenjang', 'is_active']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertTopic($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateTopic($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->protect(false)->update();
        return $query ? true : false;
    }

    public function deleteTopic($id)
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

    public function getTopic()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'topic._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->select('topic .*, materi.materi, materi._id as materiid')
                ->join('materi','topic.materiid=materi._id')
                ->where('.topic.deleted_at', null)
                ->like('topic.thema',$search)
                ->orderBy($sort,$order)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->select('topic .*, materi.materi, materi._id as materiid')
                ->join('materi','topic.materiid=materi._id')
                ->where('.topic.deleted_at', null)
                ->like('topic.thema',$search)
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    public function combotopik()
    {
        $query=$this->table($this->table)
                ->where('is_active', 0)
                ->get();
        return $query->getResultArray();
    }

    public function combotopikAll()
    {
        $query=$this->table($this->table)
                ->get();
        return $query->getResultArray();
    }
}
