<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\RequiredIf;
use Image;


class profilController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function viewProfil(){
    	return view('profil', array('user' => Auth::user()));
    }

    public function avatarpost(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = Auth::user()->id.'_'.time() . '.' . $avatar->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('avatar'), $filename);
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            return redirect()->back()->with('success', 'Ați schimbat poza de profil!');
        }
        return redirect()->back()->with('error', 'Nu ați selectat nicio poză pentru a putea fi încărcată!');
    }

    public function cursurilemele()
    {
        $s = "select * from cursuri ";
        $i = 0;
        $cursuri_inscris = DB::select('select * from utilizatori_curs where id_user=:id', [':id' => Auth::user()->id]);
        if(!empty($cursuri_inscris)){
            $s .= "where ";
        foreach($cursuri_inscris as $key => $curs){ 
            if(++$i === count($cursuri_inscris)){
                $s .= "id=". $curs->id_curs;
            } else {
            $s .= "id=". $curs->id_curs . "||";
            }
        }
    }
        if($s==="select * from cursuri "){
            $cursuri = "";
        } else {
            $cursuri = DB::select($s);
        }
        return view('cursurilemele', ['cursuri' => $cursuri]);
    }

    public function cursget(Request $request, $id)
    {
        $max_id = DB::select('SELECT MAX(id) as id FROM cursuri')[0];
        if ($max_id->id < $id) {
            abort(404);
        } else {
            $curs = DB::select('select * from cursuri where id=:id', [':id' => $id])[0];
            $capitole = DB::select('select * from capitole where id_curs=:id', [':id' => $id]);
            $lectii = DB::select('select titlu, id_capitol, id from lectii');
            $completed = DB::select('select * from utilizatori_curs where id_user=:id and id_curs=:id_curs', [':id' => Auth::user()->id, ':id_curs' => $id])[0];
            return view('cm', ['curs' => $curs, 'capitole' => $capitole, 'lectii' => $lectii, 'detalii_curs' => $completed]);
        }
    }

}
