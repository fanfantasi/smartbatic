<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Videos_model extends Model
{
    protected $table = 'videos';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['title', 'batch', 'date', 'read','url']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertVideos($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateVideos($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->protect(false)->update();
        return $query ? true : false;
    }

    public function deleteVideos($id)
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

    public function getVideos()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'Videos._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->select('videos .*, materi.materi, materi._id as materiid')
                ->join('materi','videos.materiid=materi._id')
                ->where('videos.deleted_at', null)
                ->like('videos.title',$search)
                ->orderBy($sort,$order)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->select('videos .*, materi.materi, materi._id as materiid')
                ->join('materi','videos.materiid=materi._id')
                ->where('videos.deleted_at', null)
                ->like('videos.title',$search)
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getVideosById($id)
    {
        $query=$this->table($this->table)
                ->Where('_id',$id)
                ->Limit(1)
                ->get();
        return $query->getRowArray();
    }

    
}
