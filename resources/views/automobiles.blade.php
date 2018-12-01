@extends('layouts.master')
@section('content')
    <div class="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="public/images/senna.png" class="slider-image" >
                    <div class="slider-content2 slider-content">
                        <h2>Trouves rapidement ton vehicule</h2>
                        <h4 style="text-transform: inherit">Trouve le prix, la marque</h4>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="slider-div slider-div2">
            <h4>Trouvez une automobile <span class="text-primary">Rapidement</span></h4>
            <form class="filter-form text-center w-100" action="{{route('search_auto')}}" method="post">
                {{csrf_field()}}
                <div class="mt-3">
                    <div class="form-group mb-3">
                        <select id="marq" name="marq"  class="form-control">
                            <option value="">Marques</option>
                            @foreach(\App\Helpers\UrlApi::getAllMarques() as $m)
                                <option value="{{$m->idmarque}}">{{$m->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select id="model" name="model"  class="form-control">
                            <option value="">Modèle</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <input name="prix" id="prix" style="" type="number" class="form-control" placeholder="Prix min" />

                        {{--<select class="form-control">--}}
                            {{--<option>Prix Max</option>--}}
                        {{--</select>--}}
                    </div>
                    <div class="form-group mb-3">
                        <input name="prixmax" id="prixmax" style="" type="number" class="form-control" placeholder="Prix max" />
                    </div>

                    <button id="rech_auto"  type="submit" class="btn btn-primary btn-block mb-2">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
    <div class="space">
    </div>

    <section class="grey">
    <h3 class="title mb-5">Automobiles</h3>

    <div id="auto_m" class="row">

    </div>

        <div style="display: table; margin: 30px auto 0;" class="text-center">
            <div id="pagination2">

            </div>
        </div>

    </section>

    <script type="text/javascript" src="public/myassets/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="public/myassets/js/paginater.js"></script>

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

    <script type="text/javascript">
        var automobile=$('#auto_m');

        function fetchVitesseAuto(id) {
            result='';
            $.ajax({
                url:'<?php echo \App\Helpers\UrlApi::url_api_rest().'/findvoiture/'; ?>'+id,
                success : function (donnees) {
                    $.each(donnees, function (index, item) {
                        result = item.vitesse;
                        console.log(result);
                        $("#type_auto"+id).html(result);
                    });
                }
            });
        }
fetchVitesseAuto(18);


        function articlesAuto(data)
        {
            var html = '';
            var k=0;
            $.each(data, function(index, item)
            {
                if(item.cat_id === 'AUT')
                {
                    fetchVitesseAuto(item.id);
                    fetchImg(item.id);
                    if(k<4){
                        html += '<div style="width: auto;" class="mocol col item-list"><div class="item-desc-top"><h5> '+item.name+' </h5><p id="type_auto'+item.id+'"  style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" class="text-muted m-0"> </p><p class="text-danger m-0 price">CFA '+item.prix+'</p> </div><div id="imo'+item.id+'" style="display: block" class="item-image py-3"> </div><div class="item-desc-bottom"><a href="<?php echo \App\Helpers\UrlApi::url_img() ?>details?view='+item.id+'" class="text-dark my-1" >Détails <i class="fa fa-angle-right pull-right"></i> </a> <a href="<?php echo  \App\Helpers\UrlApi::url_img() ?>details?view='+item.id+'" class="text-dark my-1" >Réservation <i class="fa fa-angle-right pull-right"></i> </a></div></div></div>';
                    }else{
                        html += '<div style="width: auto; margin-top:50px" class="mocol col  item-list"><div class="item-desc-top"><h5> '+item.name+' </h5><p id="type_auto'+item.id+'"  style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" class="text-muted m-0"> </p><p class="text-danger m-0 price">CFA '+item.prix+'</p> </div><div id="imo'+item.id+'" style="display: block" class="item-image py-3"> </div><div class="item-desc-bottom"><a href="<?php echo \App\Helpers\UrlApi::url_img()  ?> details?view='+item.id+'" class="text-dark my-1" >Détails <i class="fa fa-angle-right pull-right"></i> </a> <a href="<?php echo  \App\Helpers\UrlApi::url_img() ?>details?view='+item.id+'" class="text-dark my-1" >Réservation <i class="fa fa-angle-right pull-right"></i> </a></div></div></div>';
                    }
                    k++;
                }

            });
            return html;
        }

        //Igniting Pagination Function
        function loadproductsAuto(nombre)
        {
            $("#pagination2").pagination({
                dataSource: function(done) {
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo \App\Helpers\UrlApi::url_api_rest().'/all_liste'; ?>',
                        success: function(response) {
                            done(response);
                        }
                    });
                },
                // locator: 'items',
                totalNumberLocator: function(response) {
                    // you can return totalNumber by analyzing response content
                    return response.length;
                },
                className: 'paginationjs-theme-blue',
                pageSize: nombre,
                callback: function(data, pagination) {
                    // template method of yourself
                    console.log(data.length);
                    if (data.length >= 0)
                    {
                        var html = articlesAuto(data);
                        automobile.html(html);
                    }
                    else
                    {
                        automobile.html('<div class="article-container"><h2 class="text-center" style="margin-bottom:10px;color:#008acc">Aucune donnée trouvé.</h2></div>');
                    }

                },
                beforeInit: function() {
                    automobile.html('<div id="loading"> </div>');
                }
            });
        }

        loadproductsAuto(12);

    </script>
@endsection

