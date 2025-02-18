<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">




            @can('roles')
                <li class=" nav-item"><a href="#"><i class="la la-unlock-alt"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('dashboard.roles') }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('dashboard.roles.create') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.roles.create') }}" data-i18n="">
                                {{ __('dashboard.create_role') }} </a>
                        </li>
                        <li
                            class="{{ request()->routeIs('dashboard.roles.index') || request()->routeIs('dashboard.roles.edit') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.roles.index') }}"
                                data-i18n="">{{ __('dashboard.roles') }} </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('admins')
                <li class=" nav-item"><a href="#"><i class="la la-user-secret"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('dashboard.admins') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $adminsCount }}</span></a>

                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('dashboard.admins.create') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.admins.create') }}"
                                data-i18n="">{{ __('dashboard.create_admin') }} </a>
                        </li>
                        <li
                            class="{{ request()->routeIs('dashboard.admins.index') || request()->routeIs('dashboard.admins.edit') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.admins.index') }}"
                                data-i18n="">{{ __('dashboard.admins') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('global_shipping')
                <li class=" nav-item"><a href="#"><i class="la la-ambulance"></i><span class="menu-title"
                            data-i18n="nav.templates.main"> {{ __('dashboard.shipping') }} </span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('dashboard.countries.index') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.countries.index') }}"
                                data-i18n="">{{ __('dashboard.shippping') }}</a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('categories')
                <li class=" nav-item"><a href="index.html"><i class="la la-folder"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.categories') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $categoriesCount }}</span></a>

                    <ul class="menu-content">
                        <li
                            class="{{ request()->routeIs('dashboard.categories.index') || request()->routeIs('dashboard.categories.edit') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('dashboard.categories.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('dashboard.categories') }}</a>
                        </li>
                        <li class="{{ request()->routeIs('dashboard.categories.create') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.categories.create') }}"
                                data-i18n="nav.dash.crypto">{{ __('dashboard.category_create') }}</a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('brands')
                <li class=" nav-item"><a href="index.html"><i class="la la-check-square"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.brands') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $brandsCount }}</span></a>

                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('dashboard.brands.*') ? 'active' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.brands.index') }}"
                                data-i18n="nav.dash.crypto">{{ __('dashboard.brands') }}</a>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('coupons')
                <li class=" nav-item"><a href="index.html"><i class="la la-500px"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.coupons') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $couponsCount }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('dashboard.coupons.*') ? 'active' : '' }}"><a class="menu-item" href="{{ route('dashboard.coupons.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('dashboard.coupons') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan


        </ul>
    </div>
</div>
