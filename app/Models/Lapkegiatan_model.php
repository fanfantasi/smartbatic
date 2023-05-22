<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Lapkegiatan extends model
{
    protected $table = 'tbl_laporan';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['user_id', 'wilayah_id', 'keg_id', 'date', 'fungsi', 'uraian', 'file']; 
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function getLaporanKeg()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_laporan._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $start = isset($_POST['start']) ? strval($_POST['start']) : '';
        $end = isset($_POST['end']) ? strval($_POST['end']) : '';
        $keg = isset($_POST['keg_id']) ? strval($_POST['keg_id']) : '';
        $wilayah = isset($_POST['wilayah_id']) ? strval($_POST['wilayah_id']) : '';
        $fungsi = isset($_POST['fungsi']) ? strval($_POST['fungsi']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query  = $this->table($this->table)
                ->select('tbl_laporan .*, tbl_wilayah.nm_polda, tbl_kegiatan.kegiatan, tbl_users.full_name')
                ->join('tbl_users', 'tbl_users._id=tbl_laporan.user_id', 'LEFT')
                ->join('tbl_wilayah', 'tbl_wilayah._id=tbl_laporan.wilayah_id', 'LEFT')
                ->join('tbl_kegiatan', 'tbl_kegiatan._id=tbl_laporan.keg_id', 'LEFT')
                ->where('tbl_laporan.deleted_at', null)
                ->where('tbl_laporan.date BETWEEN "'. $start . '" and "'. $end .'"')
                ->groupStart()
                ->where('tbl_laporan.wilayah_id',$wilayah)
                ->like('tbl_laporan.keg_id',$keg)
                ->like('tbl_laporan.fungsi', $fungsi)
                ->groupEnd()
                ->countAllResults();
        $result['total'] = $query;

        $query  = $this->table($this->table)
                ->select('tbl_laporan .*, tbl_wilayah.nm_polda, tbl_kegiatan.kegiatan, tbl_users.full_name')
                ->join('tbl_users', 'tbl_users._id=tbl_laporan.user_id', 'LEFT')
                ->join('tbl_wilayah', 'tbl_wilayah._id=tbl_laporan.wilayah_id', 'LEFT')
                ->join('tbl_kegiatan', 'tbl_kegiatan._id=tbl_laporan.keg_id', 'LEFT')
                ->where('tbl_laporan.deleted_at', null)
                ->where('tbl_laporan.date BETWEEN "'. $start . '" and "'. $end .'"')
                ->groupStart()
                ->where('tbl_laporan.wilayah_id',$wilayah)
                ->like('tbl_laporan.keg_id',$keg)
                ->like('tbl_laporan.fungsi', $fungsi)
                ->groupEnd()
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();
        
        $item = $query->getResultArray();
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }


    function getlaporanpdf($start, $end, $wilayah, $keg, $fungsi)
    {
        $query  = $this->table($this->table)
                ->select('tbl_laporan .*, tbl_wilayah.nm_polda, tbl_kegiatan.kegiatan, tbl_users.full_name')
                ->join('tbl_users', 'tbl_users._id=tbl_laporan.user_id', 'INNER')
                ->join('tbl_wilayah', 'tbl_wilayah._id=tbl_laporan.wilayah_id', 'INNER')
                ->join('tbl_kegiatan', 'tbl_kegiatan._id=tbl_laporan.keg_id', 'INNER')
                ->where('tbl_laporan.deleted_at', null)
                ->where('tbl_laporan.date BETWEEN "'. $start . '" and "'. $end .'"')
                ->groupStart()
                ->where('tbl_laporan.wilayah_id',$wilayah)
                ->like('tbl_laporan.keg_id',$keg)
                ->like('tbl_laporan.fungsi', $fungsi)
                ->groupEnd()
                ->get()
                ->getResultArray();
        return $query;
    }

    public function chartData()
    {
        $query  = $this->table($this->table)
                ->select('date, COUNT(date) as jml,')
                ->where('deleted_at', null)
                ->groupBY('MONTH(date)')
                ->countAllResults();
                if ($query > 0) {
                    $result = $this->table($this->table)
                            ->select('date, COUNT(date) as jml')
                            ->where('deleted_at', null)
                            ->groupBY('MONTH(date)')
                            ->get()
                            ->getResultArray();
                }else{
                    $result = array();
                }
        return $result;
    }

    public function laporanChat()
    {
        $query  = $this->table($this->table)
                ->select('COUNT(tbl_laporan.keg_id) as jml, DATE_FORMAT(date, "%m") as bulan, tbl_kegiatan.kegiatan')
                ->join('tbl_kegiatan', 'tbl_kegiatan._id=tbl_laporan.keg_id', 'LEFT')
                ->where('tbl_laporan.deleted_at', null)
                ->orderBy('bulan')
                ->groupBY('tbl_laporan.keg_id')
                ->countAllResults();
                if ($query > 0) {
                    $result = $this->table($this->table)
                            ->select('COUNT(tbl_laporan.date) as jml, DATE_FORMAT(date, "%M") as bulan, tbl_kegiatan.kegiatan')
                            ->join('tbl_kegiatan', 'tbl_kegiatan._id=tbl_laporan.keg_id', 'LEFT')
                            ->where('tbl_laporan.deleted_at', null)
                            ->orderBy('bulan')
                            ->groupBY('tbl_laporan.keg_id')
                            ->get()
                            ->getResultArray();
                }else{
                    $result = array();
                }
        return $result;
    }
}
