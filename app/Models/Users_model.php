<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Users_model extends Model
{
	protected $table = 'users';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['uid', 'email', 'displayname', 'password', 'userid', 'jenjang','sekolahid','jurusan','avatar', 'batch','is_active','is_level']; 
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    function getfield($table,$field,$key,$value){
        $result = $this->db->table($table)
        		  ->where($key,$value)
        		  ->get()
        		  ->getRowArray();
        return $result[$field];
    }

    public function countAll()
    {
        $query = $this->table($this->table)
               ->where('deleted_at', null)
               ->countAllResults();
        return $query;
    }
    
    
    public function insertUsers($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateUsers($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->protect(false)->update();
        return $query ? true : false;
    }

    public function deleteUsers($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    public function getUsers()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'users._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->select('users .*, level.level, sekolah.sekolah')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->where('users.deleted_at', null)
                ->like('users.displayname',$search)
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->table($this->table)
                ->select('users .*, level.level, sekolah.sekolah')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->where('users.deleted_at', null)
                ->like('users.displayname',$search)
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }


    public function getProfil($id)
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

    public function comboLevel()
    {
        $query=$this->db->table('level')
                ->get();
        return $query->getResultArray();
    }

    public function getpeserta()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'users._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $sekolah = isset($_POST['sekolahid']) ? strval($_POST['sekolahid']) : 0;
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->select('users .*, level.level, sekolah.sekolah')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->groupStart()
                ->where('users.sekolahid', $sekolah)
                ->like('users.displayname',$search)
                ->groupEnd()
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->table($this->table)
                ->select('users .*, level.level, sekolah.sekolah')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->groupStart()
                ->where('users.sekolahid', $sekolah)
                ->like('users.displayname',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    public function getpesertagallery()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'users._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $sekolah = isset($_POST['sekolahid']) ? strval($_POST['sekolahid']) : '';
        $offset = ($page-1)*$rows;
        $query = $this->table($this->table)
                ->select('users .*, level.level, sekolah.sekolah')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->where('users.is_active', 1)
                ->Where('users.sekolahid', $sekolah)
                ->groupStart()
               
                ->Like('users.displayname',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->limit($rows,$offset);
        return $query->get();
    }

    public function getUsersByEmail()
    {
        $q = isset($_POST['q']) ? $_POST['q'] : '';
         $query=$this->table($this->table)
                ->Where('email',$q)
                ->countAllResults();
        return $query;
    }

    public function chatpeserta(){
        $query = $this->table($this->table)
                ->select('users .*, level.level, sekolah.sekolah, COUNT(users.uid) as sum')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->groupBy('users.sekolahid')
                ->get();
        return $query;
    }

    public function chatdrilldownpeserta($sekolah){
        $query = $this->table($this->table)
                ->select('users .*, level.level, sekolah.sekolah, COUNT(users.uid) as sum')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->where('users.sekolahid', $sekolah)
                ->groupBy('users.jurusan')
                ->get();
        return $query;
    }
    
}