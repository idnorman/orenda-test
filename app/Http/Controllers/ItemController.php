<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemPutInRequest;
use App\Http\Requests\ItemTakeOutRequest;
use App\Repositories\ItemRepository;
use App\Repositories\KoliRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{

    private $koliRepository;
    private $itemRepository;

    public function __construct(KoliRepository $koliRepository, ItemRepository $itemRepository)
    {
        $this->koliRepository = $koliRepository;
        $this->itemRepository = $itemRepository;
    }

    public function putIn(ItemPutInRequest $request){

        $this->koliRepository->create($request->koli);
        $this->itemRepository->create($request->item);
        $this->koliRepository->createUserKoli($request->user, $request->koli);
        $this->itemRepository->createUserKoliItem($request->user, $request->koli, $request->item);

        return response()->json(null, Response::HTTP_NO_CONTENT);

    }

    public function takeOut(ItemTakeOutRequest $request){

        $this->itemRepository->removeUserKoliItem($request->user, $request->koli, $request->item);

        return response()->json(null, Response::HTTP_NO_CONTENT);

    }

}
