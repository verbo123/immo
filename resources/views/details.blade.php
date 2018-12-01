@extends('layouts.master')
@section('content')
    <?php
        $data=\App\Helpers\UrlApi::find_article(app('request')->input('view'));
        $mesImg=\App\Helpers\UrlApi::findData(app('request')->input('view'));

    ?>

      <link rel="stylesheet" href="public/myassets/advance-elements/css/bootstrap-datetimepicker.css" />

       
      <!-- Date-range picker css  -->
      <link rel="stylesheet" type="text/css" href="public/myassets/bootstrap-daterangepicker/css/daterangepicker.css" />
      <!-- Date-Dropper css -->
      <link rel="stylesheet" type="text/css" href="public/myassets/datedropper/css/datedropper.min.css" />


<section class="main">
    <div class="row" style="font-size: 0px;">
        <div class="col-lg-8 col-md-12 mx-0 px-0">
            <div id="thumbnail-slider" style="float:left;">
                <div class="inner">

                    <ul>
                        @foreach($mesImg as $i)

                                <li>
                                    <a  href="{{ $i->chemin  }}" class="thumb" ></a>
                                </li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="ninja-slider" style="float:left;">
                <div class="slider-inner">
                    <ul>
                        @foreach($mesImg as $i)

                                <li>
                                    <a  href="{{ $i->chemin  }}" class="ns-img" ></a>
                                </li>


                        @endforeach
                    </ul>
                    <div class="fs-icon" title="Expand/Close"></div>
                </div>
            </div>
        </div>
        <div class=" col-lg-4 col-md-12 px-3 py-4 slider-t-details">
            <p style="font-size: 1rem; text-align: center">
               @if($data[0]->cat_id == 'IMO')
                Pour plus de détails, veuillez nous joindre directement au :
                @else

                    Pour une réservation, veuillez nous joindre au :

                @endif
            </p>

            <h5 style="text-align: center;color: white">{{ str_replace("-","",$data[0]->numero,$dai) }}</h5>
            <div class="row">
                <div class="col-md-5">
                    <hr style="border-color: #fff;">
                </div>
                <div  class="col-md-2 center" style="font-size: 18px;">
                    OU
                </div>
                <div class="col-md-5">
                    <hr style="border-color: #fff;">
                </div>
            </div>
            <h5 class="text-center">Écrivez-Nous</h5>
            <p class="" style="font-size: 12px;text-align: center">
                *Tous les champs sont nécessaires
            </p>
            <div>
                <div class="input-group mb-2">
                    <input id="nom" required="required" type="text" name="" placeholder="Nom & Prénom(s)" class="form-control">
                </div>
                <div class="row mb-2">
                    <div class="input-group col-6">
                        <input id="email" required="required" type="email" name="" placeholder="Email" class="form-control">
                    </div>
                    <div class="input-group col-6">
                        <input id="tel" required="required" type="tel" name="" placeholder="Téléphone" class="form-control">
                    </div>
                </div>

             
                
                <div class="input-group mb-2">
                    <textarea id="msg" cols="5" placeholder="Votre message" class="form-control"></textarea>
                </div>

   @if($data[0]->cat_id == 'AUT')

                    <p class="" style="font-size: 12px;text-align: center">
                           Date du début et Fin de réservation
                     </p>

                  <div class="row mb-2">
                    <div class="input-group col-6">
                         <input required="required" id="debut" class="form-control" type="date" placeholder="Du"  />
                    </div>
                    <div class="input-group col-6">
                         <input required="required" id="fin" class="form-control" type="date" placeholder="Au"  />
                    </div>
                </div>

    @endif


                <button onclick="reserve('{{$data[0]->id}}','{{$data[0]->user}}')" class="btn btn-primary btn-block"> Envoyer </button>
            </div>
        </div>
    </div>
