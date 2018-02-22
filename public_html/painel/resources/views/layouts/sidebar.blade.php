<div class="sidebar-panel offscreen-left">
  <div class="brand">
    <!-- toggle small sidebar menu -->
    <a href="javascript:;" class="toggle-apps hidden-xs" data-toggle="quick-launch">
      <i class="icon-grid"></i>
    </a>
    <!-- /toggle small sidebar menu -->
    <!-- toggle offscreen menu -->
    <div class="toggle-offscreen">
      <a href="javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>
    <!-- /toggle offscreen menu -->
    <!-- logo -->
      <a href="{{ url('perfil/') }}" class="brand-logo" style="padding: 10px;">ADM AFIA</a>

    <a href="{{ url('perfil/') }}" class="small-menu-visible brand-logo">AFIA</a>
    <!-- /logo -->
  </div>
  <!-- main navigation -->
  <nav role="navigation">
    <ul class="nav">
      <?php $AreasPermissoes = explode(',', \Auth::user()->areas_permissoes); ?>
      @foreach(App\Areas::where(array('ativo' => 1, 'id_pai' => NULL))->orWhere(array('ativo' => 1, 'id_pai' => 0))->orderBy('order_by', 'asc')->get() AS $Area)
      <?php $Area->Subareas = App\Areas::where(array('ativo' => 1, 'id_pai' => $Area->id))->orderBy('order_by', 'asc')->get(); ?>
      @if(in_array($Area->id, $AreasPermissoes) || \Auth::user()->superadmin )
      @if($Area->controller)
      <li>
        <a href="{{ url($Area->url) }}">
          <i class="{{ $Area->icon }}"></i>
          <span>{{ $Area->titulo }}</span>
        </a>
      </li>
      @else
      <li class="menu-accordion">
        <?php
          $style = '';
          if($Area->super_admin){
            $style = 'background-color:#6164C1 !important; color:#FFF !important;';
          }
        ?>
        <a href="javascript:;" style="{{ $style }}">
            <i class="{{ $Area->icon }}"></i>
            <span>{{ $Area->titulo }}</span>
          </a>
          <ul class="sub-menu">
            @foreach($Area->Subareas AS $SubArea)
            @if( in_array($SubArea->id, $AreasPermissoes) || \Auth::user()->superadmin )
            <li>
              <a href="{{ url($SubArea->url) }}">
                <i class="{{ $SubArea->icon }}"></i>
                <span>{{ $SubArea->titulo }}</span>
              </a>
            </li>
            @endif
            @endforeach
          </ul>
      </li>
      @endif
      @endif
      <!-- /{{ strtolower($Area->titulo) }} -->
      @endforeach
    </ul>
  </nav>
  <!-- /main navigation -->
</div>
