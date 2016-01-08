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
    $('#Menu__collapse').click(function(event) {
        $('.menu-item').slideToggle('slow');
        $('.menu-item').css({'display':'flex'})
    });
    $('#submitContactForm').submit(function(event) {
        event.preventDefault();
        var that=$(this);
        $.post(myAjax.ajaxurl,
            that.serialize(),
            function(result){
                console.log(result);
                alert('your message was sent');
            }
        );
        console.log('Enviado');
    });
    $('.Menu__toogler').click(function(){
        $('.Menu__elements').toggleFlexbox();
    });
});
