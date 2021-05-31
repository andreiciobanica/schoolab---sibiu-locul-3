<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class cursuriController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function viewCursuri()
    {
        $cursuri = DB::select('select * from cursuri');
        $inscris = DB::select('select id_curs from utilizatori_curs where id_user=:id_user', [':id_user' => Auth::user()->id]);
        return view('cursuri', ['cursuri' => $cursuri, 'verificare_cursuri' => $inscris]);
    }

    public function vizualizarecurs(Request $request, $id)
    {
        $max_id = DB::select('SELECT MAX(id) as id FROM cursuri')[0];
        if ($max_id->id < $id) {
            abort(404);
        } else {
            $user_check = DB::select('select * from utilizatori_curs where id_curs=:id and id_user=:id_user', [':id' => $id, 'id_user' => Auth::user()->id]);
            $curs = DB::select('select * from cursuri where id=:id', [':id' => $id])[0];
            $capitole = DB::select('select * from capitole where id_curs=:id', [':id' => $id]);
            $lectii = DB::select('select titlu, id_capitol from lectii');

            return view('curs', ['curs' => $curs, 'capitole' => $capitole, 'lectii' => $lectii, 'user_check' => $user_check]);
        }
    }

    public function vizualizarelectie(Request $request, $id_curs, $id_capitol, $id_lectie)
    {
        $usercapitol = DB::select('select * from utilizatori_curs where id_user = :id and id_curs=:id_curs', [':id'=>Auth::user()->id, ':id_curs'=>$id_curs])[0]->id_capitol;
        if($usercapitol != $id_capitol){
            abort(403, 'Deja sunteți la o altă lecție!');
        } else {
            $lectie = DB::select('select * from lectii where id_curs = :id_curs and id = :id_lectie and id_capitol=:id_capitol', [':id_curs' => $id_curs, ':id_lectie' => $id_lectie, ':id_capitol' => $id_capitol])[0];
            return view('lectie', [
                'id_curs' => $id_curs,
                'id_capitol' => $id_capitol,
                'id_lectie' => $id_lectie,
                'lectie' => $lectie
            ]);
        }

        $nr_cap = DB::select('select * from capitole where id_curs=:id_curs', [':id_curs' => $id_curs]);
        $userinfo = DB::select('select * from utilizatori_curs where id_user = :id and id_capitol = :id_capitol', [':id' => Auth::user()->id, ':id_capitol' => $id_capitol])[0];
        if(count($nr_cap)<$userinfo->id_capitol){
            abort(403, "Ați terminat cursul! Mulțumim!");
        }
    }

    public function quiz(Request $request, $id_curs, $id_capitol, $id_lectie)
    {
        $usercapitol = DB::select('select * from utilizatori_curs where id_user = :id and id_curs=:id_curs', [':id'=>Auth::user()->id, ':id_curs'=>$id_curs])[0]->id_capitol;
        if($usercapitol!=$id_capitol){
            abort(403, 'Deja sunteți la o altă lecție!');
        } else {
            $quiz = DB::select('select * from quiz where id_curs=:id_curs and id_capitol=:id_capitol and id_lectie=:id_lectie', [':id_curs' => $id_curs, ':id_capitol' => $id_capitol, ':id_lectie' => $id_lectie])[0];
            $userinfo = DB::select('select * from utilizatori_curs where id_user = :id', [':id' => Auth::user()->id])[0];
            if ($id_capitol < $userinfo->id_capitol || $id_lectie < $userinfo->pg_ramas) {
                abort(403, "Ați trecut deja de această lecție!");
            }
            return view('quiz', [
                'id_curs' => $id_curs,
                'id_capitol' => $id_capitol,
                'id_lectie' => $id_lectie,
                'detalii' => $quiz
            ]);
        }
    }

    public function verificarequiz(Request $request, $id_curs, $id_capitol, $id_lectie)
    {
        $nr_cap = DB::select('select * from capitole where id_curs=:id_curs', [':id_curs'=>$id_curs]);
        $quiz = DB::select('select raspunscorect from quiz where id_curs=:id_curs and id_capitol=:id_capitol and id_lectie=:id_lectie', [':id_curs' => $id_curs, ':id_capitol' => $id_capitol, ':id_lectie' => $id_lectie])[0];
        $userinfo = DB::select('select * from utilizatori_curs where id_user = :id and id_capitol = :id_capitol', [':id' => Auth::user()->id, ':id_capitol' => $id_capitol])[0];
        if(count($nr_cap)<$userinfo->id_capitol){
            route('profil', ['id'=>Auth::user()->id]);
        }
        if ($id_capitol < $userinfo->id_capitol || $id_lectie < $userinfo->pg_ramas) {
            abort(403, "Ați trecut deja de această lecție!");
        }
        if (strval(count(explode('~', $quiz->raspunscorect))) == strval($_POST['results'])) {
            $ct = DB::select('select * from lectii where id_curs = :id_curs and id_capitol=:id_capitol', [':id_curs' => $id_curs, ':id_capitol' => $id_capitol]);
            $last = array_key_last($ct) + 1;
            if (count($ct) == 1 || ($last == $userinfo->pg_ramas)) {
                $next = 1;
                $nextc = $userinfo->id_capitol+1;
                DB::update("update utilizatori_curs set id_capitol = '$nextc', pg_ramas = '$next' where id_user = ? and id_capitol = ? and id_curs= ?", [Auth::user()->id, $id_capitol, $id_curs]);
            } else {
                $next = $userinfo->pg_ramas+1;
                $nextc = $userinfo->id_capitol;
                DB::update("update utilizatori_curs set pg_ramas = '$next' where id_user = :id and id_capitol = :id_capitol and id_curs=:id_curs", [':id' => Auth::user()->id, ':id_capitol' => $id_capitol, ':id_curs' => $id_curs]);
            }
        }
        if(strval(count(explode('~', $quiz->raspunscorect))) != strval($_POST['results'])){
            $nextc = $id_capitol;
            $next = $id_lectie;
        }
        if(count($nr_cap)<$userinfo->id_capitol){
            abort(403, "Ați terminat cursul! Mulțumim!");
        }
        return view('rquiz', [
            'id_curs' => $id_curs,
            'id_capitol' => $id_capitol,
            'id_lectie' => $id_lectie,
            'nextc' => $nextc,
            'nextl' => $next,
            'verificare' => strval(count(explode('~', $quiz->raspunscorect))) == strval($_POST['results'])
        ]);
    }

    public function inscriere(Request $request, $id)
    {
        $inscris = DB::select('select * from utilizatori_curs where id_curs=:id_curs and id_user=:id_user', [':id_curs' => $id, ':id_user' => Auth::user()->id]);
        if (empty($inscris)) {
            DB::table('utilizatori_curs')->insert(
                [
                    'id_curs' => $id,
                    'id_user' => Auth::user()->id,
                    'id_capitol' => 1,
                    'pg_ramas' => 1,
                    'data_incepere' => date('Y-m-d H:i:s')
                ]
            );
            return view('inscrierecurs', ['id'=>$id]);
        } else {
            abort(403, "Sunteți deja înscris la acest curs!");
        }
    }
}
