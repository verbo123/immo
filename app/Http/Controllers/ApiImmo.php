<?php

namespace App\Http\Controllers;

use App\Marque;
use App\Modele;
use App\Reservation;
use App\TypeLogement;
use App\Voiture;
use Illuminate\Http\Request;
use Response;
use App\Articles;
use App\Images;

class ApiImmo extends Controller
{
    public function list(){
        $immo=Articles::select("*")->where('disponibilite','true')->get();
        return $immo;
    }

    public function findArticle($id){
        $article=Articles::select('*')->where('id',$id)->get();
        return $article;
    }

    public function findArticleByCategorie($cat){
        $article=Articles::select('*')->where('cat_id',$cat)->get();
        return $article;
    }

    public function findmodele($id){
        $immo=Modele::select("*")->where('marque_id',$id)->get();
        return $immo;
    }

    public function getMarque(){
        $immo=Marque::select("*")->get();
        return $immo;
    }


    public function showImage($id){
        $img=Images::select("*")->where('id_article',$id)->get();
        return $img;
    }

    public function type_logement($id){
        $lib=TypeLogement::select("libelle")->where('id',$id)->get();
        return $lib;
    }

    public function voiture_caracteristique($id){
        $lib=Voiture::select("*")->where('id_voiture',$id)->get();
        return $lib;
    }


    public function create(Request $request){
      $article=new Articles;
        $article->name=$request->input('name');
        $article->description=$request->input('description');
        $article->prix=$request->input('prix');
        $article->cat_id=$request->input('cat_id');
        $article->disponibilite=$request->input('disponibilite');
        $article->numero=$request->input('numero');
        $article->autre_description=$request->input('autre_description');

        if($request->input('cat_id') == 'IMO'){
            $article->type_logement=$request->input('type_logement');
            $article->quatier=$request->input('quartier');
            if($article->save()){
                return Response::json(['msg' => "SUCCES"],200);
            }
        }elseif ($request->input('cat_id') == 'AUT'){
            $article->save();
             $voiture=new Voiture;
             $voiture->id_voiture=$article->id;
             $voiture->marque=$request->input('marque');
             $voiture->modele=$request->input('modele');
            $voiture->vitesse=$request->input('vitesse');
            if($voiture->save()){
                return Response::json(['msg' => "SUCCES"],200);
            }
        }
    }

    public function uploadFile(Request $request){
        $files=$request->file('file');
        $allowedfileExtension=['jpg','JPG','png','PNG','JPEG','jpeg'];
        $extension=$files->getClientOriginalExtension();
        if(in_array($extension,$allowedfileExtension)){
            $filename=time().'-'.$files->getClientOriginalName();
            $destination="uploads";
            $enre=$files->move($destination,$filename);
            if($enre){
                $image=new Images;
                $image->chemin='/uploads/'.$filename;
                $image->principal= $request->input('principal');
                $image->id_article = $request->input('id_article');
                if($image->save()){
                    return Response::json(['msg' => "SUCCES"],200);
                }
            }else{
                return Response::json(['msg' => 'Une erreur s\'est produite, veuillez réessayer !'],501);
            }
        }else{
            return Response::json(['msg' => 'Format de l\'image invalide ! '],401);
        }

    }


    public function reserve_auto(Request $request)
    {
        $reservation=new Reservation;

        $id=$request->input('id_article');
        $debut=$request->input('datedebut');
        $fin=$request->input('datefin');

        $reservation->nomcomplet=$request->input('nomcomplet');
        $reservation->tel=$request->input('tel');
        $reservation->email=$request->input('email');
        $reservation->message=$request->input('message');
        $reservation->datedebut=$debut;
        $reservation->datefin=$fin;
        $reservation->id_article=$id;
        $reservation->valider="false";
        $reservation->user=$request->input("user");

        $data=Reservation::where('id_article',$id)
            ->where('datedebut','<=',$debut)
            ->where('datefin','>=',$fin)
            ->where('valider',true)
            ->first();
        if($data)
        {
            return 'true';
        }else{
            $reservation->save();
            return 'false';
        }
    }



}
