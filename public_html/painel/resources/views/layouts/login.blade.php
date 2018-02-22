@include('layouts.head')
<style media="screen">
.container {
  max-width: 490px;
  margin: 0 auto;
  padding: 10% 0;
  height: auto;
  text-align: center;
}
.login-bg{
  background: rgba(0, 0, 0, 0.7);
  color: white;
  border-radius: 1rem;
  padding: 2em;
}
input{    border-radius: 3px !important;
  transition: all 1s !important;
  margin: 0 auto 10px auto;
}
body{background: -webkit-linear-gradient(top left, #e0854f 0%, #cc5a7a 100%);
  background: -moz-linear-gradient(top left, #e0854f 0%, #cc5a7a 100%);
  background: -o-linear-gradient(top left, #e0854f 0%, #cc5a7a 100%);
  background: linear-gradient(to bottom right, #e0854f 0%, #cc5a7a 100%);
}
.btn-primary {
  color: #fff;
  background-color: #3b9a58;
  border-color: rgb(66, 66, 66);
}
</style>
<body class="page-loading">

  <!-- LOADER -->
  @include('layouts.loader')
  <!-- /LOADER -->
  <section>
    <!-- ALL BEGIN HERE -->
    <div class="container">
      <div class="row">
        <div class="text-left login-bg">
          <!-- LOGIN -->
          <form action="{{ url('login') }}" class="form-layout" id="LoginForm" role="form" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="text-center m-b">
              <h4 class="text-uppercase">{{ trans('login.title') }}</h4>
              <p>{{ trans('login.subtitle') }}</p>
            </div>
            @foreach(App\Http\Controllers\UsuariosController::getConfigFile()['fields'] AS $field)
            <div class="form-group">
              {{ FormHelper::getInput($field) }}
            </div>
            @endforeach
            <input type="submit" value="{{ trans('login.button') }}" class="btn btn-primary btn-block btn-lg m-b" />
            <a href="#EsqueciSenha" data-toggle="modal" class="btn btn-block no-bg btn-lg m-b" href="extras-signin.html">{{ trans('login.forgotten') }}</a>
            <p class="text-center">
              <small>
                <em></em>
              </small>
            </p>
          </form>
          <!-- /LOGIN -->
        </div>
      </div>
    </div>
    <!-- ALL END HERE -->
  </section>
  @include('layouts.bottom')
