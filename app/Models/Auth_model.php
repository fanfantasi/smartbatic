<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Auth_model extends Model
{
	protected $table = 'users';
    protected $primeryKey ='_id';

    public function chekLogin($user)
    {
        $result = $this->table($this->table)
                ->Where('deleted_at', null)
                ->where('is_active', 1)
                ->where('is_level !=', 1)
                ->where('email', $user)
                ->get();
        return $result;
    }
}