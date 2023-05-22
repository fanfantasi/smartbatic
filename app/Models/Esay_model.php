<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Esay_model extends Model
{
    protected $table = 'esay';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['topic_id', 'question']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    
    public function insertesay($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateEsay($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->protect(false)->update();
        return $query ? true : false;
    }

    public function deleteEsay($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }
    

    public function getEsay()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'esay._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $thema = isset($_POST['thema']) ? strval($_POST['thema']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->select('esay .*, topic.thema, topic.is_active, materi.materi')
                ->join('topic','esay.topic_id=topic._id')
                ->join('materi','topic.materiid=materi._id')
                ->groupStart()
                ->like('esay.topic_id', $thema)
                ->like('esay.question',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->select('esay .*, topic.thema, topic.is_active, materi.materi')
                ->join('topic','esay.topic_id=topic._id')
                ->join('materi','topic.materiid=materi._id')
                ->groupStart()
                ->like('esay.topic_id', $thema)
                ->like('esay.question',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    public function getpeserta()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'users._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $sekolah = isset($_POST['sekolahid']) ? strval($_POST['sekolahid']) : 0;
        $materiid = isset($_POST['materiid']) ? strval($_POST['materiid']) : 0;
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->db->table('users')
                ->select('users .*, level.level, sekolah.sekolah, materi.materi, topic._id as topicid')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->join('answers_esay','users.uid=answers_esay.uid','LEFT')
                ->join('topic','answers_esay.topicid=topic._id','LEFT')
                ->join('materi','topic.materiid=materi._id','LEFT')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->groupStart()
                ->where('users.sekolahid', $sekolah)
                ->like('topic.materiid', $materiid)
                ->like('users.displayname',$search)
                ->groupEnd()
                ->groupBy('users.uid')
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->db->table('users')
                ->select('users .*, level.level, sekolah.sekolah, materi.materi, topic._id as topicid')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->join('answers_esay','users.uid=answers_esay.uid','LEFT')
                ->join('topic','answers_esay.topicid=topic._id','LEFT')
                ->join('materi','topic.materiid=materi._id','LEFT')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->groupStart()
                ->where('users.sekolahid', $sekolah)
                ->like('topic.materiid', $materiid)
                ->like('users.displayname',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->groupBy('users.uid')
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    public function getcount($uid)
    {
        $query = $this->db->table('answers_esay')
                ->select('count(uid) as count, sum(correct) as correct')
                ->where('uid',$uid)
                ->get()->getResultArray();
        return $query;
    }

    public function getAnswer()
    {
        $uid = isset($_POST['uid']) ? strval($_POST['uid']) : '';
        $topicid = isset($_POST['topicid']) ? strval($_POST['topicid']) : 0;
        $query = $this->db->table('answers_esay')
                ->select('answers_esay .*, esay.question')
                ->join('esay','esay._id=answers_esay.esayid')
                ->where('uid',$uid)
                ->where('topicid',$topicid)
                ->get()->getResultArray();
        return $query;
    }

    public function updateBatchEsay($data)
    {
    	$res=json_decode($data);
    	$this->db->transStart();
    	$result=array();
    	foreach ($res as $row) {
    		$result[]=array(
    				'_id'	    => $row->id,
    				'uid'		=> $row->uid,
    				'topicid'		=> $row->topicid,
    				'answer'	=> $row->answer,
    				'correct'		=> $row->correct
    			);
    	}
    	$this->db->table('answers_esay')->updateBatch($result, '_id');
    	$this->db->transComplete();
	    if ($this->db->transStatus === FALSE) {
	        return false;
	    }else{
	        return true;
	    }
    }

    public function deleteAnswer($uid, $topicid)
    {
        $query = $this->db->table('answers_esay')
                ->where('uid',$uid)
                ->where('topicid',$topicid)
                ->delete();
        return $query ? true : false;
    }
}
