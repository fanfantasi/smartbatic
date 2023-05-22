<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Gallery_model extends Model
{
	protected $table = 'gallery';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['uid','image','desc','created_at']; 

    public function getImages($id)
    {
        $query = $this->db->table('gallery')
                ->where('uid',$id)
                ->orderBy('created_at','DESC')
                ->get();
        return $query;
    }
}