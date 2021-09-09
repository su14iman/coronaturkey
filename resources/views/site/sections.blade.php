@extends('layouts.home')




@section('meta')
    <link rel="icon" href="/img/logo.png">
    <title>CoronaTürkiye | {{$SectionName}}</title>
    <meta name="keywords" content=" {{$SectionName}}, türkiye corona son durum , corona son durum , yeni vakalar , türkiyede vakaların sayısı kaç , türkiye coronadan ölü sayısı , hastalığa yakalandı , pozitif çıktı , korona testi negatif çıktı , sağlık bakanlığı , açıklaması , koca açıkladı , koca açıkladı , bakanlıktan açıklama , erdoğan corona açıklaması , corondan korunma yöntemleri , dezenfekte , sağlık çalışanları , evde kal , evde hayat var , türkiyedeki son durum , piyasa durumu , marketlerde ürün tükendi , türkiye , corona , korona , corona spor , spor , maçlar iptal , oyuncusu coronaya yakalandı , sınavlar ertelendi , online sistemine geçildi , dersler uzaktan eğitim , coronadan dolayı kafeler lokantalar ve eğlence yerleri kapatıldı , güzellik salonları coronadan dolayı kapatıldı , coronadan iyileşen sayısı , coronaya yakalanmamak , cumhurbaşkanı açıkladı , coronaya karşı güçlü bir korunma yöntemimiz var , yakalanmamak , evde kalın , sigara içenler corona , solunum sıkntısı , akciğerler , virüs , virüs sıcaklıkta yaşamaz , ellerinizi yıkayın , sık sık dezenfekte edin , evinizi havalandırın , 48 saat hal ilani , sokağa çıkma yasağı , türkiyede sokağa çıkma yasağı , toplam vakaların sayısı , acil ve önemli işiniz olmayınca dışarı çıkmayın , uyarı verdi , uyarıda bulundu , evde kal dedi , corona belirtileri"/>
    <meta name="description" content="Corona salgınını önlemek amacıyla Dünya Sağlık Örgütü’nden ve Türkiye Sağlık Bakanlığı’ndan alınan bilgi ve tavsiyeleri sizlerle doğru paylaşmayı hedefleyen öğrenci grubuyuz."/>
    <meta name="subject" content="">
    <meta name="copyright"content="CoronaTürkiye">
    <meta name="author" content="CoronaTürkiye,info@corona-turkiye.com">
    <meta name="category" content="{{$SectionName}}">


    <meta name="og:title" content="{{$SectionName}}"/>
    <meta name="og:type" content="news"/>
    <meta name="og:url" content="https://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"/>
    <meta name="og:image" content="https://<?php echo$_SERVER['HTTP_HOST']."/img/logo.png"; ?>"/>
    <meta name="og:site_name" content="CoronaTürkiye"/>
    <meta name="og:description" content="Corona salgınını önlemek amacıyla Dünya Sağlık Örgütü’nden ve Türkiye Sağlık Bakanlığı’ndan alınan bilgi ve tavsiyeleri sizlerle doğru paylaşmayı hedefleyen öğrenci grubuyuz."/>
@endsection


@section('content')



    <div class="TitleBodyContent">
        <p>
            <b style="background: #c92e39;padding: 1%;font-size: 2em; margin-left: -3%;">&nbsp
                {{$SectionName}}
                &nbsp
            </b>
        </p>
    </div>



    <!-- NewsSlider -->
    <div class="NewsSlider">
        <div class="rvs-container rvs-horizontal rvs-use-viewport ">


            <div class="rvs-item-container">
                <div class="rvs-item-stage">

                    <?php
                    for ($i = 0; $i < count($NewsForSlider); $i++) {
                        $Description = $NewsForSlider[$i]['Description'];
                        $Title = $NewsForSlider[$i]['Title'];
                        $created_at = $NewsForSlider[$i]['created_at'];
                        $imageURL = "/images/".$NewsForSlider[$i]['imageURL'];
                        $link = str_replace(" ",'_',$Description);
                        echo '
                                <a href="/v/'.$link.'" class="rvs-item"
                                style="background-image: url('.$imageURL.')">
                                    <p class="rvs-item-text">
                                        '.$Description.'
                                        <small>'.$created_at.'</small>
                                    </p>
                                    <a href="'.$link.'" class="rvs-play-image"></a>
                                </a>
                            ';
                    }

                    ?>



                </div>
            </div>


            <div class="rvs-nav-container ">
                <a class="rvs-nav-prev"></a>
                <div class="rvs-nav-stage">


                    <?php
                    //NewsForSlider
                    for ($i = 0; $i < count($NewsForSlider); $i++) {
                        $Description = $NewsForSlider[$i]['Description'];
                        $Title = $NewsForSlider[$i]['Title'];
                        $created_at = $NewsForSlider[$i]['created_at'];
                        $imageURL = "/images/".$NewsForSlider[$i]['imageURL'];
                        $link = str_replace(" ",'_',$Description);
                        echo '
                                <a class="rvs-nav-item">
                                    <h4 class="rvs-nav-item-title">
                                        '.$Title.'
                                    </h4>
                                    <small class="rvs-nav-item-credits">'.$created_at.'</small>
                                </a>
                            ';
                    }

                    ?>






                </div>
                <a class="rvs-nav-next"></a>
            </div>


        </div>
    </div>
{{--    <div class="ads" style="margin-bottom: 2%;">ads</div>--}}
    <!-- End NewsSlider -->












    <!-- ImageNews -->
    <div class="grid-x small-up-1 medium-up-2 large-up-3 grid-padding-x">

        <?php
        for ($i = 0; $i < count($NewsForShow); $i++) {
            $Description = $NewsForShow[$i]['Description'];
            $created_at = $NewsForShow[$i]['created_at'];
            $imageURL = "/images/".$NewsForShow[$i]['imageURL'];
            $link = str_replace(" ",'_',$Description);
            echo '
                                <div class="cell">
                                    <a href="/v/'.$link.'">
                                        <h5>
                                            <div class="bg-dark card text-white">
                                                <img src="'.$imageURL.'" class="w-100">
                                                <div class="card-img-overlay" style="
                                                                    background-color: #000;
                                                                    opacity: 0.7;
                                                                    top: 40%;
                                                                ">
                                                    <h5 class="card-title">'.$Description.'</h5>

                                                    <p style=" font-size: 0.7em; " class="card-text">'.$created_at.'</p>
                                                </div>
                                            </div>
                                        </h5>
                                    </a>
                                </div>
                            ';
        }
        ?>





{{--        <div class="cell">--}}
{{--            <h5 class="ads">--}}
{{--                Ads--}}
{{--            </h5>--}}
{{--        </div>--}}






    </div>


@endsection