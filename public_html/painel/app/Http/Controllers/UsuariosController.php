<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Usuarios;


class UsuariosController extends Controller
{

  public function getIndex()
  {
       /*
      * Retorna os registros padrões
      */
      $this->Model = Usuarios::paginate($this->pagination);

      if(isset($_GET['filtros'])){
          $request       = \Request::all();

          $this->Model = Usuarios::where(function($q) use ($request) {

              extract($request);

              if( isset($nome) && $nome ){
                  $q->where('nome','LIKE',"%$nome%");
              }

              if( isset($id_grupo) && $id_grupo ){
                  $q->where('id_grupo',$id_grupo);
              }

          })->paginate($this->pagination);

      }
      return parent::getIndex();
  }
    /**
     * Tela de exibição de login
     *
     * @param  null
     * @return View
     */
    public function getLogin()
    {

        return view('layouts.login')
            ->with('ConfigFile', $this->getConfigFile())
            ->with('title','Login');
    }

    /**
     * Perfil do usuário
     *
     * @param  null
     * @return View
     */
    public function perfil()
    {
        $error = 0;

        if (\Request::isMethod('post')){

            if( isset($_FILES) && $_FILES ){

                $filename  = \Auth::user()->id . '.jpg';
                $path      = getcwd().'/assets/profiles/';
                $image     = \Request::file('image')->move($path, $filename);

                return redirect( url('perfil?r=1') );
            }

            $data = \Request::all();

            $id = \Auth::user()->id;

            if($data['password']){
                $data['password'] = \Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            //Remove os especiais do cep/cpf
            $data['cep'] = preg_replace( '#[^0-9]#', '', $data['cep']);
            $data['cpf'] = preg_replace( '#[^0-9]#', '', $data['cpf']);

            // Remove o token
            unset($data['_token']);
            unset($data['perfil']);

            $Usuario = Usuarios::where('id', $id)
                                ->update($data);

            if($Usuario){
                $error = 1;
            }

            return redirect( url('perfil?r='.$error) );

        }

        return view('usuarios.perfil')
            ->with('ConfigFile', $this->getConfigFile())
            ->with('title','Perfil');
    }

    /**
    * login
    *
    * Input de dados para login
    *
    * @param $_POST
    * @return boolean
    */

    public function login()
    {

        if (\Request::isMethod('post')){

            extract(\Request::all());

            if( \Auth::guest() ){

                if(!\Auth::attempt(array('username' => $user, 'password' => $password))){
                    return redirect('/login?error');
                }
            }
        }

        return redirect('/perfil');
    }

    /**
     * esqueci
     *
     * Recupera a senha do usuário baseado no email informado.
     *
     * @param  int
     * @return String
     */

    public function esqueci()
    {
        if (\Request::isMethod('post')){

            extract(\Request::all());

            $response = false;
            $Usuario  = Usuarios::where('email', $email);


            if($Usuario->count()){

                $Usuario           = $Usuario->first();
                $nova_senha        = $this->newPassword();
                $Usuario->password = \Hash::make($nova_senha);
                $Usuario->save();

                $data_email['id_template'] = 2;
                $data_email['subject']     = 'THE8CO - Esqueci minha senha';
                $data_email['fromName']    = 'THE8CO';
                $data_email['fromMail']    = 'no-reply@the8co.com.br';
                $data_email['toMail']      = array($Usuario->email);
                $data_email['vars']        = array('nome' => $Usuario->nome,
                                                   'sobrenome' => $Usuario->sobrenome,
                                                   'nova_senha' => $nova_senha);


                if(\EmailHelper::send($data_email)){
                    $response = true;
                }

            }

            return response()->json(['response' => $response]);

        }


    }

    /**
     * newPassword
     *
     * Cria uma nova senha randomica de até 12 digitos
     *
     * @param  int
     * @return String
     */

    private function newPassword()
    {
        $alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass        = array();
        $alphaLength = strlen($alphabet) - 1;

        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass);
    }
}
