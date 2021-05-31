<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class compilerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function vizualizareprobleme(){
            $probleme = DB::select('select * from probleme');
            $rezolvata = DB::select('select * from solutii_probleme where id_user=:id', ['id' => Auth::user()->id]);
            return view('probleme', ['detalii' => $probleme, 'detalii_sol' => $rezolvata]);
    }
    public function vizualizare($id){
        if(!Auth::check()) {
            return redirect('login');
        } else {
            $detalii_solutie = DB::select('select * from solutii_probleme where id_solutie = :id', [':id' => $id])[0];
            return view('solutie', ['detalii' => $detalii_solutie]);
        }
    }

    public function vw(Request $request, $id){
        $detalii_problema = DB::select('select nume, dateIN, dateOUT, descriere, exempleIN, exempleOUT from probleme where id=:id', [':id'=>$id])[0];
        return view('problema', ['id_problema'=>$id,
            'cerinta'=>$detalii_problema->descriere,
            'nume'=>$detalii_problema->nume,
            'din'=>$detalii_problema->dateIN,
            'dout'=>$detalii_problema->dateOUT,
            'exin'=>$detalii_problema->exempleIN,
            'exout'=>$detalii_problema->exempleOUT
        ]);
    }

    public function compileAPI(Request $request, $id){
        $url = "https://ide.geeksforgeeks.org/main.php/";
        $nr_solutii = DB::select('select exempleIN from probleme where id=:id', [':id'=>$id]);
        $n = count(explode(" ", $nr_solutii[0]->exempleIN));
        $x = array();
        $y = array();
        $z = array();
        for($o1a=0; $o1a<$n; ++$o1a) array_push($x, rand(100, 200));
        for($o2a=0; $o2a<$n; ++$o2a) array_push($y, rand(30, 50));
        for($o3a=0; $o3a<$n; ++$o3a) array_push($z, rand(10, 30));
        $teste = array(
            0 => $x,
            1 => $y,
            2 => $z
        );
        $t = array(
            implode(' ', $x),
            implode(' ', $y),
            implode(' ', $z)
        );
        for($i=0; $i<3; ++$i){
            $data = array('lang' => 'Cpp',
                'code' => "#include <iostream> using namespace std; int main(){ cout<<3; return 0;}",
                'input'=> "$t[$i]",
                'save'=>false
            );
            $optiuni_user = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $datasolutie = array('lang' => 'Cpp',
                'code' => DB::select('select solutie from probleme where id=:id', [':id'=>$id])[0],
                'input'=> "$t[$i]",
                'save'=>false);
            $optiuni_db = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($datasolutie)
                )
            );
            $user  = stream_context_create($optiuni_user);
            $db  = stream_context_create($optiuni_db);
            $rs_user = file_get_contents($url, false, $user);
            $rs_db = file_get_contents($url, false, $db);

            if ($rs_user === FALSE) { /* Handle error */ }
            if ($rs_db === FALSE) { /* Handle error */ }
            $r[$i] = $rs_db;
            $u[$i] = $rs_user;
        }
            $punctaj = 0;
        for($c=0; $c<3; ++$c) {
            if(json_decode($r[$c])->output === json_decode($u[$c])->output) $punctaj++;
        }
        $id_solutie = Auth::user()->id.'_'.time();
        DB::insert('INSERT INTO solutii_probleme (id_user, id_problema, id_solutie, punctaj, solutie) VALUES (:id_user, :id_problema, :id_solutie, :punctaj, :solutie)', [
            ':id_user'=> Auth::user()->id,
            ':id_problema'=> $id,
            ':id_solutie'=> $id_solutie,
            ':punctaj' => $punctaj,
            ':solutie'=> $_POST['codproblema']
            ]);

        return redirect()->action('compilerController@vizualizare', ['id'=>$id_solutie]);
    }
}