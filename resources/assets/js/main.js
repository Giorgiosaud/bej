jQuery.fn.toggleFlexbox = function() {
    var elm = $(this[0]);
    if(elm.css('display') === "none"){
        elm.css('display', '-webkit-flex');
        $('.Menu').css({'height':'100%'});
        $('.Menu__container').css({'flex-direction':'column'});
        $('.Menu__logo').css({'justify-content':'center','align-items':'center'});
        return;
    }else{
        elm.slideUp('fast');
        $('.Menu').css({'height':'auto'});
        $('.Menu__container').css({'flex-direction':'row'});
        $('.Menu__logo').css({'justify-content':'center','align-items':'flex-start'});
        return;
    }
};
jQuery.fn.toggleLeft = function() {
    var elm = $(this[0]);
    console.log(elm);
    if(elm.css('left') != "0px"){
        elm.animate({left:0},1500);
        return;
    }else{
        elm.animate({left:'100%'},1500);
        return;
    }
};
jQuery.fn.hideToRight = function() {
    var elm = $(this[0]);
        elm.animate({left:'100%'},1500);
        return;
};
jQuery.fn.flexboxDown = function() {
    var elm = $(this[0]);
        elm.css('display', '-webkit-flex');
        return;
};
jQuery.fn.flexboxUp = function() {
    var elm = $(this[0]);
    elm.slideUp('fast');
    $('.Menu').css({'height':'auto'});
    $('.Menu__container').css({'flex-direction':'row'});
    $('.Menu__logo').css({'justify-content':'center','align-items':'flex-start'});
    return;
};
jQuery(window).resize(function(){
    $windowWidth = $(window).width();
    if($windowWidth<760) {
        $('.Menu__elements').flexboxUp();
    }
    else {
        $('.Menu__elements').flexboxDown();
    }
    });
jQuery(document).ready(function($) {
    $('#formulairoDeContacto').submit(function(e){
        e.preventDefault();
        var esto = $(this);
        $.post( myAjax.ajaxurl,
            esto.serialize()+'&action=enviar_correo',
            function(data){
                $('.Contactos').toggleLeft();
                //window.mail=data;
                //alert(data.mail);
                $('.alertBox').fadeIn().delay('2000').fadeOut();
                esto[0].reset();
            },"json");
    });
    $windowWidth = $(window).width();
    $('#Menu__collapse').click(function(event) {
        $('.menu-item').slideToggle('slow');
        $('.menu-item').css({'display':'flex'})
    });
    $('.Menu__toogler').click(function(){
        $('.Menu__elements').toggleFlexbox();
    });

//    Effects
    $('.Menu__element a').click(function(){

        //alert($.attr(this, 'href'));
        if($.attr(this, 'href')=='#Contactanos'){
            $('.Contactos').toggleLeft();
            if($windowWidth<760){
                $('.Menu__elements').flexboxUp();
            }
            return true;
        }
        else{
            $('.Contactos').hideToRight();
        }
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top-100
        }, 1500);
        if($windowWidth<760){
            $('.Menu__elements').flexboxUp();
        }
        return false;
    });
    // init controller

});
$(window).on("load", function() {
    // Position initial imagenmovil
    var imagenInicial=$('#PrimerPaso').eq(0),
        imagenMovilWidth=$('.imagenmovil').width(),
        centroLeft=$(window).width()/2,
        imagenInicialTopPosition=imagenInicial.offset().top+imagenMovilWidth,
        imagenInicialLeftPosition=centroLeft-(imagenMovilWidth/2);


    $('.imagenmovil').css({'left':imagenInicialLeftPosition,'top':imagenInicialTopPosition});
    var controller = new ScrollMagic.Controller({
        globalSceneOptions: {
            triggerHook: (0.5)
        }
    });
    var lastAnimationImage= $('.Flex .Flex__imageContainer').eq(2);
    var lastAnimationImageBottomPosition=lastAnimationImage.offset().top+lastAnimationImage.height()-50;
    var animationHeight=lastAnimationImageBottomPosition-imagenInicialTopPosition;
    console.log(animationHeight);
    var firstAnimation = new TimelineMax(),

        elementTextRight=$('.Flex--no-margin-top').eq(0),
        cochinoContenedor=$('.Flex__imageContainer').eq(0),
        heightCochino=$('.Flex .Flex__imageContainer img').eq(0).height(),
        startHeight=($windowWidth<760)?heightCochino-40:1;

    firstAnimation.insert(TweenMax.fromTo(cochinoContenedor,3,{height:startHeight,opacity:0},{height:heightCochino,opacity:1}))
        .insert(TweenMax.from(elementTextRight,3,{'margin-top':0}));
    var scene1= new ScrollMagic.Scene({triggerElement: "#PrimerPaso", duration: heightCochino})
        .setTween(firstAnimation)
        //.addIndicators()
        .addTo(controller);

    var secondAnimation= new TimelineMax(),
        
    objetive=$('.Flex__imageContainer img').eq(1);
    secondAnimation.insert(TweenMax.from(objetive,1,{opacity:0}));
    var scene2= new ScrollMagic.Scene({triggerElement: "#PrimerPaso", duration: heightCochino})
        .setTween(secondAnimation)
        //.addIndicators({indent:2})
        .addTo(controller);
    //
    //
    var thirdAnimation= new TimelineMax(),
        duration=$('#Nosotros2').height()-300,
        objetivo=$('.Flex__imageContainer--vertical'),
        maxWidth=$('.Flex__imageContainer--vertical img').width();
    console.log(maxWidth);
    thirdAnimation.insert(TweenMax.fromTo(objetivo,1,{width:1},{width:maxWidth}));
    //thirdAnimation.insert(TweenMax.from('.imagenmovil',1,{opacity:0}));
    var scene3= new ScrollMagic.Scene({triggerElement: "#Nosotros2", duration: duration})
        .setTween(thirdAnimation)
        //.addIndicators()
        .addTo(controller);
    //
    ////
    var permanentAnimation= new TimelineMax()
        //imagenFinalLeftPosition=imagenInicialLeftPosition*2/2.5;
    permanentAnimation.insert(TweenMax.to('.imagenmovil',1,{rotation: 540}));
    var permanentScene= new ScrollMagic.Scene({triggerElement: "#PrimerPaso", duration: animationHeight})
        .setPin('.imagenmovil')
        .setTween(permanentAnimation)

        //.addIndicators({name: "Permanent",indent:1})
        .addTo(controller);

});

var initMap=function() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 6
    });
    var geocoder = new google.maps.Geocoder(),
        address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        }
        else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
