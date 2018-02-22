<?php
 $Edicoes = (isset($Model->edicoes) && $Model->edicoes)?json_decode($Model->edicoes):array();
 $campeao = [];
 foreach($Edicoes as $edicao){
  $campeoes = App\Campeoes::where('id_cup_edition',$edicao->id)->get();
  $campeao[$edicao->id] = $campeoes;
 }
  $ct = 1;
?>

<style type="text/css">
  .col-xs-2{ width: 800px; }
  .imgSlid{
    position: relative; float: left;
    margin-bottom: 50px;
  }
  .hrr{
    width: 100%;
    margin-top: 35px;
    background-color: black;
    position: relative;
    float: left;
  }
  fieldset {
    display: block;
    border: 1px solid #c0c0c0;
    padding: .35em .625em .75em;
    margin: 0 2px;
}

</style>
<div class="row">
  <div class="col-sm-12">
    <div class="card bg-white">
        <div class="card-header bg-primary">
            <div class="pull-left">Edições da copa</div>
            <div class="card-controls">
            </div>
        </div>
        <div class="card-block">
          <div class="row" style="margin-top: 25px">
            <input type="button" id="btnNovaCopa" class="btn btn-lg btn-primary btn-block" style="max-width: 35%;margin: 20px;" value="Adicionar nova Edição" />

            <div style="position: relative; float: left; width: 100%; height: 15px;"></div>

            <div id="divNovaCopa" style="display:none;">
              <div class="imgSlid">
               <fieldset>
                  <legend>Ano da Copa</legend>
                    <div class="col-sm-12" style="margin-bottom: 15px;">
                      <label for="year">Ano</label>
                      <input type="text" name="Edicoes[0][year]" class="form-control" style=" padding: 5px;" value="" />
                    </div>
                  <fieldset>
                    <legend>Estádio da Copa:</legend>
                    <div class="col-sm-12" style="margin-bottom: 15px;">
                      <div class="col-sm-7">
                        <label for="id_estadio">Estadio</label><br>
                        <select name="Edicoes[0][id_estadio]" class="form-control">
                          <?php foreach(App\Estadios::all() as $estadio){ ?>
                            <option value="<?php echo $estadio->id; ?>" > <?php echo $estadio->estadio; ?> </option>
                          <?php } ?>
                        </select>
                       </div>
                      <div class="col-sm-5">
                        <label for="cidade"> Cidade </label>
                        <input type="text" name="Edicoes[0][cidade]" class="form-control" style=" padding: 5px;" value="" />
                      </div>
                      <div class="col-sm-3" style="margin-top: 15px;">
                        <label for="pais"> País </label>
                        <input type="text" name="Edicoes[0][pais]" class="form-control" style=" padding: 5px;" value="" />
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend>Categoria:</legend>
                        <div class="col-sm-12" style="margin-top: 15px;">
                          <label for="categoria" style="float: left"> Categoria </label>
                          <select name="Edicoes[0][categoria][]" class="form-control" style="float: left; clear: both;">
                            <?php foreach(App\IdadeCategoriasCategorias::all() as $categoria){ ?>
                              <option value="<?php echo $categoria->id; ?>" > <?php echo $categoria->nome; ?> </option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-6" style="margin-top: 15px;">
                        <fieldset>
                        <legend>Campeão:</legend>
                          <label for="cidade"> Campeão </label>
                          <input type="text" name="Edicoes[0][campeao][]" class="form-control" style=" padding: 5px;" value="" /> <label for="pais"> País Campeão</label>
                          <input type="text" name="Edicoes[0][pais_campeao][]" class="form-control" style=" padding: 5px;" value="" />
                          <label for="pais"> Imagem Campeão </label>
                          <input type="file" name="Edicoes[0][imagem_campeao][]" class="form-control" style=" padding: 5px;" />
                          </fieldset>
                        </div>
                        <div class="col-sm-6" style="margin-top: 15px;">
                        <fieldset>
                        <legend>Vice Campeão:</legend>
                          <label for="cidade"> Vice </label>
                          <input type="text" name="Edicoes[0][vice][]" class="form-control" style=" padding: 5px;" value="" />
                          <label for="pais"> País Vice</label>
                          <input type="text" name="Edicoes[0][pais_vice][]" class="form-control" style=" padding: 5px;" value="" />
                          <label for="pais"> Imagem Vice </label>
                          <input type="file" name="Edicoes[0][imagem_vice][]" class="form-control" style=" padding: 5px;" />
                          </fieldset>
                        </div>
                  </fieldset>
                  </fieldset>
                </div>
            </div>


            <?php foreach($Edicoes as $edicao){ ?>
                <div class="imgSlid" data-edicao="{{$edicao->id}}">
               <fieldset>
                    <legend>Ano da Copa: {{ $edicao->year }}</legend>
                    <input type="button" class="btn btn-warning btnDeletaCopa" data-edicao={{$edicao->id}} value="Deletar Copa" />
                  <div class="col-sm-12" style="margin-bottom: 15px;">
                    <label for="year">Ano</label>
                    <input type="text" name="Edicoes[{{ $ct }}][year]" class="form-control" style=" padding: 5px;" value="{{ $edicao->year }}" />
                 </div>
                  <fieldset>
                    <legend>Estádio da Copa:</legend>
                    <div class="col-sm-12" style="margin-bottom: 15px;">
                  <div class="col-sm-7">
                    <label for="id_estadio">Estadio</label><br>
                    <select name="Edicoes[{{ $ct }}][id_estadio]" class="form-control">
                      <?php foreach(App\Estadios::all() as $estadio){ ?>
                        <?php $selected = ($estadio->id == $edicao->id_estadio) ? "selected=selected" : ""; ?>
                        <option value="<?php echo $estadio->id; ?>" <?php echo $selected; ?> > <?php echo $estadio->estadio; ?> </option>
                      <?php } ?>
                    </select>
                   </div>
                  <div class="col-sm-5">
                    <label for="cidade"> Cidade </label>
                    <input type="text" name="Edicoes[{{ $ct }}][cidade]" class="form-control" style=" padding: 5px;" value="{{ $edicao->cidade }}" />
                    <input type="hidden" name="Edicoes[{{ $ct }}][id_cup]" value="{{ $edicao->id_cup }}" />
                    <input type="hidden" name="Edicoes[{{ $ct }}][id_edicao]" value="{{ $edicao->id }}" />
                  </div>
                  <div class="col-sm-3" style="margin-top: 15px;">
                    <label for="pais"> País </label>
                    <input type="text" name="Edicoes[{{ $ct }}][pais]" class="form-control" style=" padding: 5px;" value="{{ $edicao->pais }}" />
                  </div>
                  </div>
                  </fieldset>
                  <fieldset>
                    <legend>Categoria:</legend>
                  <?php foreach($campeao[$edicao->id] as $camp){ ?>
                    <div class="champs" data-champ="{{ $camp->id }}" style="margin-top:20px; position: relative;
    float: left;">
                      <input type="button" class="btn btn-warning btnDeletaEdicao" data-champ="{{$camp->id}}" value="Deletar Edição" />
                    <div class="col-sm-12" style="margin-top: 15px;">
                      <label for="categoria" style="float: left"> Categoria </label>
                      <select name="Edicoes[{{ $ct }}][categoria][]" class="form-control" style="float: left; clear: both;">
                        <?php foreach(App\IdadeCategoriasCategorias::all() as $categoria){ ?>
                          <?php $selected = ($categoria->id == $camp->id_categorias) ? "selected=selected" : ""; ?>
                          <option value="<?php echo $categoria->id; ?>" <?php echo $selected; ?> > <?php echo $categoria->nome; ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-6" style="margin-top: 15px;">
                    <fieldset>
                    <legend>Campeão:</legend>
                      <label for="cidade"> Campeão </label>
                      <input type="text" name="Edicoes[{{ $ct }}][campeao][]" class="form-control" style=" padding: 5px;" value="{{ $camp->campeao }}" /> <label for="pais"> País Campeão</label>
                      <input type="text" name="Edicoes[{{ $ct }}][pais_campeao][]" class="form-control" style=" padding: 5px;" value="{{ $camp->pais_campeao }}" />
                      <label for="pais"> Imagem Campeão </label>
                      <input type="file" name="Edicoes[{{ $ct }}][imagem_campeao][]" class="form-control" style=" padding: 5px;" value="{{ $camp->imagem_campeao }}" />
                      <input type="hidden" name="Edicoes[{{ $ct }}][imagem_campeao_caminho][]" value="{{ $camp->imagem_campeao }}" />
                      </fieldset>
                    </div>
                    <div class="col-sm-6" style="margin-top: 15px;">
                    <fieldset>
                    <legend>Vice Campeão:</legend>
                      <label for="cidade"> Vice </label>
                      <input type="text" name="Edicoes[{{ $ct }}][vice][]" class="form-control" style=" padding: 5px;" value="{{ $camp->vice }}" />
                      <label for="pais"> País Vice</label>
                      <input type="text" name="Edicoes[{{ $ct }}][pais_vice][]" class="form-control" style=" padding: 5px;" value="{{ $camp->pais_vice }}" />
                      <label for="pais"> Imagem Vice </label>
                      <input type="file" name="Edicoes[{{ $ct }}][imagem_vice][]" class="form-control" style=" padding: 5px;" value="{{ $camp->imagem_vice }}" />
                      <input type="hidden" name="Edicoes[{{ $ct }}][imagem_vice_caminho][]" value="{{ $camp->imagem_vice }}" />
                      </fieldset>
                    </div>
                    </div>
                  <?php } ?>
                  <div id="novasEdicoes-{{ $ct }}" style="margin-top:20px; position: relative;
    float: left;"></div>
                  </fieldset>
                  <input type="button" data-ct="{{ $ct }}" class="btn btn-lg btn-primary btn-block btnNovaEdicao" style="max-width: 35%;margin: 20px;" value="Adicionar nova categoria" />
                  </fieldset>
                </div>

            <?php $ct++; } ?>

          </div>

          <input type="hidden" id="ctImg" />

        </div>

    </div>

  </div>

</div>
