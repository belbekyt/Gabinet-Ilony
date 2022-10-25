/**
* Ten plik pozwala kontrolować banner na stronie głównej.
*
* Banner ten jest z biblioteki OwlCarousel 
* 
* @param {boolean} loop - automatyczne zapętlenie bannera 
* @param {boolean} autoplay - automatyczne wystartowanie bannera po załadowaniu strony
* @param {boolean} dots - pokazanie/ukrycie kropek pod bannerem pokazujących na którym slajdzie się znajdujemy
* @param {boolean} mouseDrag - możliwość przesuwania slajdów myszką lub dotykiem
* @param {object} responsive - możliwośc dostosowania bannera do rozmiarów strony 
* 
* @author Miłosz Pawłowski 
*/

$('.owl-carousel').owlCarousel({
    loop:true,
    autoplay:true,
    dots:false,
    mouseDrag:false,
    responsive:{
        0:{
            items:1
        }
    }
});

/**
 * @copyright Copyright © Gabinet u Ilony. Wszelkie prawa zastrzeżone.
 */