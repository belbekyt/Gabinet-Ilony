
<!DOCTYPE html>
<html lang="pl-Pl">
<head>
    <?php echo file_get_contents("../components/head.html");?>
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/workers.css">
    <link rel="stylesheet" href="../style/main-media.css">
    <link rel="stylesheet" href="../style/workers-media.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/logo.png" alt="Logo gabinetu stomatologicznego">
        </div>
        <nav id="menu-btn">
            <div class="first-menu-block"></div>
            <div class="second-menu-block"></div>
            <div class="third-menu-block"></div>
        </nav>
    </header>
    <section>
        <div class="heading"><h2>NASI SPECJALIŚCI</h2></div>
        <div class="workers-holder">
            <div class="worker">
                <div class="worker1"></div>
                <h2>Aneta Górska</h2>
                <h3>Stomatolog estetyczny</h3>
                <p>Aneta to wyspecjalizowana osoba w kwestii wybielania zębów. W 2019 została odznaczona orderem złotego stomatologa.</p>
            </div>
            <div class="worker">
                <div class="worker2"></div>
                <h2>Maja Kowalska</h2>
                <h3>Lekarz stomatolog, periodontolog</h3>
                <p>Specjalizuje się w stomatologii zachowawczej z endodoncją. Na co dzień pomaga pacjentom w problemach związanych z chorobami przyzębia (periodontologia).</p>
            </div>
            <div class="worker">
                <div class="worker3"></div>
                <h2>Robert Sadurski</h2>
                <h3>Lekarz stomatolog</h3>
                <p>Robert specjalizuje się w usuwaniu zębów, trudnym leczeniu zębów oraz we wstawianiu wysokiej jakości implantów.</p>
            </div>
            <div class="worker">
                <div class="worker4"></div>
                <h2>Czesław Kowalczyk</h2>
                <h3>Lekarz stomatolog, ortodonta</h3>
                <p>Czesław jest specjalistą w leczeniu wad zgryzu. Posiada ponad 20 lat praktyki zawodowej.</p>
            </div>
            <div class="worker">
                <div class="worker5"></div>
                <h2>Marek Szulc</h2>
                <h3>Chirurg stomatologiczny</h3>
                <p>Zakres jego specjalizacji obejmuje porócz podstawowych usług stomatologicznych, zabiegi chirurgiczne zajmujące się leczeniem operacyjnym jamy ustnej i okolic przyległych. W zawodzie lekarza dentysty pracuje od 2003r.</p>
            </div>
            <div class="worker">
                <div class="worker6"></div>
                <h2>Norbert Kwiatkowski</h2>
                <h3>Protetyk stomatologiczny</h3>
                <p>Specjalizuje się w przeprowadzaniu zabiegów chirurgiczno – implantologicznych. Praktyk od ponad 10 lat.</p>
            </div>
            <div class="worker">
                <div class="worker7"></div>
                <h2>Kamil Sobczak</h2>
                <h3>Asystent stomatologiczny</h3>
                <p>Kamil to nasz praktykant, który niedawno zaczął ale dobrze spisuje się w swoich pracach.</p>
            </div>
            <div class="worker">
                <div class="worker8"></div>
                <h2>Alina Jasińska</h2>
                <h3>Lekarz dentysta, specjalizacja I˚ stomatologii ogólnej</h3>
                <p>Alina to lekarz specjalizujący się w implantologii, protetyce i chirurgii stomatologicznej. Posiada wieloletnie doświadczenie w odbudowie pełnych łuków zębowych z zastosowaniem natychmiastowych mostów na implantach w różnych technikach.</p>
            </div>
            <div class="worker">
                <div class="worker9"></div>
                <h2>Joanna Jakubowska</h2>
                <h3>Stomatolog dziecięcy</h3>
                <p>Specjalizuje się w leczeniu zachowawczym dorosłych i dzieci. Prowadzi leczenie specjalistyczne endodontyczne.</p>
            </div>
            <div class="worker">
                <div class="worker10"></div>
                <h2>Olimpia Kaczmarczyk</h2>
                <h3>Specjalista Periodontologii i Implantologii</h3>
                <p>Specjalizuje się w chirurgii stomatologicznej, implantologii, periodontologii oraz protetyce.</p>
            </div>
            <div class="worker">
                <div class="worker11"></div>
                <h2>Bianka Kowalska</h2>
                <h3>Higienistka stomatologiczna</h3>
                <p>Bianka to specjalistka w komunikacji z pacjentami, a zwłaszcza z dziećmi. Jest ekspertką w dziedzinie środków służących pielęgnacji jamy ustnej.</p>
            </div>
            <div class="worker">
                <div class="worker12"></div>
                <h2>Krystyna Makowska</h2>
                <h3>Asystentka stomatologiczna</h3>
                <p>Krystyna jest asystentką stomatologiczną od trzech lat. Jest niezastąpiona w uspokajaniu pacjentów.</p>
            </div>
        </div>
    </section>
    <section class="pre-footer">
        <div class="heading"><h2>KONTAKT</h2></div>
        <div class="footer-box">
            <div>
                <div class="contact-item">
                    <img src="../img/telefon.png" alt="Ikona telefonu">
                    <p>ul. Szeroka 35/2, Toruń</p>
                </div>
                <div class="contact-item">
                    <img src="../img/telefon.png" alt="Ikona telefonu">
                    <p>+48 729 271 111</p>
                </div>
            </div>    
            <div>
                <div class="contact-item">
                    <img src="../img/zegar.png" alt="Ikona telefonu">
                    <p>Pn. - Pt. 8:00 - 16:00</p>
                </div>
                <div class="contact-item">
                    <img src="../img/email.png" alt="Ikona telefonu">
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
            <a href="../index.php"><li class="menu-li1">Strona główna</li></a>
            <a href="./workers.php"><li class="menu-li2">Nasi pracownicy</li></a>
            <a href="./offers.php"><li class="menu-li3">Nasze oferty</li></a>
            <a href="./visits.php"><li class="menu-li4">Umów się na wizytę</li></a>
            <a href="./login.php"><li class="menu-li5">Zaloguj / Zarejerstuj się</li></a>
        </ul>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/main.js"></script>

