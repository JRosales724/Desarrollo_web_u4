$(document).ready(function(){
    $(window).scroll(function(){
        // Script de barra de navegacion
        if(this.scrollY > 20){
            $('.navbar').addClass("sticky");
        }else{
            $('.navbar').removeClass("sticky");
        }
        
        // Script boton de desplazamiento hacia arriba mostrar/ocultar 
        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
        }else{
            $('.scroll-up-btn').removeClass("show");
        }
    });

    // Script para deslizar hacia arriba
    $('.scroll-up-btn').click(function(){
        $('html').animate({scrollTop: 0});
    
        $('html').css("scrollBehavior", "auto");
    });

    $('.navbar .menu li a').click(function(){
        $('html').css("scrollBehavior", "smooth");
    });

    // Script para alternar entre menu y navbar 
    $('.menu-btn').click(function(){
        $('.navbar .menu').toggleClass("active");
        $('.menu-btn i').toggleClass("active");
    });

    // Script de animacion de escritura 
    var typed = new Typed(".typing", {
        strings: ["Refrescos", "Botanas", "Jugos"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });

    var typed = new Typed(".typing-2", {
        strings: ["Los mejores","Fabricadores","Innovadores"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });

    // Script carrusel
    $('.carousel').owlCarousel({
        margin: 20,
        loop: true,
        autoplay: true,
        autoplayTimeOut: 2000,
        autoplayHoverPause: true,
        responsive: {
            0:{
                items: 1,
                nav: false
            },
            600:{
                items: 2,
                nav: false
            },
            1000:{
                items: 3,
                nav: false
            }
        }
    });
});