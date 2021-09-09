<?php
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatisticsController;


$NewsController = new NewsController();
$StatisticsController = new StatisticsController();


$PLoadAllStatisticsGeneral = $StatisticsController->PLoadAllStatisticsGeneral();
if(empty($dat)){
    $dat = array();
    $dat['Details'][0]['Title'] = "Not Found 404";
}

?>
@extends('layouts.home')

@section('meta')
    <link rel="icon" href="/img/logo.png">
    <title>CoronaTürkiye | <?php echo @$dat['Details'][0]['Title']; ?></title>
    <meta name="keywords" content="<?php echo @$dat['Details'][0]['Title']; ?>"/>
    <meta name="description" content="<?php echo @$dat['Details'][0]['Description']; ?>"/>
    <meta name="subject" content="<?php echo @$dat['Details'][0]['Title']; ?>">
    <meta name="copyright"content="CoronaTürkiye">
    <meta name="author" content="CoronaTürkiye,info@corona-turkiye.com">
    <meta name="category" content="<?php echo @$dat['Section'][0]['Name']; ?>">
    <meta name="revised" content="<?php echo @$dat['Details'][0]['created_at']; ?>" />


    <meta name="og:title" content="<?php echo @$dat['Details'][0]['Title']; ?>"/>
    <meta name="og:type" content="news"/>
    <meta name="og:url" content="https://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"/>
    <meta name="og:image" content="https://<?php echo$_SERVER['HTTP_HOST']."/images/".@$dat['Image'][0]['imageURL']; ?>"/>
    <meta name="og:site_name" content="CoronaTürkiye"/>
    <meta name="og:description" content="<?php echo @$dat['Details'][0]['Description']; ?>"/>
@endsection


@section('content')



    <div class="NewsViewSection">
        <div class="row">

            <div class="col-md-9"
                 style=" margin: auto; ">
                <div class="imageNewsViewSection">
                    <img src="/images/<?php
                    echo @$dat['Image'][0]['imageURL']
                    ?>">
                </div>
            </div>
{{--            <div class="col-md-3 ads">--}}
{{--                ads1--}}
{{--            </div>--}}
        </div>



        <div class="NewsViewContect"
             style=" margin-top: 1%; width: 90%; margin: auto; ">
            <div class="NewsViewTitle">
                <h2 style=" font-weight: bold; text-align: left; ">
                    <?php
                    echo @$dat['Details'][0]['Title']
                    ?>
                </h2>
            </div>
            <div class="NewsViewDate"
                 style=" text-align: left; font-size: 0.8em; ">
                <p>
                    <?php
                    echo @$dat['Details'][0]['created_at']
                    ?>
                </p>
            </div>
            <div class="NewsViewText"
                 style=" text-align: left; font-size: 1.4em; ">
                <p>
                    <?php
                        echo @$dat['Details'][0]['Text']
                    ?>

                </p>
            </div>
            <div class="NewsViewSource"
                 style=" text-align: left; ">
                <b>Haberin kaynağı:</b><br>
                <?php
                $link = @$dat['Link'][0]['Link'];
                $x= explode(",",$link);
                for ($i=0; $i<count($x);$i++){
                    echo '<a target="_blank" href="'.$x[$i] .'">
                            '.$x[$i] .'
                            </a>';
                }


                ?>

            </div>

{{--            <div class="NewsViewSource"--}}
{{--                 style=" text-align: left; margin-top: 4%; ">--}}
{{--                <?php--}}
{{--                echo $dat['Keyword'][0]['keyword'];--}}
{{--                ?>--}}

{{--            </div>--}}
        </div>


    </div>


{{--    <div class="ads">Ads</div>--}}



    <hr style="margin-top: 1%; margin-bottom: 1%;">


    <div class="TitleBodyContent">
        <p>
            <b style="background: #c92e39;padding: 1%;font-size: 2em; margin-left: -3%;">&nbsp
                En son haberler:
                &nbsp
            </b>
        </p>
    </div>

    <!-- ImageNews -->
    <div class="grid-x small-up-1 medium-up-2 large-up-3 grid-padding-x">

        <?php
        $x = $NewsController->PLoadLastNews(3);
        for ($i = 0; $i < $x->count(); $i++) {
            $Description = $x[$i]['Description'];
            $created_at = $x[$i]['created_at'];
            $imageURL = "/images/".$x[$i]['imageURL'];
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






    </div>




@endsection