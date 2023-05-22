<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Eksperimen_model extends Model
{
	protected $table = 'eksperimen';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['uid','materiid','image','desc','date','created_at']; 

    public function getImages()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'users._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $sekolah = isset($_POST['sekolahid']) ? strval($_POST['sekolahid']) : '';
        $materiid = isset($_POST['materiid']) ? strval($_POST['materiid']) : '';
        $offset = ($page-1)*$rows;
        $query = $this->table($this->table)
                ->select('eksperimen .*, users .*, sekolah.sekolah, materi.materi, materi._id as materiid')
                ->join('users','eksperimen.uuid=users.uid')
                ->join('materi','eksperimen.materiid=materi._id')
                ->join('sekolah','eksperimen.sekolahid=sekolah._id','LEFT')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->where('users.is_active', 1)
                ->Where('eksperimen.sekolahid', $sekolah)
                ->groupStart()
               
                ->Like('eksperimen.materiid',$materiid)
                ->Like('users.displayname',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->groupBy('eksperimen.uuid')
                ->limit($rows,$offset);
        return $query->get();
    }

    public function getGallery($id)
    {
        $query = $this->db->table('eksperimen')
                ->where('uuid',$id)
                ->orderBy('created_at','DESC')
                ->get();
        return $query;
    }
}