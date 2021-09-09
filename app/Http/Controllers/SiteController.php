<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NewsController;

class SiteController extends Controller
{

    private $NewsController;




    public function __construct()
    {
        $this->NewsController = new NewsController();
    }
    public function index()
    {
        return view('site/index');
    }

    public function bizkimiz()
    {
        return view('site/bizkimiz');
    }

    public function Sections($SectionName)
    {
        $data = $this->NewsController->PLoadNewsOfSection($SectionName);
        return view('site/sections',$data);
    }

    public function NewsView($title)
    {
        $data = $this->NewsController->PLoadNews($title);
        return view('site/NewsView',$data);
    }

    public function PrivacyPolicy()
    {
        return view('site/privacy-policy');
    }

    public function Sitemap(){
        $a = new NewsController();
        echo $s = $a->PLoadLastNews(2);
//        echo "<pre>";
//        var_dump($s);
////
//        for ($i = 0; $i < $s->count(); $i++) {
//            echo $s[$i]['Name']."<br>";
//        }

    }

    public function Doviz(Request $request){
        if ($request->isMethod('post')){
            $reqqw = "https://www.kuveytturk.com.tr/FinancePortal/Exchange/GetAll";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,0);
            curl_setopt($ch, CURLOPT_URL, $reqqw);
            $response = curl_exec($ch);
            curl_close($ch);
        }
    }
    //
}
