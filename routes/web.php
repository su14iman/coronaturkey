<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/home', 'HomeController@index');
//Route::get('/test', 'AdminController@index');

Route::get('/', 'SiteController@index')->name("home");;
Route::get('/bizkimiz', 'SiteController@bizkimiz')->name("bizkimiz");;
Route::get('/privacy-policy', 'SiteController@PrivacyPolicy')->name("privacy-policy");;
//Route::get('/Sitemap', 'SiteController@Sitemap')->name("Sitemap");;


Route::get('/bolum/{name}', 'SiteController@Sections')->name("Sections");;
Route::get('/v/{title}', 'SiteController@NewsView')->name("NewsView");;



//Service:
//Route::post('/Services/Doviz', 'SiteController@Doviz')->name("Doviz");

Route::feeds();






Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);










// Admins Section
Auth::routes();
$ControlPanelNamePath = "Adm!n";
Route::get('/'.$ControlPanelNamePath.'/', 'AdminController@index')->name("index");
Route::get('/'.$ControlPanelNamePath.'/NewsSectionManger', 'AdminController@NewsSectionManger')->name("NewsSectionManger");
Route::get('/'.$ControlPanelNamePath.'/NewsManger', 'AdminController@NewsManger')->name("NewsManger");
Route::get('/'.$ControlPanelNamePath.'/AddNews', 'AdminController@AddNews')->name("AddNews");
Route::get('/'.$ControlPanelNamePath.'/EditNews', 'AdminController@EditNews')->name("EditNews");
Route::get('/'.$ControlPanelNamePath.'/StatisticsManger', 'AdminController@StatisticsManger')->name("StatisticsManger");
Route::get('/'.$ControlPanelNamePath.'/UsersManger', 'AdminController@UsersManger')->name("UsersManger");
Route::get('/'.$ControlPanelNamePath.'/AccountManger', 'AdminController@AccountManger')->name("AccountManger");

//Post

//  News Section
Route::post('/'.$ControlPanelNamePath.'/AddTypeNews', 'NewsController@AddTypeNews')->name("AddTypeNews");
Route::post('/'.$ControlPanelNamePath.'/LoadAllTypeNews', 'NewsController@LoadAllTypeNews')->name("LoadAllTypeNews");
Route::post('/'.$ControlPanelNamePath.'/DeleteTypeNews', 'NewsController@DeleteTypeNews')->name("DeleteTypeNews");
Route::post('/'.$ControlPanelNamePath.'/EditTypeNews', 'NewsController@EditTypeNews')->name("EditTypeNews");


//  Statistics
Route::post('/'.$ControlPanelNamePath.'/AddNewStatisticsGeneral', 'StatisticsController@AddNewStatisticsGeneral')->name("AddNewStatisticsGeneral");
Route::post('/'.$ControlPanelNamePath.'/LoadAllStatisticsGeneral', 'StatisticsController@LoadAllStatisticsGeneral')->name("LoadAllStatisticsGeneral");


// News:
//Add News.
Route::post('/'.$ControlPanelNamePath.'/AddNewNews', 'NewsController@AddNewNews')->name("AddNewNews");
Route::post('/'.$ControlPanelNamePath.'/AddKeywordsToNews', 'NewsController@AddKeywordsToNews')->name("AddKeywordsToNews");
Route::post('/'.$ControlPanelNamePath.'/AddSourcesLinksToNews', 'NewsController@AddSourcesLinksToNews')->name("AddSourcesLinksToNews");
Route::post('/'.$ControlPanelNamePath.'/AddNewsImage', 'NewsController@AddNewsImage')->name("AddNewsImage");
Route::post('/'.$ControlPanelNamePath.'/PublishNewsOn', 'NewsController@PublishNewsOn')->name("PublishNewsOn");
Route::post('/'.$ControlPanelNamePath.'/PublishNewsOff', 'NewsController@PublishNewsOff')->name("PublishNewsOff");


//Load News.
Route::post('/'.$ControlPanelNamePath.'/LoadAllNews', 'NewsController@LoadAllNews')->name("LoadAllNews");
Route::post('/'.$ControlPanelNamePath.'/LoadAllNewsFromSection', 'NewsController@LoadAllNewsFromSection')->name("LoadAllNewsFromSection");
Route::post('/'.$ControlPanelNamePath.'/DeleteNews', 'NewsController@DeleteNews')->name("DeleteNews");
Route::post('/'.$ControlPanelNamePath.'/LoadOneNews', 'NewsController@LoadOneNews')->name("LoadOneNews");

//Edit News.
Route::post('/'.$ControlPanelNamePath.'/EditNews', 'NewsController@EditNews')->name("EditNews");
Route::post('/'.$ControlPanelNamePath.'/EditKeywordsToNews', 'NewsController@EditKeywordsToNews')->name("EditKeywordsToNews");
Route::post('/'.$ControlPanelNamePath.'/EditSourcesLinksToNews', 'NewsController@EditSourcesLinksToNews')->name("EditSourcesLinksToNews");
Route::post('/'.$ControlPanelNamePath.'/EditNewsImages', 'NewsController@EditNewsImages')->name("EditNewsImages");

//Users.
Route::post('/'.$ControlPanelNamePath.'/LoadAllUser', 'UserController@LoadAllUser')->name("LoadAllUser");
Route::post('/'.$ControlPanelNamePath.'/AddNewUser', 'UserController@AddNewUser')->name("AddNewUser");
Route::post('/'.$ControlPanelNamePath.'/UpdateUserPassword', 'UserController@UpdateUserPassword')->name("UpdateUserPassword");
Route::post('/'.$ControlPanelNamePath.'/DeleteUser', 'UserController@DeleteUser')->name("DeleteUser");

//UserChangePassword.
Route::post('/'.$ControlPanelNamePath.'/UpdateMyPassword', 'UserController@UpdateMyPassword')->name("UpdateMyPassword");

