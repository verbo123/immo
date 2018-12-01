<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $title='Accueil';
    $json=\App\Helpers\UrlApi::getArticles();
    return view('welcome',array('title'=>$title, 'json' => $json));
});


Route::get("/automobile","Automobiles@auto")->name('automobile');
Route::get("/logements","Logement@loge")->name('logements');
Route::get("/details","Details@detail")->name('detail');
Route::get("/all","All@all_article")->name('all');
Route::get("/contact","Contact@contact")->name('contact');

Route::post('/search', function ()
{
$q=\Illuminate\Support\Facades\Input::get('quatier');
$mot=\Illuminate\Support\Facades\Input::get('mot');

if($q != '' && $mot == ''){
    $log=\App\Articles::where('cat_id','IMO')
                                        ->where('quatier','LIKE','%'.$q.'%')
                                        ->get();
    $title='Résultats';
    $res=$q;
    return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
}elseif ($q == '' && $mot != ''){
    $log=\App\Articles::where('cat_id','IMO')
        ->where('name','LIKE','%'.$mot.'%')
        ->get();
    $title='Résultats';
    $res=$mot;
    return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
}elseif ($q != '' && $mot != ''){
    $log=\App\Articles::where('cat_id','IMO')
        ->where('quatier','LIKE','%'.$q.'%')
        ->orwhere('name','LIKE','%'.$mot.'%')
        ->get();
    $title='Résultats';
    $res=$q.', '.$mot;
    return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
}




})->name('search');


Route::post('/search_auto', function ()
{
    $marq_id=\Illuminate\Support\Facades\Input::get('marq');
    $model_id=\Illuminate\Support\Facades\Input::get('model');
    $prix=\Illuminate\Support\Facades\Input::get('prix');
    $desc=\Illuminate\Support\Facades\Input::get('prixmax');

    $mque=\App\Marque::select('*')->where('idmarque',$marq_id)->get();
    $mo=\App\Modele::select('*')->where('idmodele',$model_id)->get();

    $marq='';
    $model='';
    if($marq_id != '' || $model_id != '')
    {
        $marq=$mque[0]->libelle;
        $model=$mo[0]->libelle;
    }



    if($marq != '' && ($model == '' && $prix == '' && $desc == '')){
        $log=\App\Articles::select('*')
            ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
            ->where('voiture_caracteristique.marque','LIKE','%'.$marq.'%')
            ->get();


        $title='Résultats';
        $res='Marque :'.$marq;
        return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
    }else{
        if($marq == '' && $model != '' && $prix == '' && $desc == ''){
            $log=\App\Articles::select('*')
                ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
                ->where('voiture_caracteristique.modele','LIKE','%'.$model.'%')
                ->get();


            $title='Résultats';
            $res='Modèle :'.$model;
            return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
        }else{
            if($marq == '' && $model == '' && $prix != '' && $desc == ''){
                $log=\App\Articles::select('*')
                    ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
                    ->where('articles_immo.prix','>=',$prix)
                    ->get();

                $title='Résultats';
                $res='Prix Minimal : '.$prix;
                return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
            }else{
                if($marq == '' && $model == '' && $prix == '' && $desc != '')
                {
                    $log=\App\Articles::select('*')
                        ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
                        ->where('articles_immo.prix','<=',$desc)
                        ->get();

                    $title='Résultats';
                    $res='Prix Maximal :'.$desc;
                    return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
                }else{
                    if($marq != '' && $model != '' && $prix != '' && $desc != '')
                    {
                        $log=\App\Articles::select('*')
                            ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
                            ->where('voiture_caracteristique.modele','LIKE','%'.$model.'%')
                            ->where('voiture_caracteristique.marque','LIKE','%'.$marq.'%')
                            ->where('articles_immo.prix','>=',$prix)
                            ->where('articles_immo.prix','<='.$desc.'%')
                            ->get();

                        $title='Résultats';
                        $res='Marque :'.$marq.' , Prix Minimal : '.$prix.' , Prix Maximal :'.$desc.' , Modèle :'.$model;
                        return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
                  }else{

                        if($marq != '' && $model != '' && $prix == '' && $desc == '')
                        {
                            $log=\App\Articles::select('*')
                                ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
                                ->where('voiture_caracteristique.modele','LIKE','%'.$model.'%')
                                ->where('voiture_caracteristique.marque','LIKE','%'.$marq.'%')
                                ->get();

                            $title='Résultats';
                            $res='Marque :'.$marq.' , Modèle :'.$model;
                            return view('all',array('log'=>$log,'title'=>$title,'q' => $res));

                        }else{

                            if($marq != '' && $model == '' && $prix != '' && $desc == '')
                            {
                                $log=\App\Articles::select('*')
                                    ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
                                    ->where('articles.prix','<=',$prix)
                                    ->where('voiture_caracteristique.marque','LIKE','%'.$marq.'%')
                                    ->get();

                                $title='Résultats';
                                $res='Marque :'.$marq.' , Prix Minimal :'.$prix;
                                return view('all',array('log'=>$log,'title'=>$title,'q' => $res));

                            }else{
                                if($marq == '' && $model == '' && $prix != '' && $desc != '')
                                {
                                    $log=\App\Articles::select('*')
                                        ->join('voiture_caracteristique','voiture_caracteristique.id_voiture','=','articles_immo.id')
                                        ->where('articles_immo.prix','>=',$prix)
                                        ->where('articles_immo.prix','<='.$desc.'%')
                                        ->get();

                                    $title='Résultats';
                                    $res='Prix Minimal : '.$prix.' , Prix Maximal :'.$desc;
                                    return view('all',array('log'=>$log,'title'=>$title,'q' => $res));
                                }
                            }


                        }


                    }

                }

            }
        }
    }




})->name('search_auto');

