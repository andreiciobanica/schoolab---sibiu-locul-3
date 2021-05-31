<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class solutieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function vwuser(Request $request, $id){
        $detalii_solutie = DB::select('select * from solutii_probleme where id_user = :id', [':id' => $id]);
        $detalii_problema = DB::select('select * from probleme');
        $nickname = DB::select('select nickname from users where id=:id', [':id'=>$id])[0]->nickname;
        return view('solutiiuser', ['detalii' => $detalii_solutie, 'detalii_p'=>$detalii_problema, 'nick'=>$nickname]);
    }

    public function vw(Request $request, $id){
        $detalii_solutie = DB::select('select * from solutii_probleme where id_problema = :id', [':id' => $id])[0];
        return view('solutie', ['detalii' => $detalii_solutie]);
    }
}