</section>
<section class="grey">
    @foreach( $data as $a)
        <h3 class="">
                {{$a->name}}
        </h3>
        <h3 class="text-danger">
            @if($a->cat_id == 'IMO')
                {{'CFA '.$a->prix}}
                @else
                {{'CFA '.$a->prix.'  / JOUR'}}
            @endif

        </h3>

        <h6 class="text-muted m-0">
            @if($a->cat_id == 'IMO')
                {{'Quartier : '.$a->quatier}}
            @endif
        </h6>

        <h4 class="title mt-5">
            @if($a->cat_id == 'IMO')
                Détails du logement
            @else
                Détails de l'automobile
            @endif
        </h4>

        <p class="text-justify">
            {{ $a->description }}
        </p>

        @if($a->autre_description != '')
            <h4 class="title mt-5">Autres détails</h4>
            <p class="text-justify">
              {{ $a->autre_description}}
            </p>
            @if($a->cat_id == 'AUT')


                <ul>
                    @foreach(\App\Helpers\UrlApi::findVoiture(app('request')->input('view')) as $dt)

                     <?php 
                         $mque=\App\Marque::select('*')->where('idmarque',$dt->marque)->get();
                         $mo=\App\Modele::select('*')->where('idmodele',$dt->modele)->get();
                    ?>
                    <li>
                            Boîte :  {{$dt->vitesse}}
                    </li>
                    <li>
                            Modèle :  {{$mo[0]->libelle}}
                    </li>
                    <li>
                            Marque :  {{$mque[0]->libelle}}
                    </li>
                    @endforeach
                </ul>

            @endif
        @endif

    @endforeach

    <p  class="text-center">
        <button id="txt" class="btn btn-primary btn-large">Réserver</button>
    </p>
    
    <h4 class="title mt-5">Vous aimeriez aussi</h4>

    <div class="row">
        <?php
        $k=0;
        ?>
        @foreach( \App\Helpers\UrlApi::find_article(app('request')->input('view')) as $a)
          @foreach(\App\Helpers\UrlApi::getArticles() as $valeu)

                @if($valeu->cat_id == $a->cat_id)
                      @if($k <=4)
                        <div class="col item-list style-2">
                            <div class="item-image py-3">
                                @foreach(\App\Helpers\UrlApi::findData($valeu->id) as $i)

                                        @if($i->principal == 'true')
                                            <img  src="{{ $i->chemin  }}" alt="" class="img img-responsive">
                                        @endif

                                @endforeach
                            </div>
                            <div class="item-desc-top text-center style-2 py-2">
                                <div class="part-1">
                                    <h5>{{$valeu->name}}</h5>
                                    <p class="text-muted m-0">
                                        @if($valeu->cat_id == 'IMO')
                                            {{'Quartier : '.$valeu->quatier}}
                                        @endif
                                    </p>
                                    <p class="text-danger m-0 price">CFA {{$valeu->prix}}</p>
                                </div>
                                <div class="part-2">
                                    <h5>{{$valeu->name}}</h5>
                                    <a href="{{route('detail',['view'=>$valeu->id])}}" class="btn btn-primary">Réserver</a>
                                </div>
                            </div>
                        </div>
                                <?php
                                $k++;
                                ?>
                        @endif
                    @endif
                @endforeach

        @endforeach
    </div>


        <div class="modal fade" id="loader" tabindex="-1" role="dialog"
             aria-labelledby="staticModalLabel" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div style="background-color: transparent; border: none;margin-top: 50%"
                     class="modal-content">
                    <div style="background-color: transparent;" class="modal-body">
                        <div style="background-color: transparent;border: none" class="card">
                            <div style="margin: 0 auto;" class="card-body">

                                <img src="public/myassets/Loader.gif"/>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="succes" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div  class="modal-content">
                    <div style="background-color: #f7f7f7" class="modal-body">
                        <div style="background-color: #f7f7f7"  class="card">
                            <div id="msgsuccess" style="margin: 0 auto;" class="card-body">




                            </div>
                            <div style="background-color: #f7f7f7" class="modal-footer">
                                <button style="width: 100%;" id="actualise" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <style type="text/css">
        hr{
            margin-top: 0;
        }
        #ou{
            /*overflow: hidden;*/
            text-align: center;
        }
        #ou:before, #ou:after{
            background-color: #fff;
            content: "";
            display: inline-block;
            height: 1px;
            position: relative;
            vertical-align: middle;
            width: 50%;
        }

        #ou:before{
            right: 0.5em;
            margin-left: -50%;
        }

        #ou:after{
            left: 0.5em;
            margin-right: -50%;
        }
    </style>

<script type="text/javascript" src="public/myassets/js/jquery-2.1.3.min.js"></script>


</section>


    <script type="text/javascript">
        function conver(dte) {
            var d=new Date(dte);
            var options={weekday:"long",year:"numeric",month:"long",day:"numeric"};
            return d.toLocaleDateString("fr-FR",options);
        }

        function reserve(id,user)
        {
             nom=$('#nom').val();
            var tel=$('#tel').val();
            var email=$('#email').val();
            var debut = $('#debut').val();
            var fin=$('#fin').val();
            var msg=$('#msg').val();

            if(nom != "" && tel != "" && email != "" && debut !="" && fin !="" && msg !="")
            {
                $.ajax({
                    url:'{{\App\Helpers\UrlApi::url_api_rest()."/reservation"}}',
                    type:'POST',
                    data: "datedebut="+encodeURIComponent(debut)+"&datefin="+encodeURIComponent(fin)
                    +"&nomcomplet="+encodeURIComponent(nom)+"&tel="+encodeURIComponent(tel)
                    +"&email="+encodeURIComponent(email)+"&message="+encodeURIComponent(msg)+"&user="+encodeURIComponent(user)
                    +"&id_article="+id,
                    beforeSend : function () {
                        $("#loader").modal('show');
                    },
                    success : function (data)
                    {
                        data=JSON.parse(data);
                       // console.log(data);
                        setTimeout(function () {
                            if(data == true)
                            {
                                $("#loader").modal('hide');
                                $('#msgsuccess').html("<p style='text-align: center; color: red;font-weight: 800'>Désolé, cette voiture n'est pas disponible pour le moment durant la période du <span style='color:black'> "+conver(debut)+"</span>  au <span style='color:black'> "+conver(fin)+" </span>  !</p>");
                                $('#succes').modal('show');

                            }else{
                                if(data == false)
                                {

                                    $("#loader").modal('hide');
                                    $('#msgsuccess').html("<p style='text-align: center; color: green;font-weight: 800'>Réservation effectuée avec succès durant la période du <span style='color:black'> "+conver(debut)+" </span> au  <span style='color:black'>"+conver(fin)+" </span>  !</p> <p style='text-align: center; color: green; font-style: oblique; font-size: 18px '> Merci pour votre confiance !</p>");
                                    $('#succes').modal('show');

                                    $('#nom').val("");
                                    $('#tel').val("");
                                    $('#email').val("");
                                    $('#debut').val("");
                                    $('#fin').val("");
                                    $('#msg').val("");


                                }
                            }
                        },5000);

                    }

                });
            }else{
                alert("Veuillez remplir touts les champs !");
            }

        }

    </script>
@endsection
