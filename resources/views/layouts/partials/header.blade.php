@include('tools.Tools')
<body>
    <div class="navbar">
        <div class="logo">

                <img id="inde" style="margin-left: 30px; cursor: pointer" src="public/images/logo.jpg" class="img img-responsive" alt="<LOGO>">

        </div>
        <div class="links" id="menu-links">
            <a href="/immo" class="<?php if($title == "Accueil"){ echo 'active'; }  ?>">Accueil</a>
            <a href="logements" class="<?php if($title == "Logements"){ echo 'active'; }  ?>">Logements</a>
            <a href="automobile" class="<?php if($title == "Automobile"){ echo 'active'; }  ?>">Automobiles</a>
            <a href="#"  >Découvrez le Bénin</a>
            <a href="contact" class="<?php if($title == "Contactez-nous"){ echo 'active'; }  ?>">Contactez-Nous</a>
            <a href="http://www.tropicombenin.com/immo/index" class="">Accédez à votre compte</a>
        </div>
        <a href="javascript:void(0);" class="mobile-a" onclick="openmobile()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="main grey">

        <style>
            .btn-primary{
                background-color: #4272bc;
            }
            a.active{
                background: #4272bc;
            }
        </style>