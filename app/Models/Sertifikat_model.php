<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Sertifikat_model extends Model
{
    protected $table = 'sertifikat';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['uid',  'file']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function deletesertifikat($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    public function getSertifikat()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sertifikat._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $sekolah = isset($_POST['sekolahid']) ? strval($_POST['sekolahid']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->select('sertifikat .*, users.avatar, users.displayname, users.userid, users.jurusan, sekolah.sekolah')
                ->join('users','users.uid=sertifikat.uid','LEFT')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->groupStart()
                ->Where('users.sekolahid', $sekolah)
                ->like('users.displayname',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->select('sertifikat .*, users.avatar, users.displayname, users.userid, users.jurusan, sekolah.sekolah')
                ->join('users','users.uid=sertifikat.uid','LEFT')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->groupStart()
                ->Where('users.sekolahid', $sekolah)
                ->like('users.displayname',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
}
