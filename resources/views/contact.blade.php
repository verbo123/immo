@extends('layouts.master')
@section('content')
<section class="main grey">
    <h3 class="title">Contactez-Nous</h3>
    <p class="" style="font-family: 'Montserrat';font-size: 15px;font-weight: 300;">
        <i class="fa fa-envelope-o text-primary"></i> contact@beninimmo.com 
        <i class="fa fa-mobile text-primary"></i> 96 00 00 00
        <!-- <i class="fa fa-map-marker text-primary"></i> Akpakpa, Vons après rue du savoir -->
    </p>
    <div class="contact1">
        <div class="container-contact1" style="">
            <div class="contact1-pic js-tilt" data-tilt>
                <img src="public/images/img-01.png" alt="IMG">
            </div>

            <form class="contact1-form validate-form">
                
                <div class="wrap-input1">
                    <input class="form-control input1" type="text" name="nom" placeholder="Nom">
                    <span class="shadow-input1"></span>
                </div>
                <div class="wrap-input1">
                    <input class="form-control input1" type="text" name="prenom" placeholder="Prénom(s)">
                    <span class="shadow-input1"></span>
                </div>
                <div class="wrap-input1">
                    <input class="form-control input1" type="mail" name="mail" placeholder="Adresse Mail">
                    <span class="shadow-input1"></span>
                </div>

                <div class="wrap-input1">
                    <textarea class="form-control input1" name="message" placeholder="Message"></textarea>
                    <span class="shadow-input1"></span>
                </div>

                <div class="container-contact1-form-btn">
                    <button class="contact1-form-btn btn btn-primary">
                        <span>
                            Envoyer
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection