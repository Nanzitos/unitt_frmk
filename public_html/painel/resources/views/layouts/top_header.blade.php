<div class="header navbar">
  <div class="brand visible-xs">
    <!-- toggle offscreen menu -->
    <div class="toggle-offscreen">
      <a href="javascript:;" class="hamburger-icon visible-xs" data-toggle="offscreen" data-move="ltr">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>
    <!-- /toggle offscreen menu -->
    <!-- logo -->
    <a class="brand-logo">
      <span>AFIA</span>
    </a>
    <!-- /logo -->
  </div>
  <ul class="nav navbar-nav hidden-xs" style="width: 100%">
    <li>
      <a href="javascript:;" class="small-sidebar-toggle ripple" data-toggle="layout-small-menu" id="ToggleMenu">
        <i class="icon-toggle-sidebar"></i>
      </a>
    </li>

    @if(isset($ConfigFile['filtros']) && $ConfigFile['filtros'])
    <li class="searchbox">
      <a href="javascript:;" data-toggle="search">
        <i class="search-close-icon icon-close hide"></i>
        <i class="search-open-icon icon-magnifier"></i>
      </a>
    </li>

    <li class="navbar-form search-form hide my_last_li">
      <div class="box_white">
        <form name="filtros" method="GET" action="<?php echo url('canvas');?>">
        <input type="hidden" name="filtros" value="1">
        @foreach($ConfigFile['filtros'] AS $filtro)
            {{ FormHelper::getInput($filtro, null, 3) }}
        @endforeach

        <div class="col-sm-3">
          <button type="submit" class="btn btn-primary btn-md">Buscar</button>
        </div>

        </form>
      </div>
    </li>
    @endif
  </ul>
  <ul class="nav navbar-nav navbar-right hidden-xs">
    <!--<li>
      <a href="javascript:;" class="ripple" data-toggle="dropdown">
        <span>EN</span>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a href="javascript:;">English</a>
        </li>
        <li>
          <a href="javascript:;">Russian</a>
        </li>
        <li>
          <a href="javascript:;">French</a>
        </li>
        <li>
          <a href="javascript:;">Spanish</a>
        </li>
      </ul>
    </li>-->
    <!--<li>
      <a href="javascript:;" class="ripple" data-toggle="dropdown">
        <i class="icon-bell"></i>
      </a>
      <ul class="dropdown-menu notifications">
        <li class="notifications-header">
          <p class="text-muted small">You have 3 new messages</p>
        </li>
        <li>
          <ul class="notifications-list">
            <li>
              <a href="javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-success text-white">
                    <i class="icon-bulb"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Sean</b> launched a new application</span>
                <span class="time">2s</span>
              </a>
            </li>
            <li>
              <a href="javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-danger text-white">
                    <i class="icon-cursor"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Removed calendar</b> from app list</span>
                <span class="time">4h</span>
              </a>
            </li>
            <li>
              <a href="javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-primary text-white">
                    <i class="icon-basket"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Denise</b> bought <b>Urban Admin Kit</b></span>
                <span class="time">2d</span>
              </a>
            </li>
            <li>
              <a href="javascript:;">
                <div class="notification-icon">
                  <div class="circle-icon bg-info text-white">
                    <i class="icon-bubble"></i>
                  </div>
                </div>
                <span class="notification-message"><b>Vincent commented</b> on an item</span>
                <span class="time">2s</span>
              </a>
            </li>
            <li>
              <a href="javascript:;">
                <span class="notification-icon">
                <img src="images/face3.jpg" class="avatar img-circle" alt="">
                </span>
                <span class="notification-message"><b>Jack Hunt</b> has <b>joined</b> mailing list</span>
                <span class="time">9d</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>-->
    <?php $Usuario = \Auth::user(); ?>
    <li style="margin-top: -55px;">
      <a href="javascript:;" class="ripple" data-toggle="dropdown">
        <img src="/assets/profiles/{{ $Usuario->id }}.jpg" class="header-avatar img-circle" alt="user" title="user" onerror="this.src='../public/assets/images/man.png'; this.title='Imagem não disponível.'" title="Imagem não disponível.">
        <span>{{ $Usuario->nome.' '.$Usuario->sobrenome }}</span>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a href="{{ url('perfil/') }}">Meu perfil</a>
        </li>
        <li role="separator" class="divider"></li>
        <li>
          <a href="{{ url('logout') }}">Sair</a>
        </li>
      </ul>
    </li>
    <!--<li style="margin-top: -55px;margin-left: -32px;">
      <a href="javascript:;" class="ripple" data-toggle="layout-chat-open">
        <i class="icon-user"></i>
      </a>
    </li>-->
  </ul>
</div>
