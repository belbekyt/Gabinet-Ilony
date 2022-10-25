/**
* Ten plik kontoluje działanie panelu logowania i rejestracji z pliku login.php.
*
* Funkcje pozwalają na zmianę styli elementów po kliknięciu
* dzięki czemu powstaje ładna animacja.  
*
* @author Miłosz Pawłowski
*/

const switchBtn = document.querySelector("#login-switch-btn");
const switchH2 = document.querySelector("#switch-h2");
const switchText = document.querySelector("#switch-text");
let login = $(".login-table");
let register = $(".register-table");
let switched = false;
let mobile;
const specialBtn = $(".special-button");

/**
 * Początkowo ukrywamy blok rejestracji tak, aby nie był on widoczny dla użytkownika
 */
register.animate({
    height:'0%',
    opacity:'0',
    width:'0%'
},0);

register.css("display", "none");

const media = window.matchMedia("(max-width: 685px)");
const holder = $(".main-login-section");
const changeBlock = $(".welcome-switch");
const loginBlock = $(".login-table");
const registerBlock = $(".register-table");

/**
 * Funkcja switchStart pokazuje rejestrację oraz ukrywa logowanie po kliknięciu w guzik na stronie.
 * 
 * @param {*} height -
 * @param {*} width - wszystkie trzy wartości służą do kontrolowania wielkości elementów loginu i rejestracji tak, 
 * @param {*} width2 - aby wyświetlały się dobrze również na urządzeniach mobilnych, a przy tym nie wydłużać zbędnie kodu.
 */

let switchStart = function(height, width, width2){
    console.log(switched);
    switchBtn.innerHTML="ZAREJESTRUJ SIĘ";
    switchH2.innerHTML="Pierwszy raz?";
    switchText.innerHTML="Pozostań z nami w kontakcie, <br/>załóż swoje konto już teraz!";
    login.css("display", "flex");
    login.animate({
        height: height,
        opacity:'1',
        width: width
    },1000);
    register.animate({
        height:'0%',
        opacity:'0',
        width: width2
    },1000,()=>{register.css("display", "none");});
}

/**
 * Funkcja switchEnd pokazuje logowanie oraz ukrywa rejestrację po kliknięciu w guzik na stronie.
 * 
 * @param {*} height -
 * @param {*} width - wszystkie trzy wartości służą do kontrolowania wielkości elementów loginu i rejestracji tak, 
 * @param {*} width2 - aby wyświetlały się dobrze również na urządzeniach mobilnych, a przy tym nie wydłużać zbędnie kodu.
 */

let switchEnd = function(height, width, width2){
    console.log(switched);
    switchBtn.innerHTML="ZALOGUJ SIĘ";
    switchH2.innerHTML="Witamy ponownie!";
    switchText.innerHTML="Pozostań z nami w kontakcie, <br/>zaloguj się już teraz!";
    login.animate({
        height:'0%',
        opacity:'0',
        width: width2
    },1000,()=>{login.css("display", "none");});
    register.css("display", "flex");
    register.animate({
        height: height,
        opacity:'1',
        width: width
    },1000);
}

/**
 * Funkcja testMedia pozwala ułatić responsywność.
 * 
 * Funkcja sprawdza czy okno przeglądarki osiągneło szerokość 685px i zmienia widok strony logowania
 * i rejestracji zależnie od tego czy okno jest mniejsze lub większe od tej wartości.
 * 
 * @param {*} media - podajemy w niej szerokość od której ma się zmieniać, w tym przypadku 685px.
 */

let testMedia = function(media){
    if (media.matches) {
        holder.css("flexDirection","column");
        changeBlock.css("width","100%");
        loginBlock.css("width","100%");
        registerBlock.css("width","0%");
        switchStart("100%", "100%", "100%");
        mobile = true;
        specialBtn.css("marginBottom","-150px");
    } else {
        holder.css("flexDirection","row");
        changeBlock.css("width","40%");
        loginBlock.css("width","60%");
        registerBlock.css("width","0%");
        switchStart("100%", "60%", "0%");
        mobile = false;
        specialBtn.css("marginBottom","0px");
    }
}

testMedia(media);

/**
 * Event listener nasłuchujący zmianę szerokości okna i uruchamiający funkcję, która sprawdza jego szerokość.
 */

media.addEventListener("change", testMedia);

/**
 * Funkcja change wywołuje po kliknięciu w guzik odpowiednią funkcję odpowiadającą za pokazanie
 * bądź chowanie elementów na stronie.
 */

let change = function(){
    if(mobile){
        if(switched){
            switchStart("100%","100%", "100%");
            switched = false;
        }   
        else{
            switchEnd("100%", "100%", "100%");
            switched = true;
        }   
    }
    else{
        if(switched){
            switchStart("100%", "60%", "0%");
            switched = false;
        }
        else{
            switchEnd("100%", "60%", "0%");
            switched = true;
        }
    }
}

/**
 * Event listener nasłuchujący kliknięcia w przycisk na stronie.
 */

switchBtn.addEventListener("click", change);

/**
 * @copyright Copyright © Gabinet u Ilony. Wszelkie prawa zastrzeżone.
 */