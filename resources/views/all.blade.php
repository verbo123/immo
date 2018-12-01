@extends('layouts.master')
@section('content')
<section class="main grey">

    <div class="row">
        <h3>Résultat de recherche </h3>
    </div>
    <div class="row">
        <p><strong><i>Mots clés : {{$q}} </i></strong></p>
    </div>
    @if(count($log) <= 0)
        <div class="row center mb-5 a-grid">
            <div class=" p-5 item-grid">
        <h5 class="text-center">Aucun résultat trouvé</h5>
            </div>
        </div>
        @else
        @foreach($log as $i)
            <div class="row center mb-5 a-grid">
                <div class="col-md-2 p-5 item-grid">
                    <div class="item-image py-3">
                        @if($i->cat_id == 'AUT')
                            @foreach(\App\Helpers\UrlApi::findData($i->id_voiture) as $a)

                                    @if($a->principal == 'true')
                                        <img src="{{ $a->chemin  }}" alt="" class="img img-responsive">
                                    @endif

                            @endforeach
                        @else
                            @foreach(\App\Helpers\UrlApi::findData($i->id) as $a)

                                    @if($a->principal == 'true')
                                        <img src="{{ $a->chemin  }}" alt="" class="img img-responsive">
                                    @endif

                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-9 mx-3 p-3 content-grid">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>{{$i->name}}</h5>
                            <p class="text-danger m-0 price">CFA {{$i->prix}}</p>
                            @if($i->disponibilite == 'true')
                                <strong class="text-success m-0 price">Disponible</strong>
                            @else
                                <strong class="text-danger m-0 price">Non Disponible</strong>
                            @endif
                            <p class="text-justify mt-4">{{$i->description}}</p>
                        </div>
                        <div class="col-md-4 misc">
                            @if($i->cat_id == 'AUT')
                                <a href="{{route('detail',['view'=>$i->id_voiture])}}" class="btn btn-primary btn-block mt-4">Voir la Disponibilité </a>
                            @else
                                <a href="{{route('detail',['view'=>$i->id])}}" class="btn btn-primary btn-block mt-4">Voir la Disponibilité </a>
                            @endif
                            <p class="text-muted text-center mt-5">Appellez nous</p>
                            <button class="mobileOnly btn btn-outline-primary btn-block">{{$i->numero}}</button>

                            <button  disabled="disabled"  class=" btn btn-outline-primary btn-block">{{$i->numero}}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{--@if(count($log) > 0)--}}
    {{--<div class="row pagination">--}}
        {{--<p class="text-center">--}}
            {{--<a href="#"><i class="fa fa-angle-left"></i> Précédent</a>--}}
            {{--<a href="#"> Suivant <i class="fa fa-angle-right"></i></a> <br/>--}}
        {{--</p>--}}
        {{--<p class="text-center">--}}
            {{--<a>{{$log->links()}}</a>--}}
        {{--</p>--}}
    {{--</div>--}}
    {{--@endif--}}





    {{--@if(app('request')->input('category') == 'immobilier')--}}
        {{--@foreach(\App\Helpers\UrlApi::getArticleById('IMO') as $i)--}}
            {{--<div class="row center mb-5 a-grid">--}}
            {{--<div class="col-md-2 p-5 item-grid">--}}
                {{--<div class="item-image py-3">--}}
                    {{--@foreach(\App\Helpers\UrlApi::findData($i->id) as $img)--}}
                        {{--@foreach($img as $a)--}}
                            {{--@if($a->principal == 'true')--}}
                                {{--<img src="{{ \App\Helpers\UrlApi::url_img().$a->chemin  }}" alt="" class="img img-responsive">--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-9 mx-3 p-3 content-grid">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-8">--}}
                        {{--<h5>{{$i->name}}</h5>--}}
                        {{--<p class="text-danger m-0 price">CFA {{$i->prix}}</p>--}}
                        {{--<p class="text-justify mt-4">{{$i->description}}</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 misc">--}}
                        {{--@if($i->disponibilite == 'true')--}}
                            {{--<button disabled="disabled"--}}
                                    {{--class="btn btn-primary btn-block mt-4">Disponible</button>--}}
                        {{--@else--}}
                            {{--<button disabled="disabled" class="btn btn-danger btn-block mt-4">Non Disponible</button>--}}
                        {{--@endif--}}
                        {{--<p class="text-muted text-center mt-5">Appellez nous</p>--}}
                        {{--<button class="mobileOnly btn btn-outline-primary btn-block">{{$i->numero}}</button>--}}

                        {{--<button  disabled="disabled"  class=" btn btn-outline-primary btn-block">{{$i->numero}}</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}
    {{--@endif--}}


        {{--@if(app('request')->input('category') == 'automobile')--}}
            {{--@foreach(\App\Helpers\UrlApi::getArticleById('AUT') as $i)--}}
                {{--<div class="row center mb-5 a-grid">--}}
                    {{--<div class="col-md-2 p-5 item-grid">--}}
                        {{--<div class="item-image py-3">--}}
                            {{--@foreach(\App\Helpers\UrlApi::findData($i->id) as $img)--}}
                                {{--@foreach($img as $a)--}}
                                    {{--@if($a->principal == 'true')--}}
                                        {{--<img src="{{ \App\Helpers\UrlApi::url_img().$a->chemin  }}" alt="" class="img img-responsive">--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-9 mx-3 p-3 content-grid">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-8">--}}
                                {{--<h5>{{$i->name}}</h5>--}}
                                {{--<p class="text-danger m-0 price">CFA {{$i->prix}}</p>--}}
                                {{--<p class="text-justify mt-4">{{$i->description}}</p>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4 misc">--}}
                                {{--@if($i->disponibilite == 'true')--}}
                                    {{--<button disabled="disabled"--}}
                                            {{--class="btn btn-primary btn-block mt-4">Disponible</button>--}}
                                {{--@else--}}
                                    {{--<button disabled="disabled" class="btn btn-danger btn-block mt-4">Non Disponible</button>--}}
                                {{--@endif--}}
                                {{--<p class="text-muted text-center mt-5">Appellez nous</p>--}}
                                    {{--<button class="mobileOnly btn btn-outline-primary btn-block">{{$i->numero}}</button>--}}

                                    {{--<button  disabled="disabled"  class=" btn btn-outline-primary btn-block">{{$i->numero}}</button>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--@endif--}}



    <style>
        .mobileOnly{
            visibility: hidden;
        }
    </style>
</section>
@endsection