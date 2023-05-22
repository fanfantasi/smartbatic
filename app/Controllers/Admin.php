<?php namespace App\Controllers;

use App\Controllers\Menu;
use TCPDF;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\I18n\Time;
use CodeIgniter\Files\File;

class Admin extends BaseController
{
	  protected $session;
    protected $baseUrl;
	
	public function __construct()
    {
      $this->session = \Config\Services::session();
      $this->baseUrl = base_url();

      $this->login = model('App\Models\Auth_model',false);
      $this->topic = model('App\Models\Topik_model', false);
      $this->module = model('App\Models\Module_model', false);
      $this->videos = model('App\Models\Videos_model', false);
      $this->users = model('App\Models\Users_model',false);
      $this->sekolah = model('App\Models\Sekolah_model',false);
      $this->banners = model('App\Models\Banners_model',false);
      $this->quiz = model('App\Models\Quiz_model',false);
      $this->gallery = model('App\Models\Gallery_model',false);
      $this->sertifikat = model('App\Models\Sertifikat_model',false);
      $this->materi = model('App\Models\Materi_model',false);
      $this->esay = model('App\Models\Esay_model',false);
      $this->eksperimen = model('App\Models\Eksperimen_model',false);

      $this->level = model('App\Models\Level_model',false);
      $this->userlevel = model('App\Models\Userlevel_model',false);
      $this->menus = new Menu();
      $this->sess_id=$this->session->has('uid');
      helper(['url','junior']);
    }

    public function auth() 
    {
        if ($this->request->isAJAX()) {
            $username = service('request')->getPost('username');
            $p = service('request')->getPost('password');
            $signin = $this->login->chekLogin($username);
            $data=array();
            if (count($signin->getResultArray()) > 0){
              $found=$signin->getRowArray();
              if(password_verify($p,$found['password'])){
                $sess_data = array('login' => TRUE, 'user' => $found, 'uid'=>$found['_id']);
                $this->session->set($sess_data);
                $data[] = array(
                  'value'   => 1,
                  'message' => 'Termakasih, Anda Berhasil Login.' 
                );
              }else{
                $options        = array("cost"=>4);
                $hashPassword   = password_hash($p,PASSWORD_BCRYPT,$options);
                $data[] = array(
                  'value'   => 0,
                  'message' => $hashPassword 
                );
              }
            }else{
              $data[] = array(
                'value'   => 0,
                'message' => 'Email anda salah.' 
              );
            }
            echo json_encode($data);
        }
    }

    public function index()
    {
      $data=[
        'title'     => 'Dashboard Integrated System Mabes Polri',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
        'topic'     => $this->topic->countAll(),
        'module'    => $this->module->countAll(),
        'videos'    => $this->videos->countAll(),
        'users'     => $this->users->countAll(),
      ];
      $data['css_files'][] = base_url('template/css/hightchart.css');
      $data['js_files'][] = 'https://code.highcharts.com/highcharts.js';
      $data['js_files'][] = 'https://code.highcharts.com/modules/data.js';
      $data['js_files'][] = 'https://code.highcharts.com/modules/drilldown.js';
      $data['js_files'][] = 'https://code.highcharts.com/modules/exporting.js';
      $data['js_files'][] = 'https://code.highcharts.com/modules/export-data.js';
      $data['js_files'][] = 'https://code.highcharts.com/modules/accessibility.js';
      
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      return render('admin/dashboard',$data);
    }

