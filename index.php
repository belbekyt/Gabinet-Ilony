<?php require "phpScripts/requirements.php";?>
<!DOCTYPE html>
<html lang="pl-Pl">
<head>
    <?php echo file_get_contents("components/head.html");?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />

    <link rel="shortcut icon" href="img/logo.png">

    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/main-media.css">
    <link rel="stylesheet" href="style/index-media.css">
</head>
<body>
<?php
    $user = null;
    if(isset($_SESSION["USER"])) $user = User::getUser();
    if($user != null){
        echo '<section id="userPanel">Witaj '.$user -> getName().'!</section>';
    }
?>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Logo gabinetu stomatologicznego">
        </div>
        <nav id="menu-btn">
            <div class="first-menu-block"></div>
            <div class="second-menu-block"></div>
            <div class="third-menu-block"></div>
        </nav>
    </header>
    <section class="banner">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="img/banner/baner1.png" alt="zdjęcie sanatorium">
            </div>
            <div class="item">
                <img src="img/banner/baner2.png" alt="zdjęcie sanatorium">
            </div>
            <div class="item">
                <img src="img/banner/baner3.png" alt="zdjęcie sanatorium">
            </div>
            <div class="item">
                <img src="img/banner/baner4.png" alt="zdjęcie sanatorium">
            </div>
        </div>
    </section>
    <section class="short-about">
        <h3>Satysfakcja, uśmiech oraz najwyższa jakość - na tym nam zależy!</h3>
        <p>Oferujemy profesjonalną opiekę stomatologiczną dla dorosłych, młodzieży oraz dzieci. Stosujemy diagnostykę na najwyższym 
            poziomie - szczegółową analizę potrzeb oraz leczenie pod kontrolą mikroskopu, cyfrowej radiologii i w atmosferze dużego 
            komfortu. Żyjemy w czasach ogromnego postępu technologicznego - dziś możemy leczyć Państwa zęby nie tylko bezboleśnie, ale i 
            dbając o ich wygląd oraz estetykę. Staramy się, aby każda wizyta była przyjemnością i spełniła Państwa oczekiwania. </p>
            <p>Serdecznie zapraszamy!</p>
    </section>
    <div class="heading"><h2>ARTYKUŁY</h2></div>
    <section class="articles">
        <?php
            $connection = new mysqli("localhost", "root", "", "gabinet");
            $result = $connection -> query("SELECT * FROM mainpagearticles");
            while($art = $result -> fetch_assoc()){
                echo '<article class="article">
                <div class="article-date">'.$art['dateAdded'].'</div>
                <h3 class="article-heading">'. $art['title'] . '</h3>
                <p class="article-text">'. $art['content'] . '</p>
                </article>';
            }
        ?>
    </section>
    <section class="pre-footer">
        <div class="heading"><h2>KONTAKT</h2></div>
        <div class="footer-box">
            <div>
                <div class="contact-item">
                    <img src="img/domek.png" alt="Ikona telefonu">
                    <p>ul. Szeroka 35/2, Toruń</p>
                </div>
                <div class="contact-item">
                    <img src="img/telefon.png" alt="Ikona telefonu">
                    <p>+48 729 271 111</p>
                </div>
            </div>    
            <div>
                <div class="contact-item">
                    <img src="img/zegar.png" alt="Ikona telefonu">
                    <p>Pn. - Pt. 8:00 - 16:00</p>
                </div>
                <div class="contact-item">
                    <img src="img/email.png" alt="Ikona telefonu">
                    <p>rejestracja@gmail.com</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p>&copy;Wszelkie prawa zastrzeżone - Gabinet u Ilony</p>
    </footer>
    <section class="bg-black">
        <ul>
            <a href="index.php"><li class="menu-li1">Strona główna</li></a>
            <a href="pages/workers.php"><li class="menu-li2">Nasi pracownicy</li></a>
            <a href="pages/offers.php"><li class="menu-li3">Nasze oferty</li></a>
            <a href="pages/visits.php"><li class="menu-li4">Umów się na wizytę</li></a>
            <a href="pages/login.php"><li class="menu-li5">Zaloguj / Zarejerstuj się</li></a>
        </ul>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script src="scripts/carousel.js"></script>
<script src="scripts/main.js"></script>
</html>