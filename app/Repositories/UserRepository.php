<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepository
{

	public function create(array $data)
	{
		$users = array();
		foreach($data as $el){
			array_push($users, ['email' => $el]);
		}
		DB::table('users')->insert($users);
	}

}