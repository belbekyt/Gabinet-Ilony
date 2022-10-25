/**
* Ten plik kontoluje działanie menu obecnego na wszystkich podstronach.
*  
* @author Miłosz Pawłowski
*/

let flag = true;

/**
 * Funkcja hideMenu ukrywa blok menu tak, aby był on niewidoczny na początku.
 */

let hideMenu = function(){
    $(".bg-black").css({'display':'none'});
    $("li").animate({marginLeft:'-2500px'},0);
}

/**
 * Funkcja startMenuAnimation rozpoczyna animację wysuwania menu po kliknięciu w przycisk
 */

let startMenuAnimation = function(){
    $(".first-menu-block").addClass('rotated1');
    $(".second-menu-block").css({'display': 'none'});
    $(".bg-black").css({'display':'flex'});
    $(".third-menu-block").addClass('rotated2');
    $(".bg-black").animate({
        width: '100%',
        height: '100%',
        opacity: '1'
    },1000);
    $(".menu-li1").animate({marginLeft:'0'},1400);
    $(".menu-li2").animate({marginLeft:'0'},1600);
    $(".menu-li3").animate({marginLeft:'0'},1800);
    $(".menu-li4").animate({marginLeft:'0'},2000);
    $(".menu-li5").animate({marginLeft:'0'},2200);
}

/**
 * Funkcja endMenuAnimation rozpoczyna animację chowania menu po kliknięciu w przycisk
 */

let endMenuAnimation = function(){
    $(".menu-li5").animate({marginLeft:'2500px'},2200);
    $(".menu-li4").animate({marginLeft:'2500px'},2000);
    $(".menu-li3").animate({marginLeft:'2500px'},1800);
    $(".menu-li2").animate({marginLeft:'2500px'},1600);
    $(".menu-li1").animate({marginLeft:'2500px'},1400);
    $(".bg-black").animate({
        width: '0',
        height: '0',
        opacity: '0'
    },1500);
    $(".third-menu-block").removeClass('rotated2');
    $(".bg-black").animate({},1500);
    $(".second-menu-block").css({'display': 'block'});
    $(".first-menu-block").removeClass('rotated1');
}

/**
 * Funkcja obsługująca wywołanie odpowiedniej funkcji po kliknięciu w przycisk
 */

$("#menu-btn").click(function(){
    if(flag){
        startMenuAnimation();
        flag = false;
    }
    else{
        endMenuAnimation();
        window.setTimeout(hideMenu,1500);
        flag = true;
    }
});

/**
 * @copyright Copyright © Gabinet u Ilony. Wszelkie prawa zastrzeżone.
 */