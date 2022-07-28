<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class KoliRepository
{

	public function create($koli)
	{
		DB::table('koli')->updateOrInsert(['koli' => $koli]);
	}

	public function createUserKoli($user, $koli)
	{
		DB::table('user_koli')->updateOrInsert(['user_key' => $user, 'koli_key' => $koli]);
	}

	public function getCommon($users)
	{
		
		$query = DB::table('user_koli');
		$query->select('koli.koli');
		$query->join('koli', 'koli.koli', '=', 'user_koli.koli_key');
		$query->whereIn('user_koli.user_key', $users);
		$query->groupBy('koli.koli');
		$query->havingRaw("COUNT(distinct user_koli.user_key) = " . count($users));
		$koliId = $query->get();
		
		$userKoli = DB::table('user_koli');
		$userKoli->select('user_koli.koli_key as koli','items.name', 'items.unit', 'user_koli_item.qty');
		$userKoli->join('user_koli_item', 'user_koli.id', '=', 'user_koli_item.user_koli_id');
		$userKoli->join('items', 'items.name', '=', 'user_koli_item.item_key');
		$userKoli->whereIn('user_koli.user_key', $users);
		$userKoli->whereIn('user_koli.koli_key', $koliId->pluck('koli')->flatten()->toArray());
		$koli = $userKoli->get()->groupBy('koli');
		
		$temp = array();
		
		$koliCounter = 0;
		foreach($koli as $koliKey => $items){
			array_push($temp, ['koli' => $koliKey, 'item' => array()]);
			foreach($items as $item){
				array_push($temp[$koliCounter]['item'], [
					'name' => $item->name,
					'qty' => $item->qty . ' ' . $item->unit
				]);
			}
			$koliCounter++;
		}
		return $temp;
	}
}
