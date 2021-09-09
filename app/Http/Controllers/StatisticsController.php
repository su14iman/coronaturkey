<?php

namespace App\Http\Controllers;

use App\StatisticsCityes;
use App\StatisticsCityesNote;
use App\StatisticsGeneral;
use App\StatisticsGeneralNote;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    //
    private $StatisticsGeneral;
    private $StatisticsGeneralNote;
    private $StatisticsCityes;
    private $StatisticsCityesNote;
//    private $userID;

    public function __construct()
    {
        $this->middleware('auth');
        $this->StatisticsGeneral = new StatisticsGeneral();
        $this->StatisticsGeneralNote = new StatisticsGeneralNote();
        $this->StatisticsCityes = new StatisticsCityes();
        $this->StatisticsCityesNote = new StatisticsCityesNote();
//        $this->userID = Auth::user()->id;

    }


    /**
     * !1, Statistics General section.
     */
    public function AddNewStatisticsGeneral(Request $request){
        if ($request->isMethod('post')){
            //$this->StatisticsGeneral->Place = htmlentities($request->input('AddNewStatisticsGeneralPlace'));
            //$this->StatisticsGeneral->Confirmed = intval($request->input('AddNewStatisticsGeneralConfirmed'));

            if(!empty($request->input('AddNewStatisticsGeneralDeaths')) &&
                !empty($request->input('AddNewStatisticsGeneralRecovered')) &&
                !empty($request->input('AddNewStatisticsGeneralActive'))){
                $this->StatisticsGeneral->Place = '.';
                $this->StatisticsGeneral->Confirmed = '0';
                $this->StatisticsGeneral->Deaths = intval($request->input('AddNewStatisticsGeneralDeaths'));
                $this->StatisticsGeneral->Recovered = intval($request->input('AddNewStatisticsGeneralRecovered'));
                $this->StatisticsGeneral->Active = intval($request->input('AddNewStatisticsGeneralActive'));
                $this->StatisticsGeneral->lastEditroID = 1;
                $this->StatisticsGeneral->save();
                $i['stauts'] = 'ok';
            }else{
                $i['stauts'] = 'error';
            }


            echo json_encode(array('AddNewStatisticsGeneral'=>$i));
        }
    }

    public function EditStatisticsGeneral(Request $request){
        if ($request->isMethod('post')){
            StatisticsGeneral::where('id',intval($request->input('EditStatisticsGeneralID')))->update([
                'Place'=>htmlentities($request->input('EditStatisticsGeneralPlace')),
                'Confirmed'=>intval($request->input('EditStatisticsGeneralConfirmed')),
                'Deaths'=>intval($request->input('EditStatisticsGeneralDeaths')),
                'Recovered'=>intval($request->input('EditStatisticsGeneralRecovered')),
                'Active'=>intval($request->input('EditStatisticsGeneralActive')),
                'lastEditroID'=>Auth::user()->id
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('EditStatisticsGeneral'=>$i));
        }
    }

    public function DeleteStatisticsGeneral(Request $request){
        if ($request->isMethod('post')){
            StatisticsGeneral::where('id',intval($request->input('DeleteStatisticsGeneralID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteStatisticsGeneral'=>$i));
        }
    }

    public function LoadAllStatisticsGeneral(){
        $i['data'] = StatisticsGeneral::orderBy('created_at','DESC')
            ->first();
        $i['stauts'] = 'ok';
        echo json_encode(array('LoadAllStatisticsGeneral'=>$i));
    }

    public function PLoadAllStatisticsGeneral(){
        $Query = StatisticsGeneral::orderBy('created_at','DESC')
            ->first();
        $res['olumlerin']= $Query['Deaths'];
        $res['vaka']= $Query['Active'];
        $res['iyilesen']= $Query['Recovered'];

        return $res;
    }

    public function LoadOneStatisticsGeneral(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = StatisticsGeneral::find(intval($request->input('LoadOneStatisticsGeneralID')))
                ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadOneStatisticsGeneral'=>$i));
        }
    }





    /**
     * !2, Statistics General Note section.
     */
    public function AddStatisticsGeneralNote(Request $request){
        if ($request->isMethod('post')){
            $this->StatisticsGeneralNote->StatisticsGeneralID = intval($request->input('AddStatisticsGeneralNoteID'));
            $this->StatisticsGeneralNote->anotherID = Auth::user()->id;
            $this->StatisticsGeneralNote->Note = htmlentities($request->input('AddStatisticsGeneralNoteNote'));
            $this->StatisticsGeneralNote->save();
            $i['stauts'] = 'ok';
            echo json_encode(array('AddStatisticsGeneralNote'=>$i));
        }
    }

    public function EditStatisticsGeneralNote(Request $request){
        if ($request->isMethod('post')){
            StatisticsGeneralNote::where('id',intval($request->input('EditStatisticsGeneralNoteID')))->update([
                'Note'=>htmlentities($request->input('EditStatisticsGeneralNoteNote')),
                'anotherID'=>Auth::user()->id
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('EditStatisticsGeneralNote'=>$i));
        }
    }

    public function DeleteStatisticsGeneralNote(Request $request){
        if ($request->isMethod('post')){
            StatisticsGeneralNote::where('id',intval($request->input('DeleteStatisticsGeneralID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteStatisticsGeneral'=>$i));
        }
    }

    public function LoadAllStatisticsGeneralNote(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = StatisticsGeneralNote::where('StatisticsGeneralID',intval($request->input('LoadAllStatisticsGeneralNoteID')))
                ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadAllStatisticsGeneralNote'=>$i));
        }
    }




    /**
     * !3, Statistics Cityes section.
     */
    public function AddNewStatisticsCityes(Request $request){
        if ($request->isMethod('post')){
            $this->StatisticsCityes->CityeName = htmlentities($request->input('AddNewStatisticsCityesCityeName'));
            $this->StatisticsCityes->Confirmed = intval($request->input('AddNewStatisticsCityesConfirmed'));
            $this->StatisticsCityes->Deaths = intval($request->input('AddNewStatisticsCityesDeaths'));
            $this->StatisticsCityes->Recovered = intval($request->input('AddNewStatisticsCityesRecovered'));
            $this->StatisticsCityes->Active = intval($request->input('AddNewStatisticsCityesActive'));
            $this->StatisticsCityes->lastEditroID = $this->userID;
            $this->StatisticsCityes->save();
            $i['stauts'] = 'ok';
            echo json_encode(array('AddNewStatisticsCityes'=>$i));
        }
    }

    public function EditStatisticsCityes(Request $request){
        if ($request->isMethod('post')){
            StatisticsCityes::where('id',intval($request->input('EditStatisticsCityesID')))->update([
                'CityeName'=>htmlentities($request->input('EditStatisticsCityesPlace')),
                'Confirmed'=>intval($request->input('EditStatisticsCityesConfirmed')),
                'Deaths'=>intval($request->input('EditStatisticsCityesDeaths')),
                'Recovered'=>intval($request->input('EditStatisticsCityesRecovered')),
                'Active'=>intval($request->input('EditStatisticsCityesActive')),
                'lastEditroID'=>Auth::user()->id
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('EditStatisticsCityes'=>$i));
        }
    }

    public function DeleteStatisticsCityes(Request $request){
        if ($request->isMethod('post')){
            StatisticsCityes::where('id',intval($request->input('DeleteStatisticsCityesID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteStatisticsCityes'=>$i));
        }
    }


    public function LoadAllStatisticsCityes(){
        $i['data'] = StatisticsCityes::orderBy('created_at','DESC')
            ->get();
        $i['stauts'] = 'ok';
        echo json_encode(array('LoadAllStatisticsCityes'=>$i));
    }

    public function LoadOneStatisticsCityes(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = StatisticsGeneral::find(intval($request->input('LoadOneStatisticsCityesID')))
                ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadOneStatisticsCityes'=>$i));
        }
    }






    /**
     * !4, Statistics Cityes Note section.
     */
    public function AddStatisticsCityesNote(Request $request){
        if ($request->isMethod('post')){
            $this->StatisticsCityesNote->StatisticsGeneralID = intval($request->input('AddStatisticsCityesNoteID'));
            $this->StatisticsCityesNote->anotherID = $this->userID;
            $this->StatisticsCityesNote->Note = htmlentities($request->input('AddStatisticsCityesNoteNote'));
            $this->StatisticsCityesNote->save();
            $i['stauts'] = 'ok';
            echo json_encode(array('AddStatisticsCityesNote'=>$i));
        }
    }

    public function EditStatisticsCityesNote(Request $request){
        if ($request->isMethod('post')){
            StatisticsCityesNote::where('id',intval($request->input('EditStatisticsCityesNoteID')))->update([
                'Note'=>htmlentities($request->input('EditStatisticsCityesNoteNote')),
                'anotherID'=>Auth::user()->id
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('EditStatisticsCityesNote'=>$i));
        }
    }

    public function DeleteStatisticsCityesNote(Request $request){
        if ($request->isMethod('post')){
            StatisticsCityesNote::where('id',intval($request->input('DeleteStatisticsCityesNoteID')))->delete();
            $i['stauts'] = 'ok';
            echo json_encode(array('DeleteStatisticsCityesNote'=>$i));
        }
    }

    public function LoadAllStatisticsCityesNote(Request $request){
        if ($request->isMethod('post')){
            $i['data'] = StatisticsCityesNote::where('StatisticsCityesID',intval($request->input('LoadAllStatisticsCityesNoteID')))
                ->get();
            $i['stauts'] = 'ok';
            echo json_encode(array('LoadAllStatisticsCityesNote'=>$i));
        }
    }









}
