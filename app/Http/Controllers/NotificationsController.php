<?php

namespace App\Http\Controllers;

use App\NewsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    //
    private $userID;
    private $NotificationClass;

    public function __construct()
    {
        $this->middleware('auth');
        $this->userID = Auth::user()->id;
        $this->NotificationClass = new NewsNotification();
    }


    /**
     * !1, Notification section.
     * 0 ready, 1 publish , 2 done
     */

    public function AddNewsNotification(Request $request){
        if ($request->isMethod('post')){
            $this->NotificationClass->type = intval(0);
            $this->NotificationClass->anotherID = $this->userID;
            $this->NotificationClass->newsID = intval($request->input('AddNewsNotificationNewsID'));
            $this->NotificationClass->PublishStatus = intval(0);
            $this->NotificationClass->save();
            $i['stauts'] = 'ok';
            echo json_encode(array('AddNewsNotification'=>$i));
        }
    }

    public function AddNormalNotification(Request $request){
        if ($request->isMethod('post')){
            $this->NotificationClass->type = intval(1);
            $this->NotificationClass->anotherID = $this->userID;
            $this->NotificationClass->Title = htmlentities($request->input('AddNormalNotificationTitle'));
            $this->NotificationClass->Description = htmlentities($request->input('AddNormalNotificationDescription'));
            $this->NotificationClass->PublishStatus = intval(0);
            $this->NotificationClass->save();
            $i['stauts'] = 'ok';
            echo json_encode(array('AddNormalNotification'=>$i));
        }
    }


    public function LoadAllNotification(){
        $i['data'] = NewsNotification::orderBy('created_at','DESC')
            ->get();
        $i['stauts'] = 'ok';
        echo json_encode(array('LoadAllNotification'=>$i));
    }

    public function LoadAllNotificationReadyForPublish(){
        $i['data'] = NewsNotification::orderBy('created_at','DESC')
            ->where('PublishStatus','0')
            ->get();
        $i['stauts'] = 'ok';
        echo json_encode(array('LoadAllNotificationReadyForPublish'=>$i));
    }

    public function LoadAllNotificationDoneOfPublish(){
        $i['data'] = NewsNotification::orderBy('created_at','DESC')
            ->where('PublishStatus','2')
            ->get();
        $i['stauts'] = 'ok';
        echo json_encode(array('LoadAllNotificationDoneOfPublish'=>$i));
    }

    public function LoadAllNotificationInProssesPublish(){
        $i['data'] = NewsNotification::orderBy('created_at','DESC')
            ->where('PublishStatus','1')
            ->get();
        $i['stauts'] = 'ok';
        echo json_encode(array('LoadAllNotificationInProssesPublish'=>$i));
    }

    public function PublishNotification(Request $request){
        if ($request->isMethod('post')){
            NewsType::where('id',intval($request->input('PublishNotificationID')))->update([
                'PublishStatus'=>'1'
            ]);
            $i['stauts'] = 'ok';
            echo json_encode(array('PublishNotification'=>$i));
        }
    }







}
