<!doctype html>
<html class="no-js" lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Plataforma Unittá | {{ $title }}</title>
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  
  <!-- PAGE CSS -->
  @if(isset($ConfigFile['styles']))
    @foreach($ConfigFile['styles'] AS $style )
      <link rel="stylesheet" type="text/css" href="{{ $style }}" />
    @endforeach
  @endif
  <!-- /PAGE CSS -->

  <!-- CSS GERAL -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/webfont.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/climacons-font.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/vendor/bootstrap/dist/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/vendor/sweetalert/dist/sweetalert.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/vendor/select2/dist/css/select2.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/vendor/bootstrap-daterangepicker/daterangepicker-bs3.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/card.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/sli.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/animate.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/app.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/'); ?>/assets/styles/app.skins.css" />
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

  <!-- /CSS GERAL -->

</head>