
<script type="text/javascript" src="public/myassets/js/jquery-2.1.3.min.js"></script>

<script type="text/javascript" src="public/myassets/js/jquery.min.js"></script>
<script type="text/javascript" src="public/myassets/js/bootstrap.js"></script>
<script type="text/javascript" src="public/myassets/js/swiper.min.js"></script>
<script type="text/javascript" src="public/myassets/js/jquery-ui.min.js"></script>

<script type="text/javascript">
    var swiper = new Swiper('.swiper-container', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        loop:true,
        effect:"coverflow",
        speed: 1500,
        autoplay: {
            delay: 5000,
            disableOnInteraction: true,
        },
    });

    function openmobile()
    {
    	var x = document.getElementById("menu-links");
    	if (x.style.display === "block")
    	{
    		x.style.display = "none";
    	}
    	else
    	{
    		x.style.display = "block";
    	}
    }
    $(document).ready(function() {

        /* Every time the window is scrolled ... */
        $(window).scroll( function(){

            /* Check the location of each desired element */
            $('.item-list').each( function(i){

                var bottom_of_object = $(this).position().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();

                /* If the object is completely visible in the window, fade it it */
                if( bottom_of_window > bottom_of_object ){

                    $(this).animate({'opacity':'1'},1500);
                    
                }

            }); 

        });

    });
</script>

<script type="text/javascript" src="public/myassets/js/paginater.js"></script>
<script type="text/javascript">

    function fetchImg(id) {
        img='';
        $.ajax({
            url:'<?php echo \App\Helpers\UrlApi::url_api_rest().'/images/'; ?>'+id,
            success : function (donnees) {
                $.each(donnees, function (index, item) {
                    if(item.principal === 'true'){
                        img ='<img  src="'+item.chemin+'" alt="" class="img img-responsive">';
                        $("#imo"+id).html(img);
                    }
                });

            }
        });
    }



    $("#c_logement").change(function() {
        if( $("#c_logement").is(':checked') === true )
        {
            $('#rech1').css('display','flex');
            if(window.screen <=425){
                $('#rech2').css('display','none');
             }else{
                $('#rech2').css('display','none');
            }

        }

    });

    $("#c_automobile").change(function() {
        if( $("#c_automobile").is(':checked') === true )
        {
            $('#rech1').css('display','none');
            if(window.screen <=425){
                $('#rech2').css('display','block');
            }else{
                $('#rech2').css('display','table-caption');
            }

        }

    });

    $('#inde').click(function () {
        window.location.href='/immo';
    });

    $('#lanc').click(function () {
        if($('#vil').val() != '' && ($('#quat').val() != '' || $('#mo').val() != '' )){
            document.getElementById('lanc').submit();
        }else {
            return false;
        }
    });

    $('#rech_auto').click(function () {
        if($('#model').val() != '' || $('#marq').val() != '' || $('#desc').val() != '' || $('#prix').val() != ''){
            document.getElementById('rech_auto').submit();
        }else {
            return false;
        }
    });

</script>


</body>
</html>