@extends('layouts.home')


@section('meta')
    <link rel="icon" href="/img/logo.png">
    <title>CoronaTürkiye | Biz Kimiz</title>
    <meta name="keywords" content="türkiye corona son durum , corona son durum , yeni vakalar , türkiyede vakaların sayısı kaç , türkiye coronadan ölü sayısı , hastalığa yakalandı , pozitif çıktı , korona testi negatif çıktı , sağlık bakanlığı , açıklaması , koca açıkladı , koca açıkladı , bakanlıktan açıklama , erdoğan corona açıklaması , corondan korunma yöntemleri , dezenfekte , sağlık çalışanları , evde kal , evde hayat var , türkiyedeki son durum , piyasa durumu , marketlerde ürün tükendi , türkiye , corona , korona , corona spor , spor , maçlar iptal , oyuncusu coronaya yakalandı , sınavlar ertelendi , online sistemine geçildi , dersler uzaktan eğitim , coronadan dolayı kafeler lokantalar ve eğlence yerleri kapatıldı , güzellik salonları coronadan dolayı kapatıldı , coronadan iyileşen sayısı , coronaya yakalanmamak , cumhurbaşkanı açıkladı , coronaya karşı güçlü bir korunma yöntemimiz var , yakalanmamak , evde kalın , sigara içenler corona , solunum sıkntısı , akciğerler , virüs , virüs sıcaklıkta yaşamaz , ellerinizi yıkayın , sık sık dezenfekte edin , evinizi havalandırın , 48 saat hal ilani , sokağa çıkma yasağı , türkiyede sokağa çıkma yasağı , toplam vakaların sayısı , acil ve önemli işiniz olmayınca dışarı çıkmayın , uyarı verdi , uyarıda bulundu , evde kal dedi , corona belirtileri"/>
    <meta name="description" content="Corona salgınını önlemek amacıyla Dünya Sağlık Örgütü’nden ve Türkiye Sağlık Bakanlığı’ndan alınan bilgi ve tavsiyeleri sizlerle doğru paylaşmayı hedefleyen öğrenci grubuyuz. Bunların yanı sıra spor ve döviz kurları hakkında da bilgi sunmayı hedefliyoruz. Amacımız doğru bilgiyi aktararak yalan haberlerden ortaya çıkan psikolojik baskıyı önleyerek insanların bu süreci en iyi şekilde atlatmasıdır."/>
    <meta name="subject" content="Biz Kimiz">
    <meta name="copyright"content="CoronaTürkiye">
    <meta name="author" content="CoronaTürkiye,info@corona-turkiye.com">
    <meta name="category" content="Biz Kimiz">


    <meta name="og:title" content="Biz Kimiz"/>
    <meta name="og:type" content="news"/>
    <meta name="og:url" content="https://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"/>
    <meta name="og:image" content="https://<?php echo$_SERVER['HTTP_HOST']."/img/logo.png"; ?>"/>
    <meta name="og:site_name" content="CoronaTürkiye"/>
    <meta name="og:description" content="Corona salgınını önlemek amacıyla Dünya Sağlık Örgütü’nden ve Türkiye Sağlık Bakanlığı’ndan alınan bilgi ve tavsiyeleri sizlerle doğru paylaşmayı hedefleyen öğrenci grubuyuz. Bunların yanı sıra spor ve döviz kurları hakkında da bilgi sunmayı hedefliyoruz. Amacımız doğru bilgiyi aktararak yalan haberlerden ortaya çıkan psikolojik baskıyı önleyerek insanların bu süreci en iyi şekilde atlatmasıdır."/>
@endsection


@section('content')


    <div class="TitleBodyContent">
        <p>
            <b style="background: #c92e39;padding: 1%;font-size: 2em; margin-left: -3%;">&nbsp
                Biz Kimiz
                &nbsp
            </b>
        </p>
    </div>








    <div class="BizKimizDiv" style="margin-bottom: 15%; padding: 1%;">
        <div class="BizKimizTextTitle">
            <h2>
                Biz kimiz
            </h2>
        </div>
        <div class="BizKimizText" style=" font-size: 1.3em; padding: 1%;">
            <p>
                <code>Corona</code> salgınını önlemek amacıyla Dünya Sağlık Örgütü’nden ve Türkiye Sağlık Bakanlığı’ndan alınan bilgi ve tavsiyeleri sizlerle doğru paylaşmayı hedefleyen öğrenci grubuyuz.<br>
                Bunların yanı sıra spor ve döviz kurları hakkında da bilgi sunmayı hedefliyoruz.<br>
                Amacımız doğru bilgiyi aktararak yalan haberlerden ortaya çıkan psikolojik baskıyı önleyerek insanların bu süreci en iyi şekilde atlatmasıdır.
            </p>
        </div>
    </div>






@endsection