<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


       

          @can('roles')
          <li class=" nav-item"><a href="#"><i class="la la-unlock-alt"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('dashboard.roles') }}</span></a>
              <ul class="menu-content">
                  <li>
                      <a class="menu-item" href="{{ route('dashboard.roles.create') }}" data-i18n="">
                          {{ __('dashboard.create_role') }} </a>
                  </li>
                  <li>
                      <a class="menu-item" href="{{ route('dashboard.roles.index') }}" data-i18n="">{{ __('dashboard.roles') }} </a>
                  </li>
              </ul>
          </li>
          @endcan


      </ul>
  </div>
</div>
