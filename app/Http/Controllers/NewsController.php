<?php

namespace App\Http\Controllers;

use App\News;
use App\NewsImages;
use App\NewsKeywords;
use App\NewsSourcesLinks;
use App\NewsType;
use App\NewsView;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    //
    private $NewsTypeClass;
    private $NewsClass;
    private $KeywordsClass;
    private $NewsSourcesLinksClass;
    private $NewsViewClass;
    private $NewsImageClass;



    public function __construct()
    {
        $this->middleware('auth');
        $this->NewsTypeClass = new NewsType();
        $this->NewsClass = new News();
        $this->KeywordsClass = new NewsKeywords();
        $this->NewsSourcesLinksClass = new NewsSourcesLinks();
        $this->NewsViewClass = new NewsView();
        $this->NewsImageClass = new NewsImages();
//        header('Content-Type: application/json');
    }



    /**
     * !1, News type section.
     */

    public function AddTypeNews(Request $request){
        if ($request->isMethod('post')){
            if(!empty($request->input('AddTypeNewsName'))){
                $this->NewsTypeClass->Name = htmlentities($request->input('AddTypeNewsName'));
                $this->NewsTypeClass->save();
                $i['id'] = $this->NewsTypeClass->id;
                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }
            echo json_encode(array('AddTypeNews'=>$i));
        }
    }

    public function DeleteTypeNews(Request $request){
        if ($request->isMethod('post')){
            if(!empty($request->input('DeleteTypeNewsID'))){
                NewsType::where('id',intval($request->input('DeleteTypeNewsID')))->delete();
                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }
            echo json_encode(array('DeleteTypeNews'=>$i));
        }
    }


    public function EditTypeNews(Request $request){
        if ($request->isMethod('post')){
            if(!empty($request->input('EditTypeNewsID')) && !empty($request->input('EditTypeNewsName'))){
                NewsType::where('id',intval($request->input('EditTypeNewsID')))->update([
                    'Name'=>htmlentities($request->input('EditTypeNewsName'))
                ]);
                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }

            echo json_encode(array('EditTypeNews'=>$i));
        }
    }





    public function LoadAllTypeNews(){
        $i['data'] = NewsType::orderBy('created_at','DESC')
            ->get();
        $i['stauts'] = 'ok';
        echo json_encode(array('LoadAllTypeNews'=>$i));
    }

    public function PLoadAllTypeNews(){
        $Query = NewsType::orderBy('created_at','DESC')
            ->select("id","Name")
            ->get();
        return $Query;
    }

    public function PDoviz(){
        $response= file_get_contents("https://www.kuveytturk.com.tr/FinancePortal/Exchange/GetAll");
        $DeJsonArray = json_decode($response,true);
        $Res['USD'] =$DeJsonArray[1]['SellRate'];
        $Res['Euro'] =$DeJsonArray[2]['SellRate'];
        $Res['Altin'] =$DeJsonArray[3]['SellRate'];
        return $Res;
    }







    /**
     * !2, News section.
     */
    public function AddNewNews(Request $request){
        if ($request->isMethod('post')){
            $this->NewsClass->anotherID = 1;
            $this->NewsClass->NewstypeID = intval($request->input('AddNewNewsNewstypeID'));
            $this->NewsClass->Title = $request->input('AddNewNewsTitle');
            $this->NewsClass->Description = $request->input('AddNewNewsDescription');
            $this->NewsClass->Text = $request->input('AddNewNewsText');
            $this->NewsClass->PublishStatus = 0;
            if($this->NewsClass->save()){
                $i['id'] = $this->NewsClass->id;
                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }
            echo json_encode(array('AddNewNews'=>$i));
        }
    }

    public function DeleteNews(Request $request){
        if ($request->isMethod('post')){
            News::where('id',intval($request->input('DeleteNewsID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteNews'=>$i));
        }
    }

    public function EditNews(Request $request){
        if ($request->isMethod('post')){
            $query = News::where('id',intval($request->input('EditNewsID')))->update([
                'NewstypeID'=>intval($request->input('EditNewsNewstypeID')),
                'Title'=>$request->input('EditNewsTitle'),
                'Description'=>$request->input('EditNewsDescription'),
                'Text'=>$request->input('EditNewsText')
            ]);
            if ($query){
                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }
            echo json_encode(array('EditNews'=>$i));
        }
    }


    public function LoadAllNews(){
        $data = News::join('news_types', 'news.NewstypeID', '=', 'news_types.id')
            ->select(
                'news.id',
                'news.NewstypeID',
                'news_types.Name',
                'news.Title',
                'PublishStatus',
                'news.created_at'
            )->orderBy('created_at','DESC')->get();
        //  ASC
        if($data){
            $i['data']= $data;
            $i['stauts'] = 'ok';
        }else{
            $i['status']= 'error';
        }
        echo json_encode(array('LoadAllNews'=>$i));
    }

    public function PLoadLastNews($limt){
        $Query = News::where('PublishStatus',1)
            ->join('news_types', 'news.NewstypeID', '=', 'news_types.id')
            ->join('news_images', 'news.id', '=', 'news_images.newsID')
            ->select(
                'news.id',
                'news.NewstypeID',
                'news_types.Name',
                'news.Title',
                'news.Description',
                'news_images.imageURL',
                'news.created_at'
            )->orderBy('created_at','DESC')
            ->limit(intval($limt))
            ->get();
        return $Query;
    }

    public function PLoadNewsOfSection($sectionName){
        $sectionName = str_replace("_",' ',$sectionName);
        $SectionQuery = NewsType::where("Name",htmlentities($sectionName))
            ->get();
        if($SectionQuery && $SectionQuery->count() > 0){
            $SectionNewsID = intval($SectionQuery[0]['id']);
            $NewsQuery = News::where("NewstypeID",$SectionNewsID)
                ->where('PublishStatus',1)
                ->join('news_images', 'news.id', '=', 'news_images.newsID')
                ->select(
                    'news.id',
                    'news.NewstypeID',
                    'news.Title',
                    'news.Description',
                    'news_images.imageURL',
                    'news.created_at'
                );
//
//
            $res['NewsForShow'] = $NewsQuery->get();
            $res['NewsForSlider'] = $NewsQuery->limit(3)->get();
            $res['SectionName'] = $sectionName;
            $res['status'] = "ok";
        }else{
            $res['NewsForShow'] = array();
            $res['NewsForSlider'] = array();
            $res['SectionName'] = 'Error';
            $res['status'] = "error";
        }

        return $res;
    }



    public function PLoadNews($Description){
        $Description = str_replace("_",' ',$Description);
        $Query = News::where("Description",htmlentities($Description))->get();
        if($Query && count($Query) > 0){
            $newsID = $Query[0]['id'];

            $ResNews['Details']= News::where('id',intval($newsID))
                ->where('PublishStatus',1)
                ->select(
                    'id',
                    'NewstypeID',
                    'Title',
                    'Description',
                    'Text',
                    'created_at'
                )->get();
            $ResNews['Image']= NewsImages::where('newsID',$newsID)->select('imageURL')->get();
            $ResNews['Link']= NewsSourcesLinks::where('newsID',$newsID)->select('Link')->get();
            $ResNews['Keyword']= NewsKeywords::where('newsID',$newsID)->select('keyword')->get();
            $ResNews['Section']= NewsType::where('id',$ResNews['Details'][0]['NewstypeID'])->select('Name')->get();

            $res['dat'] = $ResNews;
            $res['status'] ='ok';
        }else{
            $res['status'] = "error";
        }
        return $res;
    }


    public function LoadAllNewsFromSection(Request $request){
        if ($request->isMethod('post')){
            $data = News::where('NewstypeID',intval($request->input('LoadAllNewsFromSectionID')))
                ->join('news_types', 'news.NewstypeID', '=', 'news_types.id')
                ->select(
                    'news.id',
                    'news.NewstypeID',
                    'news_types.Name',
                    'news.Title',
                    'PublishStatus',
                    'news.created_at'
                )->orderBy('created_at','DESC')->get();
            //  ASC
            if($data){
                $i['data']= $data;
                $i['stauts'] = 'ok';
            }else{
                $i['status']= 'error';
            }
        echo json_encode(array('LoadAllNewsFromSection'=>$i));
        }
    }



    public function LoadOneNews(Request $request){
        if ($request->isMethod('post')){
            $newsID = intval($request->input('LoadOneNewsID'));
            if(!empty($newsID)){
//                $i['details'] = News::where('id',$newsID)->get();
                $i['details'] = News::where('id',$newsID)
//                    ->join('news_types', 'news.NewstypeID', '=', 'news_types.id')
//                    ->select(
//                        'news.id',
//                        'news.NewstypeID',
//                        'news_types.Name',
//                        'news.Title',
//                        'PublishStatus',
//                        'news.created_at'
//                    )
                    ->get();


                $i['image'] = NewsImages::where('newsID',$newsID)->get('imageURL');
                $i['Source'] = NewsSourcesLinks::where('newsID',$newsID)->get('Link');
                $i['Keywords'] = NewsKeywords::where('newsID',$newsID)->get('keyword');

                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }

            echo json_encode(array('LoadOneNews'=>$i));
        }
    }



    /**
     * !3, Keywords section.
     */
    public function AddKeywordsToNews(Request $request){
        if ($request->isMethod('post')){
            $this->KeywordsClass->newsID = intval($request->input('AddKeywordsToNewsNewsID'));
            $this->KeywordsClass->keyword = htmlentities($request->input('AddKeywordsToNewsKeyword'));
            if($this->KeywordsClass->save()){
                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }
            echo json_encode(array('AddKeywordsToNews'=>$i));
        }
    }

    public function EditKeywordsToNews(Request $request){
        if ($request->isMethod('post')){
            NewsKeywords::where('newsID',intval($request->input('EditKeywordsToNewsID')))->update([
                'keyword'=>htmlentities($request->input('EditKeywordsToNewsKeyword'))
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('EditKeywordsToNews'=>$i));
        }
    }

    public function DeleteKeywordsToNews(Request $request){
        if ($request->isMethod('post')){
            NewsKeywords::where('id',intval($request->input('DeleteKeywordsToNewsID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteKeywordsToNews'=>$i));
        }
    }

    public function LoadKeywordsOfNews(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = NewsKeywords::where('newsID',intval($request->input('LoadKeywordsOfNewsID')))
            ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadKeywordsOfNews'=>$i));
        }
    }




    /**
     * !4, SourcesLinks section.
     */
    public function AddSourcesLinksToNews(Request $request){
        if ($request->isMethod('post')){
            $this->NewsSourcesLinksClass->newsID = intval($request->input('AddSourcesLinksToNewsNewsID'));
            $this->NewsSourcesLinksClass->Link = $request->input('AddSourcesLinksToNewsLinks');
            $this->NewsSourcesLinksClass->save();
            $i['stauts'] = 'ok';
            echo json_encode(array('AddSourcesLinksToNews'=>$i));
        }
    }

    public function EditSourcesLinksToNews(Request $request){
        if ($request->isMethod('post')){
            NewsSourcesLinks::where('newsID',intval($request->input('EditSourcesLinksToNewsID')))->update([
                'Link'=>$request->input('EditSourcesLinksToNewsLink')
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('EditSourcesLinksToNews'=>$i));
        }
    }

    public function LoadSourcesLinksOfNews(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = NewsSourcesLinks::where('newsID',intval($request->input('LoadSourcesLinksOfNewsID')))
            ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadSourcesLinksOfNews'=>$i));
        }
    }

    public function DeleteSourcesLinksOfNews(Request $request){
        if ($request->isMethod('post')){
            NewsSourcesLinks::where('id',intval($request->input('DeleteKeywordsToNewsID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteSourcesLinksOfNews'=>$i));
        }
    }



    /**
     * !5, NewsView section.
     */
    public function AddNewsViewer(Request $request){
        if ($request->isMethod('post')){
            $this->NewsViewClass->newsID = intval($request->input('AddNewsViewerNewsID'));
            $this->NewsViewClass->IP = Request::ip();
            $this->NewsViewClass->Country = Location::get(Request::ip());
            $this->NewsViewClass->save();
            $i['stauts'] = 'ok';
            echo json_encode(array('AddNewsViewer'=>$i));
        }
    }


    public function CountAllViewer(Request $request){
            $i['data'] = NewsView::count();
            $i['stauts'] = 'ok';
            echo json_encode(array('CountAllViewer'=>$i));
    }

    public function CountViewerOfOneNews(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = NewsView::where('newsID',intval($request->input('CountViewerOfOneNewsID')));
            $i['stauts'] = 'ok';
            echo json_encode(array('CountViewerOfOneNews'=>$i));
        }
    }






    /**
     * !6, NewsImage section.
     */
    public function AddNewsImage(Request $request){
        if ($request->isMethod('post')){
            if (!empty($request->input('AddNewsImageNewsID'))){
                $validation = Validator::make($request->all(), [
                    'NewsImagesPost' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'AddNewsImageNewsID'=>'required'
                ]);

                if($validation->passes()){
                    $image = $request->file('NewsImagesPost');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $new_name);
                    $this->NewsImageClass->anotherID = 1;
                    $this->NewsImageClass->newsID = intval($request->input('AddNewsImageNewsID'));
                    $this->NewsImageClass->imageURL = $new_name;
                    $this->NewsImageClass->position = 0;
                    if($this->NewsImageClass->save()){

                        $i['stauts'] = 'ok';
                    }else{
                        $i['stauts'] = 'error #i03';
                    }

                }else{
                    $i['status'] = 'error #i02';
                }
            }else{
                $i['status'] = 'error #i01';
            }

            echo json_encode(array('AddNewsImage'=>$i));
        }
    }


    public function EditNewsImages(Request $request){
        if ($request->isMethod('post')){
            if (!empty($request->input('AddNewsImageNewsID'))){
                $validation = Validator::make($request->all(), [
                    'NewsImagesPost' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'AddNewsImageNewsID'=>'required'
                ]);

                if($validation->passes()){
                    $image = $request->file('NewsImagesPost');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $new_name);

                    $query = NewsImages::where('newsID',intval($request->input('AddNewsImageNewsID')))->update([
                        'anotherID'=>1,
                        'newsID'=>intval($request->input('AddNewsImageNewsID')),
                        'imageURL'=>$new_name,
                        'position'=>0
                    ]);
                    if($query){
                        $i['stauts'] = 'ok';
                    }else{
                        $i['stauts'] = 'error #i03';
                    }
                }else{
                    $i['status'] = 'error #i02';
                }
            }else{
                $i['status'] = 'error #i01';
            }

            echo json_encode(array('EditNewsImages'=>$i));
        }
    }




    public function DeleteNewsImage(Request $request){
        if ($request->isMethod('post')){
            NewsImages::where('id',intval($request->input('DeleteNewsImageID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteNewsImage'=>$i));
        }
    }

    public function LoadAllImageOfNews(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = NewsView::where('newsID',intval($request->input('LoadAllImageOfNewsID')))
                ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadAllImageOfNews'=>$i));
        }
    }



    /**
     * !7, NewsPublishStatus section.
     */
    public function PublishNewsOn(Request $request){
        if ($request->isMethod('post')){
            News::where('id',intval($request->input('PublishNewsOnID')))->update([
                'PublishStatus'=>1
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('PublishNewsOn'=>$i));
        }
    }

    public function PublishNewsOff(Request $request){
        if ($request->isMethod('post')){
            News::where('id',intval($request->input('PublishNewsOffID')))->update([
                'PublishStatus'=>0
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('PublishNewsOff'=>$i));
        }
    }




    /**
     * !8, ConditionNewsLoad section.
     */
    public function LoadNewsOfTypeNews(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = News::where('NewstypeID',intval($request->input('LoadNewsOfTypeNewsID')))
                ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadNewsOfTypeNews'=>$i));
        }
    }

    public function LoadLastTenNews(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = News::orderBy('created_at','DESC')
                ->limit(10)
                ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadLastTenNews'=>$i));
        }
    }










}
