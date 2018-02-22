@extends('layouts.master')

@section('main')
<div class="main-content">
    <div class="m-t-n m-b" style="height: 240px; padding-top: 10px;">
        <div class="card m-b-0 p-a-md no-border m-b m-x-n-g">
            <div class="card-overlay p-a-0" style=""></div>
            <div class="card-block" style="height:250px">
            </div>
        </div>
        <div class="row profile-header text-white">
            <div class="col col-xs-2">
                <img class="profile-avatar" src="/assets/profiles/{{ Auth::user()->id }}.jpg" alt="" style="width:233px; height:233px;"  onerror="this.src='../public/assets/images/face2.jpg'; this.title='Imagem não disponível.'"/>
                <a href="javascript: ;" id="AlterarFoto" style="position: absolute;display: inline-block;background: black;padding: 2px 7px;bottom: 5px;right: 11px; z-index:999;"><i class="icon-camera"> </i></a>
                <form name="" id="FormFotoPerfil" method="POST" action="{{ url('perfil') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                    <input type="file" name="image" id="FieldFotoPerfil" style="display:none;" />
                </form>
            </div>
            <div class="col p-b-lg col-xs-10">
                <div class="profile-stats text-center">
                    <div class="row">

                    </div>
                </div>
                <?php $Usuario = App\Usuarios::find(\Auth::user()->id); ?>
                <div class="profile-user" style="margin-left: 10%;">
                    <h2 class="m-t-0 m-b-0">{{ $Usuario->nome . ' ' . $Usuario->sobrenome }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="card bg-white">
                    <div class="card-header">
                        Informações Pessoais
                    </div>
                    <div class="card-block">
                        <div class="row m-a-0">
                            <div class="col-lg-12">
                                <form id="PerfilForm" class="form-horizontal" role="form" method="POST" action="{{ url('perfil') }}">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                    @foreach($ConfigFile['fields'] AS $field)
                                     @if( $field['name'] != 'id_grupo' )
                             <div class="form-group">
                             {{ FormHelper::getInput($field, \Auth::user()->id, 2) }}
                             </div>
                             @endif
                             @endforeach
                             <div class="col-sm-4"></div>
                             <div class="col-sm-8">
                                   <input type="submit" value="{{ trans('perfil.submit') }}" class="btn btn-primary" style="float:right;" />
                             </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
