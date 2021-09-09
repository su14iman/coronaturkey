<?php
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatisticsController;


$NewsController = new NewsController();
$StatisticsController = new StatisticsController();

$PLoadAllTypeNews = $NewsController->PLoadAllTypeNews();

$PDoviz = $NewsController->PDoviz();
$PLoadAllStatisticsGeneral = $StatisticsController->PLoadAllStatisticsGeneral();


//PLoadLastNews

?>

<!doctype html>
<html class="no-js" lang="tr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    @include('feed::links')
    @yield('meta')
    <link rel="icon" href="img/logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/foundation.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="/css/rvslider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162445372-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-162445372-1');
    </script>

</head>
<body>
<div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <!-- SideBar Desktop  -->
        <div class="off-canvas position-left reveal-for-large sliderBarBackground" id="my-info" data-off-canvas data-position="left">
            <div>
                <br>
                <div style="margin: auto;color:#fff; text-align: center;">
                    <h3><b>CoronaTürkiye</b></h3>
                </div>
                <div class="logo">
                    <a href="{{route("home")}}">
                        <img class="logo  " src="/img/logo.png">
                    </a>
                </div>
                <!-- SideBar Buttons -->
                <div class="SideBarButtons">
                    <a href="{{route("home")}}"><button class="btn">ANA SAYFA</button></a>

                    <?php
                        for ($i = 0; $i < $PLoadAllTypeNews->count(); $i++) {
                            $name = $PLoadAllTypeNews[$i]['Name'];
                            $link = str_replace(" ",'_',$name);
                            echo '<a href="/bolum/'.$link.'"><button class="btn">'.$name.'</button></a>';
                        }
                    ?>

                </div>
            </div>
        </div>
        <div class="off-canvas-content" data-off-canvas-content>
            <!-- Mobile Sidebar -->
            <div class="title-bar hide-for-large" style="">
                <div class="title-bar-left">
                    <button class="menu-icon" type="button" data-open="my-info"></button>
                    <span class="title-bar-title">CoronaTürkiye</span>
                </div>
            </div>
            <!-- TopBars -->
            <div class="TopBars">
                <!-- SonHabirlar -->
                <div class="SonHabirlarScroll">
                    <marquee scrollamount="3" direction="left" scrolldelay="85" onmouseout="this.start()" onmouseover="this.stop()">

                        <?php
                            $x = $NewsController->PLoadLastNews(5);
                        for ($i = 0; $i < $x->count(); $i++) {
                            $Description = $x[$i]['Description'];
                            $link = str_replace(" ",'_',$Description);
                            echo '
                                <strong style=" margin-right: 3%; ">
                                    <a href="/v/'.$link.'"><span>'.$Description.'</span></a>
                                </strong>
                            ';
                        }
                        ?>


                    </marquee>
                </div>
                <!-- DovizScroll -->
                <div class="DovizScroll alert alert-warning">
                    <a>
                        <img width="40" src="/img/1.svg" alt="altın">
                        <b id="DovizAlt"><?php echo $PDoviz['Altin']; ?></b>
                    </a>
                    <a>
                        <img width="40" src="/img/2.svg" alt="Euro">
                        <b id="DovizEuro"><?php echo $PDoviz['Euro']; ?></b>
                    </a>

                    <a>
                        <img width="40" src="/img/4.svg" alt="Dolar">
                        <b id="DovizDolar"><?php echo $PDoviz['USD']; ?></b>
                    </a>
                </div>
            </div>
            <!-- Ends Bar -->






















            <div class="BodyContent">



                @yield('content')




            </div>
            <!-- End BodyContent -->












            <!-- End BodyContent -->
            <!-- Footer -->
            <div class="Footer">
                <div class="row FooterContener">
                    <div class="col-md-3">
                        <table>
                            <tr>
                                <td> <a href="{{route("bizkimiz")}}">
                                        - Biz kimiz </a> </td>
                            </tr>
                            <tr>
                                <td> <a href="{{route("privacy-policy")}}">
                                        - Gizlilik Politikası </a> </td>
                            </tr>
                            <tr>
                                <td> <a href="/feed">
                                        - Sitemap </a> </td>
                            </tr>
                        </table>
                    </div>


                    <div style="text-align: center" class="col-sm-4">
                        <table>
                            <tr> <td> <a href="{{route("home")}}"> - ANA SAYFA </a> </td> </tr>


                            <?php
                                for ($i = 0; $i < $PLoadAllTypeNews->count(); $i++) {
                                    $name = $PLoadAllTypeNews[$i]['Name'];
                                    $link = str_replace(" ",'_',$name);
                                    echo '<tr> <td> <a href="/bolum/'.$link.'"> - '.$name.' </a> </td> </tr>';
                                }
                            ?>

                        </table>
                    </div>




                    <div class="col-md-4">
                        <table style="text-align: center">
                            <tbody style="text-align: center">
                                <tr>
                                    <td> <a href="#"> <img width="200" src="/img/apple.store.png"> </a> </td>
                                </tr>
                                <tr>
                                    <td> <a href="#"> <img width="200" src="/img/google.play.png"> </a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="copyrigt">
                    <p>Copyright CoronaTürkiye © <?php echo date("Y"); ?></p>
                </div>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</div>
<script src="/js/vendor/jquery.js"></script>
<script src="/js/foundation.js"></script>
<script src="/js/rvslider.min.js"></script>
<script src="/js/app.2.js"></script>
</body>
</html>
