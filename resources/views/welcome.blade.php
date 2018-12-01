
@extends('layouts.master')

@section('content')
<div class="slider">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="public/images/senna.png" class="slider-image" >
                <div class="slider-content">
                    <h2>Trouvez ce qui vous corresponds le mieux</h2>
                    <h4 style="text-transform: inherit">Trouvez des automobiles et logement partout au Bénin</h4>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="public/images/bat.jpg" class="slider-image" >
                <div class="slider-content">
                    <h2>Trouvez ce qui vous corresponds le mieux</h2>
                    <h4 style="text-transform: inherit">Trouvez des automobiles et logement partout au Bénin</h4>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div class="slider-div">
        <h4 style="text-transform: uppercase">Trouvez un automobile ou un logement <span class="text-primary">RAPIDEMENT</span></h4>

        <form class="filter-form text-center" method="post">
            <div class="form-check form-check-inline">
                <input  checked="checked" class="form-check-input" type="radio" name="type" id="c_logement" value="option2">
                <label class="form-check-label" for="c_logement">LOGEMENT</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="c_automobile" value="option1">
                <label class="form-check-label" for="c_automobile">AUTOMOBILE</label>
            </div>
        </form>

        <form class="filter-form text-center" action="{{route('search')}}" method="post">
            {{csrf_field()}}
            <div id="rech1" class="form-inline mt-3 center">
                <div  class="form-group mx-sm-3 m-2">
                    <select id="vil" name="ville" style="width: 150px" class="form-control">
                        <option value="cotonou">Cotonou</option>
                    </select>
                </div>
                <div class="form-group mx-sm-3 m-2">
                    <input id="quat" name="quatier" type="text" class="form-control" placeholder="Quartier" />
                    {{--<select style="width: 200px" class="form-control">--}}
                        {{--<option>Quartier</option>--}}
                        {{--<option value="calavie">Calavie</option>--}}
                        {{--<option value="godomey">Godomey</option>--}}
                    {{--</select>--}}
                </div>
                <div class="form-group mx-sm-3 m-2">
                    <input id="mo" name="mot" type="text" class="form-control" placeholder="mot-clé..." />
                </div>
                <button id="lanc" type="submit" class="btn btn-primary m-2">Rechercher</button>
            </div>

        </form>

            <div id="rech2" style="display: none;width: 100%" class="mt-3">
                <form class="filter-form text-center" action="{{route('search_auto')}}" method="post">
                    {{csrf_field()}}
                      <div  class="row">
                        <div class="cl form-group col">

                            <select id="marq" name="marq" style="width: 200px" class="form-control">
                                <option value="">Marques</option>
                                @foreach(\App\Helpers\UrlApi::getAllMarques() as $m)
                                    <option value="{{$m->idmarque}}">{{$m->libelle}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="cl form-group col">
                            {{--<input  style="" type="text" class="form-control" placeholder="Modèle" />--}}
                            <select id="model" name="model" style="width: 200px" class="form-control">
                                <option value="">Modèle</option>
                            </select>
                        </div>

                        <div class="cl form-group col">
                            <input name="prix" id="prix" style="" type="number" class="form-control" placeholder="Prix min" />

                            {{--<select style="width: 200px" class="form-control">--}}
                                {{--<option>Prix Max</option>--}}
                            {{--</select>--}}
                        </div>


                        <div class="cl form-group col">
                            <input name="prixmax" id="prixmax" style="" type="number" class="form-control" placeholder="Prix max" />
                        </div>

                    <div class="cl form-group col">
                        <button id="rech_auto" style="" type="submit" class="btn btn-primary btn-block mb-2">Rechercher</button>
                    </div>

                </div>
                </form>
            </div>


    </div>
</div>
<div class="space">
</div>
<section class="grey">
    <h3 class="title">Automobiles</h3>
    <p class="text-justify content-text">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
    <div class="row p-row">
        <?php
                $j=0;
        ?>
        @foreach($json as $valeu)

                @if($valeu->cat_id == 'AUT')
                  @if($j < 4 )
                        <div class="col item-list mb-5">
                            <div class="item-desc-top">
                                <h5 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                    {{$valeu->name}}
                                </h5>
                                <p class="text-muted m-0">
                                    @foreach(\App\Helpers\UrlApi::findVoiture($valeu->id) as $dt)
                                        {{$dt->vitesse}}
                                    @endforeach
                                </p>
                                <p class="text-danger m-0 price">CFA {{$valeu->prix.' /JOUR'}}</p>
                            </div>
                            <div class="item-image py-3">

                                @foreach(\App\Helpers\UrlApi::findData($valeu->id) as $p)

                                        @if($p->principal == 'true')
                                            <img  src="{{ $p->chemin  }}" alt="" class="img img-responsive">
                                        @endif

                                @endforeach

                            </div>
                            <div class="item-desc-bottom">
                                <a href="{{route('detail',['view'=>$valeu->id])}}" class="text-dark my-1" >Détails <i class="fa fa-angle-right pull-right"></i> </a>
                                <a href="{{route('detail',['view'=>$valeu->id])}}" class="text-dark my-1" >Réservation <i class="fa fa-angle-right pull-right"></i> </a>
                            </div>
                        </div>
                            <?php
                            $j++;
                            ?>
                    @endif
                @endif


        @endforeach
    </div>

    @if(count(\App\Helpers\UrlApi::getArticleById('AUT')) > 5 )
        <div class="row mt-5 center">
            <a href="{{route('automobile')}}" class="btn btn-lg btn-primary">VOIR PLUS</a>
        </div>
    @endif

</section>
<section class="mt-5">
    <h3 class="title">Logements</h3>
    <p class="text-justify content-text">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
    <div class="row p-row">
        <?php
        $k=0;
        ?>
    @foreach($json as $valeu)

            @if($valeu->cat_id == 'IMO')
                @if( $k < 4 )
                    <div class="col item-list mb-5">
                        <div class="item-desc-top">
                            <h5>
                                @foreach(\App\Helpers\UrlApi::findTypeLocation($valeu->type_logement) as $dt)
                                        {{$dt->libelle}}
                                @endforeach
                            </h5>
                            <p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" class="text-muted m-0"> {{$valeu->name}}  </p>
                            <p class="text-danger m-0 price">CFA {{$valeu->prix}}</p>
                        </div>
                        <div class="item-image py-3">

                       @foreach(\App\Helpers\UrlApi::findData($valeu->id) as $i)

                               @if($i->principal == 'true')
                                    <img  src="{{ $i->chemin  }}" alt="" class="img img-responsive">
                                @endif

                       @endforeach

                        </div>
                        <div class="item-desc-bottom">
                            <a href="{{route('detail',['view'=>$valeu->id])}}" class="text-dark my-1" >Détails <i class="fa fa-angle-right pull-right"></i> </a>
                            <a href="{{route('detail',['view'=>$valeu->id])}}" class="text-dark my-1" >Réservation <i class="fa fa-angle-right pull-right"></i> </a>
                        </div>
                    </div>
                            <?php
                            $k++;
                            ?>
                @endif

            @endif

    @endforeach
    </div>

    @if( count(\App\Helpers\UrlApi::getArticleById('IMO')) > 5 )
        <div class="row mt-5 center">
            <a href="{{route('logements')}}" class="btn btn-lg btn-primary">VOIR PLUS</a>
        </div>
    @endif

</section>
<section class="mt-5 grey">
    <h3 class="title">Témoignages</h3>
    <div class="row mt-5">
        <div class="col-lg-5 col-md-6">
            <div class="row">
                <div class="col-md-2">
                    <h1 class="quote-sign">‘‘</h1>
                </div>
                <div class="col-md-10 pl-0">
                    <p class="text-justify content-text font-italic">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="h5">Mariam Togbe</span>
                        </div>
                        <div class="col-md-6 stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-1 space-t">

        </div>
        <div class="col-lg-5 col-md-5">
            <div class="row">
                <div class="col-md-2">
                    <h1 class="quote-sign">‘‘</h1>
                </div>
                <div class="col-md-10 pl-0">
                    <p class="text-justify content-text font-italic">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="h5">Florent Atcho</span>
                        </div>
                        <div class="col-md-6 stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>

<script type="text/javascript" src="public/myassets/js/jquery-2.1.3.min.js"></script>

<style type="text/css">
@media (max-width: 425px){
     .cl{
        flex-basis : auto;
    }
}

</style>

    <script type="text/javascript">
            if($(window).width()<= 425)
          {
            $('.cl').css('flex-basis','auto');
         }    

    </script>

<script type="text/javascript">

    var cont = $('#model');
    function changes(id)
    {

        html='';
        $.ajax({
            url:'{{\App\Helpers\UrlApi::url_api_rest().'/all_modele/'}}'+id,
            success:function (data) {
                // data=JSON.parse(data);
                for(var i=0;i<data.length; i++)
                {
                    html += "<option value="+data[i].idmodele+">"+data[i].libelle+"-"+data[i].annee+"</option>";
                }

                cont.html(html);
            }
        });
        return cont;

    }

    $("#marq").change(function () {
        changes($("#marq").val());
    });

</script>

           

        
@endsection