    public function profil()
    {
      $data=[
        'title'     => 'Data Profil Anda',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
        'level'     => $this->users->comboLevel()
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = '';
      $data['js_files'][] = '';
      return render('admin/master/profil', $data);
    }

    function updateProfil()
    {
        $password       = $this->request->getPost('password');
        $options        = array("cost"=>4);
        $hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);
        $email          = $this->request->getPost('email');
        $full_name      = $this->request->getPost('displayname');
        if ($password == ''){
            $data = array(
                'email'        => $email,
                'displayname'    => $full_name
            );
        }else{
            $data = array(
                'password'     => $hashPassword,
                'email'        => $email,
                'displayname'    => $full_name
            );
        }
        $where =  $this->request->getPost('id');
        $result = $this->users->updateUsers($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function users()
    {
      $data=[
          'title'     => 'Data Users dan Peserta Smart Batik Class',
          'apps'      => 'Smart BC',
          'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
        $data['css_files'][] = base_url('template/easyui/themes/icon.css');
        $data['css_files'][] = base_url('template/easyui/texteditor.css');
        $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
        $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
        $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
        $data['js_files'][] = base_url('template/easyui/datagrid-export.js');
        $data['js_files'][] = base_url('template/js/users.js?v=1');
        return render('admin/master/users', $data);
    }

    public function getUsers()
    {
      $data=$this->users->getUsers();
      $result = $this->response->setJSON($data);
      return $result;
    }
    
    public function newUser()
    {
      $data=[
      'title'     => 'New User',
      'apps'      => 'Smart BC',
      'profil'    => $this->session->get('user'),
      'level'     => $this->level->getcomboLevel()
    ];
    $data['menus']  = $this->menus->getmenus($this->sess_id);
    $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
    $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
    $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
    return render('admin/master/newuser',$data);
    }
    
    function getUserByEmail()
    {
      $data=$this->users->getUsersByEmail();
        if ($data > 0){
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function comboLevel()
    {
        $data=$this->level->getcomboLevel();
        $result = $this->response->setJSON($data);
        return $result;
    }

    public function saveUsers()
    {
      $email = $this->request->getPost('email');
      $full_name = $this->request->getPost('full_name');
      $password = $this->request->getPost('password');
      $is_aktif = $this->request->getPost('is_active');
      $is_level = $this->request->getPost('is_level');
      $options        = array("cost"=>4);
      $hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);
      $data = array(
            'email'       => $email,
            'displayname' => $full_name,
            'is_active'   => $is_aktif,
            'is_level'    => $is_level,
            'password'    => $hashPassword
        );
      $result = $this->users->insertUsers($data);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function updateUser()
    {
      $email = $this->request->getPost('email');
      $full_name = $this->request->getPost('displayname');
      $is_aktif = $this->request->getPost('is_active');
      $is_level = $this->request->getPost('is_level');
      $password       = $this->request->getPost('password');
      $options        = array("cost"=>4);
      $hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);
      if ($password == ''){
        $data = array(
            'email'       => $email,
            'displayname' => $full_name,
            'is_active'   => $is_aktif,
            'is_level'    => $is_level
        );
      }else{
          $data = array(
              'email'       => $email,
              'displayname' => $full_name,
              'is_active'   => $is_aktif,
              'is_level'    => $is_level,
              'password'    => $hashPassword
          );
      }
      $where =  $this->request->getGet('id');
      $result = $this->users->updateUsers($data,$where);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function destroyuser()
    {
      $is_aktif = $this->request->getPost('is_aktif');
    	$data = [
        'is_aktif'	=> ($is_aktif==1)?0:1,
      ];
        $where =  $this->request->getPost('id');
        $result = $this->users->updateUsers($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Aktif / Non Aktif Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function activeUsers()
    {
    	$is_active = $this->request->getPost('is_active');
    	$data = [
        'is_active'	=> ($is_active==1)?0:1,
      ];
        $where =  $this->request->getPost('id');
        $result = $this->users->updateUsers($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Aktif / Non Aktif Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }
    
    
    public function sekolah() {
        $data=[
          'title'     => 'Data Sekolah',
          'apps'      => 'Smart BC',
          'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
        $data['css_files'][] = base_url('template/easyui/themes/icon.css');
        $data['css_files'][] = base_url('template/easyui/texteditor.css');
        $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
        $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
        $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
        $data['js_files'][] = base_url('template/js/sekolah.js');
        return render('admin/master/sekolah', $data);
    }

    function getsekolah()
    {
      $data=$this->sekolah->getsekolah();
      $result = $this->response->setJSON($data);
      return $result;
    }

    public function combosekolah()
    {
        $data=$this->sekolah->combosekolah();
        $result = $this->response->setJSON($data);
        return $result;
    }

    public function saveSekolah()
    {
      $sekolah = $this->request->getPost('sekolah');
      $jenjang = $this->request->getPost('jenjang');
      $alamat = $this->request->getPost('alamat');
      $data=array();
      $data = array(
          'sekolah'   => $sekolah,
          'jenjang'   => $jenjang,
          'alamat'    => $alamat
      );
      $result = $this->sekolah->insertsekolah($data);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function destroysekolah()
    {
        $where =  $this->request->getPost('id');
        $result = $this->sekolah->deletesekolah($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatesekolah()
    {
        $sekolah = $this->request->getPost('sekolah');
        $jenjang = $this->request->getPost('jenjang');
        $alamat = $this->request->getPost('alamat');
        $data=array();
        $data = array(
            'sekolah'  => $sekolah,
            'jenjang'   => $jenjang,
            'alamat'    => $alamat
        );
        $where =  $this->request->getGet('id');
        $result = $this->sekolah->updatesekolah($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Updated Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function materi() {
      $data=[
        'title'     => 'Data Materi',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/js/materi.js');
      return render('admin/master/materi', $data);
    }

  function getmateri()
  {
    $data=$this->materi->getmateri();
    $result = $this->response->setJSON($data);
    return $result;
  }

  public function saveMateri()
    {
      $materi = $this->request->getPost('materi');
      $data=array();
      $data = array(
          'materi'   => $materi
      );
      $result = $this->materi->insertmateri($data);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function destroymateri()
    {
        $where =  $this->request->getPost('id');
        $result = $this->materi->deletemateri($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatemateri()
    {
        $materi = $this->request->getPost('materi');
        $data=array();
        $data = array(
            'materi'  => $materi
        );
        $where =  $this->request->getGet('id');
        $result = $this->materi->updatemateri($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Updated Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function esay() {
      $data=[
        'title'     => 'Data Esay',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['css_files'][] = base_url('template/loaderajax/jm.spinner.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-export.js');
      $data['js_files'][] = base_url('template/loaderajax/jm.spinner.js');
      $data['js_files'][] = base_url('template/js/esay.js');
      return render('admin/master/esay', $data);
    }

  function getesay()
  {
    $data=$this->esay->getesay();
    $result = $this->response->setJSON($data);
    return $result;
  }

  public function saveesay()
    {
      $question = $this->request->getPost('question');
      $topicid = $this->request->getPost('topic_id');
      $data=array();
      $data = array(
          'question'   => $question,
          'topic_id'   => $topicid,
      );
      $result = $this->esay->insertesay($data);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function destroyesay()
    {
        $where =  $this->request->getPost('id');
        $result = $this->esay->deleteesay($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updateesay()
    {
        $question = $this->request->getPost('question');
        $topicid = $this->request->getPost('topic_id');
        $data=array();
        $data = array(
            'question'   => $question,
            'topic_id'   => $topicid,
        );
        $where =  $this->request->getGet('id');
        $result = $this->esay->updateesay($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Updated Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function combomateri()
    {
        $data=$this->materi->combomateriall();
        $result = $this->response->setJSON($data);
        return $result;
    }

    public function peserta() {
      $data=[
        'title'     => 'Data Peserta Smart Batik Class',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/js/peserta.js');
      return render('admin/master/peserta', $data);
    }

    function getpeserta()
    {
      $data=$this->users->getpeserta();
      $result = $this->response->setJSON($data);
      return $result;
    }

    public function evaluasiquiz() {
      $data=[
        'title'     => 'Data Evaluasi Smart Batik Class',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/js/evaluasiquiz.js');
      return render('admin/master/evaluasiquiz', $data);
    }

    function getevaluasiquiz()
    {
      $data=$this->quiz->getpeserta();
      $result = $this->response->setJSON($data);
      return $result;
    }

    public function evaluasiesay() {
      $data=[
        'title'     => 'Data Evaluasi Smart Batik Class',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-cellediting.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/js/evaluasiesay.js');
      return render('admin/master/evaluasiesay', $data);
    }

    function getevaluasiesay()
    {
      $data=$this->esay->getpeserta();
      $datas=array();
      foreach ($data['rows'] as $row) {
        $count = $this->esay->getcount($row['uid']);
        $c = $count[0]['count'];
        $correct = $count[0]['correct'];
        $datas[]=array(
            'uid'  => $row['uid'],
            'userid'  => $row['userid'],
            'topicid'  => $row['topicid'],
            'email'  => $row['email'],
            'displayname'  => $row['displayname'],
            'jenjang'  => $row['jenjang'],
            'sekolah'  => $row['sekolah'],
            'materi'  => $row['materi'],
            'soal'    => $c,
            'correct' => $correct
        );
      }
      $result = $this->response->setJSON($datas);
      return $result;
    }

    function getevaluasianswers()
    {
      $data=$this->esay->getAnswer();
      $datas=array();
      foreach ($data as $row) {
        
        $datas[]=array(
            'id'             => $row['_id'],
            'uid'             => $row['uid'],
            'topicid'        => $row['topicid'],
            'esayid'        => $row['esayid'],
            'question'       => $row['question'],
            'answer'         => $row['answer'],
            'correct'        => $row['correct']
        );
      }
      $result = $this->response->setJSON($datas);
      return $result;
    }

    function saveAnswerEsay()
    {
      $kondisi=$this->request->getPost('kondisi');
      $result = $this->esay->updateBatchEsay($kondisi);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function destroyAnswer()
    {
        $uid =  $this->request->getPost('uid');
        $topicid =  $this->request->getPost('topicid');
        $result = $this->esay->deleteAnswer($uid, $topicid);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function aktivasipeserta()
    {
      $userid = $this->request->getPost('userid');
      $sekolahid = $this->request->getPost('sekolahid');
      $jurusan = $this->request->getPost('jurusan');
      $batch = $this->request->getPost('batch');
      $is_active = $this->request->getPost('is_active');
      $data = array(
          'userid'        => $userid,
          'sekolahid'     => $sekolahid,
          'jurusan'       => $jurusan,
          'jenjang'       => $this->sekolah->getSekolahById($sekolahid)['jenjang'],
          'batch'         => $batch,
          'is_active'     => $is_active,
      );
      $where =  $this->request->getGet('id');
      $result = $this->users->updateUsers($data,$where);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function module()
    {
        $data=[
          'title'     => 'Data Module Pembelajaran',
          'apps'      => 'Smart BC',
          'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
        $data['css_files'][] = base_url('template/easyui/themes/icon.css');
        $data['css_files'][] = base_url('template/easyui/texteditor.css');
        $data['css_files'][] = base_url('template/loaderajax/jm.spinner.css');
        $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
        $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
        $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
        $data['js_files'][] = base_url('template/loaderajax/jm.spinner.js');
        $data['js_files'][] = base_url('template/js/module.js?v=2');
        return render('admin/master/module', $data);
    }

    public function getmodule()
    {
      $data=$this->module->getmodule();
      $result = $this->response->setJSON($data);
      return $result;
    }

    public function downloadmodule($link)
    {
      return $this->response->download($link, null);
    }


    public function destroymodule()
    {
        $where =  $this->request->getPost('id');
        $result = $this->module->deleteModule($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function videos() {
      $data=[
        'title'     => 'Data Video',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/js/videos.js');
      return render('admin/master/videos', $data);
    }

    function getvideos()
    {
      $data=$this->videos->getvideos();
      $result = $this->response->setJSON($data);
      return $result;
    }


    public function savevideos()
    {
      $title = $this->request->getPost('title');
      $batch = $this->request->getPost('batch');
      $url = $this->request->getPost('url');
      $materiid = $this->request->getPost('materiid');
      $data=array();
      $data = array(
          'title'   => $title,
          'batch'   => $batch,
          'materiid'   => $materiid,
          'url'    => $url,
          'date'    => Date('Y-m-d H:i:s')
      );
      $result = $this->videos->insertvideos($data);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function updatevideos()
    {
        $title = $this->request->getPost('title');
        $batch = $this->request->getPost('batch');
        $url = $this->request->getPost('url');
        $materiid = $this->request->getPost('materiid');
        $data=array();
        $data = array(
            'title'   => $title,
            'batch'   => $batch,
            'materiid'   => $materiid,
            'url'    => $url,
            'date'    => Date('Y-m-d H:i:s')
        );
        $where =  $this->request->getGet('id');
        $result = $this->videos->updatevideos($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Updated Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function destroyvideos()
    {
        $where =  $this->request->getPost('id');
        $result = $this->videos->deletevideos($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function banners() {
      $data=[
        'title'     => 'Data Banners',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['css_files'][] = base_url('template/loaderajax/jm.spinner.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/loaderajax/jm.spinner.js');
      $data['js_files'][] = base_url('template/js/banners.js');
      return render('admin/master/banners', $data);
    }

    function getbanners()
    {
      $data=$this->banners->getbanners();
      $result = $this->response->setJSON($data);
      return $result;
    }


    public function destroybanners()
    {
        $where =  $this->request->getPost('id');
        $result = $this->banners->deletebanners($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function topik() {
      $data=[
        'title'     => 'Data Topik Quiz',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/js/topik.js');
      return render('admin/master/topik', $data);
    }

    function gettopik()
    {
      $data=$this->topic->getTopic();
      $result = $this->response->setJSON($data);
      return $result;
    }

    public function combotopik()
    {
        $data=$this->topic->combotopik();
        $result = $this->response->setJSON($data);
        return $result;
    }

    public function combotopikAll()
    {
        $data=$this->topic->combotopikAll();
        $result = $this->response->setJSON($data);
        return $result;
    }

    public function savetopik()
    {
      $thema = $this->request->getPost('thema');
      $batch = $this->request->getPost('batch');
      $jenjang = $this->request->getPost('jenjang');
      $materiid = $this->request->getPost('materiid');
      $active = $this->request->getPost('is_active');
      $data=array();
      $data = array(
          'thema'   => $thema,
          'batch'   => $batch,
          'materiid'  => $materiid,
          'jenjang'    => $jenjang,
          'is_active'    => $active,
          'date'    => Date('Y-m-d H:i:s')
      );
      $result = $this->topic->insertTopic($data);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function updatetopik()
    {
        $thema = $this->request->getPost('thema');
        $batch = $this->request->getPost('batch');
        $materiid = $this->request->getPost('materiid');
        $jenjang = $this->request->getPost('jenjang');
        $active = $this->request->getPost('is_active');
        $data=array();
        $data = array(
            'thema'   => $thema,
            'batch'   => $batch,
            'materiid'  => $materiid,
            'jenjang'    => $jenjang,
            'is_active'    => $active
        );
        $where =  $this->request->getGet('id');
        $result = $this->topic->updateTopic($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Updated Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function destroytopik()
    {
        $where =  $this->request->getPost('id');
        $result = $this->topic->deleteTopic($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function mulaiquiz()
    {
    	$data = [
        'is_active'	=> 1,
      ];
        $where =  $this->request->getPost('id');
        $result = $this->topic->updateTopic($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Quiz untuk topik ini sudah mulai'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function selesaiquiz()
    {
    	$is_active = $this->request->getPost('is_active');
    	$data = [
        'is_active'	=> 2,
      ];
        $where =  $this->request->getPost('id');
        $result = $this->topic->updateTopic($data,$where);
        if ($result){
            echo json_encode(array('message'=>'Quiz untuk topik ini sudah selesai'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function quiz(){
      $data=[
        'title'     => 'Data Quiz',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['css_files'][] = base_url('template/loaderajax/jm.spinner.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-export.js');
      $data['js_files'][] = base_url('template/loaderajax/jm.spinner.js');
      $data['js_files'][] = base_url('template/js/quiz.js?v=2');
      return render('admin/master/quiz', $data);
    }

    function getquiz()
    {
      $data=$this->quiz->getQuiz();
      $datas=array();
      foreach ($data['rows'] as $row) {
        $datas[]=array(
            '_id'                   => $row['_id'],
            'topic_id'              => $row['topic_id'],
            'question'              => $row['question'],
            'answer'                => $row['answer'],
            'thema'                 => $row['thema'].' ('.$row['materi'].')',
            'is_active'             => $row['is_active'],
            'options[]'               => $this->quiz->getfield('options','options','quiz_id', $row['_id'])
        );
      }
      $result = $this->response->setJSON($datas);
      return $result;
    }

    public function savequiz()
    {
      $topic_id = $this->request->getPost('topic_id');
      $question = $this->request->getPost('question');
      $answer = $this->request->getPost('answer');
      $options = $this->request->getPost('options');
      $data=array();
      $data = array(
          'topic_id'   => $topic_id,
          'question'   => $question,
          'answer'     => $answer
      );
      $result = $this->quiz->insertquiz($data, $options);
      
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function updatequiz()
    {
      $topic_id = $this->request->getPost('topic_id');
      $question = $this->request->getPost('question');
      $answer = $this->request->getPost('answer');
      $options = $this->request->getPost('options');
      $data=array();
      $data = array(
          'topic_id'   => $topic_id,
          'question'   => $question,
          'answer'     => $answer
      );
      $where =  $this->request->getGet('id');
      $result = $this->quiz->updatequiz($where, $data, $options);
      if ($result){
          echo json_encode(array('message'=>'Save Success'));
      } else {
          echo json_encode(array('errorMsg'=>'Some errors occured.'));
      }
    }

    public function destroyquiz()
    {
        $where =  $this->request->getPost('id');
        $result = $this->quiz->deletequiz($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function gallery()
    {
    	$data=[
        'title'			=> 'Gallery Photo Hasil Pembatik',
        'apps'			=> 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/loader/dist/css-loader.css');
          $data['css_files'][] = base_url('template/loader/spinner/jquery-spinner.min.css');
          $data['js_files'][] = base_url('template/loader/spinner/jquery-spinner.min.js');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      return render('admin/laporan/gallery',$data);
    }

    public function getgallery()
    {
    	$check = $this->users->getpesertagallery();
    	$peserta=array();
      foreach ($check->getResult() as $row) {
          $img=array();
          $imgs = $this->gallery->getImages($row->uid);
          foreach ($imgs->getResult() as $i) {
            $img[] = array(
                '_id'	=> $i->_id,
                'img'	=> $i->image,
                'desc'=> $i->desc
              );
          }
          $peserta[]=array(
                  'id'                => $row->_id,
                  'uid'               => $row->uid,
                  'displayname'       => $row->displayname,
                  'userid'            => $row->userid,
                  'jenjang'           => $row->jenjang,
                  'sekolah'           => $row->sekolah,
                  'avatar'            => $row->avatar,
                  'batch'             => $row->batch,
                  'image'		          => $img
          );
          
      }
    	$data=[
			  'peserta'			=> $peserta,
		  ];
      $result = view('admin/laporan/cardimage', $data);
      return $result;
    }

    public function eksperimen()
    {
    	$data=[
        'title'			=> 'Eksperimen Aktif',
        'apps'			=> 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/loader/dist/css-loader.css');
          $data['css_files'][] = base_url('template/loader/spinner/jquery-spinner.min.css');
          $data['js_files'][] = base_url('template/loader/spinner/jquery-spinner.min.js');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      return render('admin/master/eksperimen/hasil',$data);
    }

    public function geteksperimen()
    {
    	$check = $this->eksperimen->getImages();
    	$peserta=array();
      foreach ($check->getResult() as $row) {
          $img=array();
          $imgs = $this->eksperimen->getGallery($row->uid);
          foreach ($imgs->getResult() as $i) {
            $img[] = array(
                '_id'	=> $i->_id,
                'img'	=> $i->image,
                'desc'=> $i->desc
              );
          }
          $peserta[]=array(
            'id'                => $row->_id,
            'uid'               => $row->uid,
            'materi'            => $row->materi,
            'displayname'       => $row->displayname,
            'userid'            => $row->userid,
            'jenjang'           => $row->jenjang,
            'sekolah'           => $row->sekolah,
            'avatar'            => $row->avatar,
            'batch'             => $row->batch,
            'image'		          => $img
          );
          
      }
      
    	$data=[
			  'peserta'			=> $peserta,
		  ];

      if ($check->getResult()){
        $result = view('admin/master/eksperimen/cardimage', $data);
      }else{
        $result = view('admin/master/eksperimen/empty', $data);
      }
      
      return $result;
    }

    public function sertifikat() {
      $data=[
        'title'     => 'Data Sertifikat Peserta',
        'apps'      => 'Smart BC',
        'profil'    => $this->session->get('user'),
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
      $data['css_files'][] = base_url('template/easyui/themes/icon.css');
      $data['css_files'][] = base_url('template/easyui/texteditor.css');
      $data['css_files'][] = base_url('template/loaderajax/jm.spinner.css');
      $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
      $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
      $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
      $data['js_files'][] = base_url('template/loaderajax/jm.spinner.js');
      $data['js_files'][] = base_url('template/js/sertifikat.js');
      return render('admin/laporan/sertifikat', $data);
    }

    function getsertifikat()
    {
      $data=$this->sertifikat->getSertifikat();
      $result = $this->response->setJSON($data);
      return $result;
    }

    public function destroysertifikat()
    {
        $where =  $this->request->getPost('id');
        $result = $this->sertifikat->deletesertifikat($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function chatpeserta()
    {
      $res=$this->users->chatpeserta();
      $data=array();
      $total=0;
      foreach($res->getResult() as $row){
        $total=$total+$row->sum;
        $res=$this->users->chatdrilldownpeserta($row->sekolahid);
        $datasub1=array();
        foreach ($res->getResult() as $r) {
            $datasub1[]=[
                $r->jurusan,
                (float)$r->sum
            ];
        }
        $data[] = array(
            'name'      => $this->users->getfield('sekolah','sekolah','_id', $row->sekolahid),
            'y'         => (float)$row->sum,
            'drilldown' =>  $row->sekolahid,
        );
        $datasub[] = array(
            'name'  =>  $this->users->getfield('sekolah','sekolah','_id', $row->sekolahid),
            'id'    => $row->sekolahid,
            'data'  => $datasub1
        );
      }
      $output = [
        'data'      => $data,
        'drilldown' => $datasub,
        'total'     => $total
      ];
      $result = $this->response->setJSON($output);
      return $result;
    }


    public function laporanpdf()
    {
      $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        $wilayah = $this->request->getGet('wilayah');
        $kegiatan = $this->request->getGet('kegiatan');
        $fungsi = $this->request->getGet('fungsi');
        $result = $this->lapkegiatan->getlaporanpdf($start,$end,$wilayah,$kegiatan,$fungsi);
        $data=array();
        $html = view('admin/laporan/viewlaporan',[
          'lap'=> $result
        ]);
    
        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

      $pdf->SetCreator(PDF_CREATOR);
      // $pdf->SetAuthor('Dea Venditama');
      $pdf->SetTitle('LAPORAN HARIAN SATGAS PEMULIHAN EKONOMI NASIONAL (PEN)');
      $pdf->SetSubject('SATGAS PEN');

      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);

      $pdf->addPage();
      // output the HTML content
      $pdf->writeHTML($html, true, false, true, false, '');
      //line ini penting
      $this->response->setContentType('application/pdf');
      //Close and output PDF document
      $pdf->Output('laporan.pdf', 'I');
    }

    public function logout()
    {
      $this->session->destroy();
      return redirect()->to('/');
    }
}