<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Quiz_model extends Model
{
    protected $table = 'quiz';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['topic_id', 'question', 'answer']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    function getfield($table, $field,$key,$value){
        $result = $this->db->table($table)
        		  ->where($key,$value)
        		  ->get()
                  ->getResultArray();
        $data=array();
        foreach($result as $row){
            $data[]=$row[$field];
        }
        return implode(", ",$data);
    }

    public function insertquiz($data, $options)
    {
        $this->db->transStart();
            $quizid = $this->db->table($this->table)->insert($data);
            $datas=array();
            foreach($options as $opt){
                $datas[] = array(
                    'quiz_id'   => $this->db->insertID(),
                    'options'   => $opt
                );
            }
            $this->db->table('options')->insertBatch($datas);
        $this->db->transComplete();
        if ($this->db->transStatus === FALSE) {
            return false;
        }else{
            return true;
        }
    }

    public function updatequiz($id, $data, $options)
    {
        $this->db->transStart();
            $this->table($this->table)->set($data)->where('_id',$id)->protect(false)->update();
            $datas=array();
            foreach($options as $opt){
                $datas[] = array(
                    'quiz_id'   => $id,
                    'options'   => $opt
                );
            }
            $this->db->table('options')->where('quiz_id',$id)->delete();
            $this->db->table('options')->insertBatch($datas);
        $this->db->transComplete();
        if ($this->db->transStatus === FALSE) {
            return false;
        }else{
            return true;
        }
    }


    public function deletequiz($id)
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

    public function getQuiz()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'quiz._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search_data']) ? strval($_POST['search_data']) : '';
        $thema = isset($_POST['thema']) ? strval($_POST['thema']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->select('quiz .*, topic.thema, topic.is_active, materi.materi')
                ->join('topic','quiz.topic_id=topic._id')
                ->join('materi','topic.materiid=materi._id')
                ->where('quiz.deleted_at', null)
                ->groupStart()
                ->like('quiz.topic_id', $thema)
                ->like('quiz.question',$search)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->countAllResults();
        $result['total'] = $query;

        $query = $this->table($this->table)
                ->select('quiz .*, topic.thema, topic.is_active, materi.materi')
                ->join('topic','quiz.topic_id=topic._id')
                ->join('materi','topic.materiid=materi._id')
                ->where('quiz.deleted_at', null)
                ->groupStart()
                ->like('quiz.topic_id', $thema)
                ->like('quiz.question',$search)
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
                ->select('users .*, level.level, sekolah.sekolah, answers .*, materi.materi')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->join('answers','users.uid=answers.uid','LEFT')
                ->join('topic','answers.topic_id=topic._id','LEFT')
                ->join('materi','topic.materiid=materi._id','LEFT')
                ->where('users.deleted_at', null)
                ->where('users.is_level', 1)
                ->groupStart()
                ->where('users.sekolahid', $sekolah)
                ->like('topic.materiid', $materiid)
                ->like('users.displayname',$search)
                ->groupEnd()
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->db->table('users')
                ->select('users .*, level.level, sekolah.sekolah, answers .*,materi.materi')
                ->join('level','users.is_level=level._id')
                ->join('sekolah','users.sekolahid=sekolah._id','LEFT')
                ->join('answers','users.uid=answers.uid','LEFT')
                ->join('topic','answers.topic_id=topic._id','LEFT')
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
                ->get();

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }
}
