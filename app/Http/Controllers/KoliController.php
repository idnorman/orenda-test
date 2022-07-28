<?php

namespace App\Http\Controllers;

use App\Repositories\KoliRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KoliController extends Controller
{
    private $koliRepository;

    public function __construct(KoliRepository $koliRepository)
    {
        $this->koliRepository = $koliRepository;
    }

    public function getCommon(Request $request)
    {
        $data = $this->koliRepository->getCommon(json_decode($request->user, true));
        
        return response()->json($data);
        
    }
}
