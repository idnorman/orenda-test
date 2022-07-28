<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ItemRepository
{

	public function create($arrItem)
	{
		$items = array();
		foreach($arrItem as $el){
			$unit = explode(" ", $el['qty']);
			array_push($items, [
				'name'	=> $el['name'],
				'unit'	=> $unit[1]
			]);
		}

		\DB::transaction(function() use ($items) {
			foreach($items as $el){
				DB::table('items')->updateOrInsert(['name' => $el['name']], $el);
			}
		});
	}

	public function createUserKoliItem($user, $koli, $arrItem)
	{
		$userKoliId = DB::table('user_koli')
							->select('id')
							->where('user_key', $user)
							->where('koli_key', $koli)
							->first()->id;

		$items = array();
		foreach($arrItem as $el){
			$qty = explode(" ", $el['qty']);
			array_push($items, [
				'user_koli_id' => $userKoliId,
				'item_key'	=> $el['name'],
				'qty'	=> $qty[0]
			]);
		}
		
		\DB::transaction(function() use ($items){
			
			foreach($items as $el){
				$userKoliItem = DB::table('user_koli_item')->where('user_koli_id', $el['user_koli_id'])->where('item_key', $el['item_key']);
				
				if($userKoliItem->exists()){
					DB::table('user_koli_item')
						->where('id', $userKoliItem->first()->id)
						->update(['qty' => $userKoliItem->first()->qty + $el['qty']]);
				}else{
					DB::table('user_koli_item')->updateOrInsert($el);
				}
			}
		});

	}

	public function removeUserKoliItem($user, $koli, $arrItem)
	{
		$userKoliId = DB::table('user_koli')
							->select('id')
							->where('user_key', $user)
							->where('koli_key', $koli)
							->first()->id;

		$items = array();
		foreach($arrItem as $el){
			$qty = explode(" ", $el['qty']);
			array_push($items, [
				'user_koli_id' => $userKoliId,
				'item_key'	=> $el['name'],
				'qty'	=> $qty[0]
			]);
		}
		
		\DB::transaction(function() use ($items){
			
			foreach($items as $el){
				$userKoliItem = DB::table('user_koli_item')->where('user_koli_id', $el['user_koli_id'])->where('item_key', $el['item_key'])->first();
				
				if($userKoliItem->qty - $el['qty'] <= 0){
					DB::table('user_koli_item')
						->where('id', $userKoliItem->id)
						->delete();
				}else{
					DB::table('user_koli_item')
						->where('id', $userKoliItem->id)
						->update(['qty' => $userKoliItem->qty - $el['qty']]);
				}		
			}
		});

	}



}