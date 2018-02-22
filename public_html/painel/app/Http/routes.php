<?php

use App\Sliders;
use App\SliderImagens;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::get('/phpinfo', function(){

    phpinfo();
});


Route::post('get-sliders', function(){

    extract($_POST);

    $Slider = Sliders::find($id);
    $return['Slider'] = $Slider;
    $return['Imagens'] = SliderImagens::where('id_slider', $id)->where("btn_a_txt", $lang)->orderBy('txt_description_color', 'asc')->get();

    if(count($return['Imagens']) < 1){
        $return['Imagens'] = SliderImagens::where('id_slider', $id)->where("btn_a_txt", "BR")->orderBy('txt_description_color', 'asc')->get();
    }
   // print_r($return['Imagens']); exit;

    return json_encode($return);
    exit;


});



Route::get('/', function () {
    return redirect('perfil');
});

Route::post('/login-externo', function () {

    extract($_POST);

    if( \Auth::attempt(array('username' => $username, 'password' => $password)) ){
        return ['response' => true, 'data' => ['id' => \Auth::user()->id]];
    } else {
        return ['response' => false, 'data' => []];
    }

});

Route::post('esqueci', 'UsuariosController@esqueci');


Route::group(['middleware' => ['web']], function () {

    // Generate a login URL

    Route::post('login', 'UsuariosController@login');

    Route::get('perfil','UsuariosController@perfil');
    Route::post('perfil','UsuariosController@perfil');

    Route::post('get-translate','Controller@getTranslate');
    Route::post('save-translate','Controller@saveTranslate');


    //Compras

    Route::post('sliders-deletar-imagem', 'SlidersController@deletarImagem');
    Route::post('galeria-deletar-imagem', 'SlidersController@deletarImagemGaleria');
    Route::post('galeria-imagem-cover', 'GaleriaController@ImgCover');
    Route::post('afia-estrutura-del-img', 'AfiaTravelEstruturaController@deletarImagem');




    /**
    * Rotas dinamicas das areas
    *
    */

    $Areas['login']       = 'UsuariosController';
    $Areas['dashboard']   = 'DashboardController';

    foreach(App\Areas::where('ativo',1)->get() AS $Area){

        if($Area->url){
            $Areas[$Area->url] = $Area->controller.'Controller';
            Route::post($Area->url.'/form', $Area->controller.'Controller@getForm');
        }
    }

    Route::get('export-kits','KitsController@exportKits');
    Route::post('import-kits','KitsController@importKits');

    Route::controllers($Areas);



    Route::get('logout', function(){
        Auth::logout();
        return redirect('login');
    });

    Route::get('login', 'UsuariosController@getLogin');

    /*
     * nao sei onde por
     */


});
