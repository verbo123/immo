@extends('layouts.master')
@section('content')
    <div class="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="public/images/bat.jpg" class="slider-image" >
                    <div class="slider-content">
                        <h2>Trouves rapidement ton logement</h2>
                        <h4 style="text-transform: inherit">Trouve un logement partout au Bénin</h4>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="slider-div">
            <h4>Trouvez un logement <span class="text-primary">Rapidement</span></h4>
            <form class="filter-form text-center" action="{{route('search')}}" method="post">
                {{csrf_field()}}
                <div class="form-inline mt-3 center">
                    <div class="form-group mx-sm-3 m-2">
                        <select  style="width: 150px"  class="form-control">
                            <option value="cotonou">Cotonou</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 m-2">
                        <input id="quat" name="quatier" type="text" class="form-control" placeholder="Quartier" />
                        {{--<select  style="width: 200px" class="form-control">--}}
                            {{--<option>Quartier</option>--}}
                        {{--</select>--}}
                    </div>
                    <div class="form-group mx-sm-3 m-2">
                        <input id="mo" name="mot" type="text" class="form-control" placeholder="mot-clé..." />
                    </div>
                    <button id="lanc" type="submit" class="btn btn-primary m-2">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
    <div class="space">
    </div>
    <section class="grey">
        <h3 class="title mb-5">logements</h3>
        <div id="ctlog" class="row">

        </div>

        <div style="display: table; margin: 30px auto 0;" class="text-center">
            <div id="pagination">

            </div>
        </div>
    </section>

    <script type="text/javascript" src="public/myassets/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="public/myassets/js/paginater.js"></script>
    <script type="text/javascript">
        var dataContainer=$('#ctlog');


        function findDataTemplate(data,pos) {
            result='';
            $.each(data, function (index, item) {
                result += item.libelle;
                $("#type"+pos).html(result);
            });
        }
        function fetchLibelle(id,pos) {
            $.ajax({
                url:'<?php echo \App\Helpers\UrlApi::url_api_rest().'/typelogement/'; ?>'+id,
                success : function (donnees) {
                    findDataTemplate(donnees,pos);
                }
            });
        }


        function articlesLogement(data)
        {
            var html = '';
            var k=0;
            $.each(data, function(index, item)
            {
                if(item.cat_id == 'IMO'){

                    fetchLibelle(item.type_logement,item.id);
                    fetchImg(item.id);

                    html += '<div class="mocol col-lg-3 col-md-4 item-list mb-5"><div class="item-desc-top"><h5 id="type'+item.id+'"></h5><p  style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" class="text-muted m-0">'+item.name+'</p><p class="text-danger m-0 price">CFA '+item.prix+'</p> </div><div id="imo'+item.id+'" class="item-image py-3"> </div><div class="item-desc-bottom"><a href="<?php echo  \App\Helpers\UrlApi::url_img() ?>details?view='+item.id+'" class="text-dark my-1" >Détails <i class="fa fa-angle-right pull-right"></i> </a> <a href="<?php echo  \App\Helpers\UrlApi::url_img() ?>details?view='+item.id+'" class="text-dark my-1" >Réservation <i class="fa fa-angle-right pull-right"></i> </a></div></div></div>';
                    

                }

            });
            return html;
        }

        //Igniting Pagination Function
        function loadproducts(nombre)
        {
            $("#pagination").pagination({
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
                        var html = articlesLogement(data);
                        dataContainer.html(html);
                    }
                    else
                    {
                        dataContainer.html('<div class="article-container"><h2 class="text-center" style="margin-bottom:10px;color:#008acc">Aucune donnée trouvé.</h2></div>');
                    }

                },
                beforeInit: function() {
                    dataContainer.html('<div id="loading"> </div>');
                }
            });
        }

        loadproducts(12);

    </script>
@endsection
