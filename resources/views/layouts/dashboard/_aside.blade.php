<div class="sidebar-wrapper sidebar-theme">
    @php
    $current_lang =  LaravelLocalization::getCurrentLocale();
    @endphp
    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-text">
                <a href="{{route('dashboard.home')}}" class="nav-link"> E.R.P </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather sidebarCollapse feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
            </li>
        </ul>

        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            @if (auth()->user()->hasRole(['Company_user','Super_admin']))
            <li class="menu {{is_active('home')}}">
                <a href="{{route('dashboard.home')}}" aria-expanded="{{is_true(['home'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> {{ $current_lang == 'ar'  ? ' الرئيسية' :'Dashboard'}}</span>
                    </div>

                </a>

            </li>
            @endif

            {{-- Inventory Management --}}

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>{{ $current_lang == 'ar'  ? 'ادارة المخزون' :'Inventory Management'}}</span>
                </div>
            </li>




            <li class="menu">
                <a href="#stores" data-toggle="collapse" aria-expanded="{{is_true(['brands','categories','units','items','stores','priceList'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span>{{ $current_lang == 'ar'  ? ' المخازن' :'Stores'}}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['brands','categories','units','items','stores','priceList'])}}" id="stores" data-parent="#accordionExample">

                    <li class="{{is_active('brands')}}">
                        <a class="text-white" href="{{route('dashboard.brands.index')}}">  {{ $current_lang == 'ar'  ? 'العلامات التجارية' :'Brands'}} </a>
                    </li>
                    <li class="{{is_active('categories')}}">
                        <a class="text-white" href="{{route('dashboard.categories.index')}}"> {{ $current_lang == 'ar'  ? 'الاقسام' :'Categories'}} </a>
                    </li>
                    <li class="{{is_active('units')}}">
                        <a class="text-white" href="{{route('dashboard.units.index')}}"> {{ $current_lang == 'ar'  ? 'الوحدات' :'Units'}} </a>
                    </li>
                    <li class="{{is_active('items')}}">
                        <a class="text-white" href="{{route('dashboard.items.index')}}"> {{ $current_lang == 'ar'  ? 'الاصناف' :'Items'}} </a>
                    </li>
                    <li class="text-white {{is_active('stores')}}">
                        <a class="text-white" href="{{route('dashboard.stores.index')}}"> {{ $current_lang == 'ar'  ? 'المخازن' :'Stores'}} </a>
                    </li>
                    <li class="text-white {{is_active('priceList')}}">
                        <a class="text-white" href="{{route('dashboard.priceList.index')}}"> @lang('site.price_list') </a>
                    </li>
                    <li class="">
                        <a class="text-white" href=""> {{ $current_lang == 'ar'  ? 'جرد المخازن' :'Stocktaking'}} </a>
                    </li>
                    <li class="">
                        <a class="text-white" href=""> {{ $current_lang == 'ar'  ? 'ارصدة المخازن' :'Stores Balances'}} </a>
                    </li>

                </ul>
            </li>


             {{-- Inventory Management --}}

             <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>{{ $current_lang == 'ar'  ? 'الادارة المالية ' :'Financial Management'}}</span>
                </div>
            </li>




            <li class="menu">
                <a href="#accounting" data-toggle="collapse" aria-expanded="{{is_true(['journals','finSettings','accounts'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>

                        <span>{{ $current_lang == 'ar'  ? ' المحاسبة' :'Accounting'}}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['journals','finSettings','accounts'])}}" id="accounting" data-parent="#accordionExample" >
                    <li class="{{is_active('accounts')}}">
                        <a class="text-white" href="{{route('dashboard.accounts.index')}}">  {{ $current_lang == 'ar'  ? 'شجرة الحسابات' :'Accounts tree'}} </a>
                    </li>
                    <li class="{{is_active('accounts')}}">
                        <a class="text-white" href="{{route('dashboard.accounts.create')}}">  {{ $current_lang == 'ar'  ? ' انشاء حساب' :'Create Account'}} </a>
                    </li>

                    <li class="{{is_active('journals')}}">
                        <a class="text-white" href="{{route('dashboard.journals.create')}}"> @lang('site.create journal')</a>
                    </li>
                    <li class="{{is_active('finSettings')}}">
                        <a class="text-white" href="{{route('dashboard.finSettings.index')}}"> @lang('site.settings')</a>
                    </li>

                </ul>
            </li>


            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>@lang('site.sales_management')</span>
                </div>
            </li>

            <li class="menu">
                <a href="#invoices" data-toggle="collapse" aria-expanded="{{is_true(['invoices'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>                        <span>@lang('site.sales')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['invoices'])}}" id="invoices" data-parent="#accordionExample">
                    <li class="{{is_active('invoices')}}">
                        <a class="text-white" href="{{route('dashboard.invoices.index')}}"> @lang('site.invoices') </a>
                    </li>
                    <li class="{{is_active('invoices')}}">
                        <a class="text-white" href="{{route('dashboard.invoices.create')}}"> @lang('site.create_invoice') </a>
                    </li>
                    <li class="{{is_active('invoices')}}">
                        <a class="text-white" href="{{route('dashboard.invoices.create')}}"> @lang('site.create_offer_price') </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#customer" data-toggle="collapse" aria-expanded="{{is_true(['customers','customerGroup','parentCompany'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                        <span>@lang('site.customers')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['customers','customerGroup','parentCompany'])}}" id="customer" data-parent="#accordionExample">

                    <li class="{{is_active('customers')}}">
                        <a href="{{route('dashboard.customers.index')}}">  @lang('site.customer_list') </a>
                    </li>




                    <li class="{{is_active('customerGroup')}}">
                        <a href="{{route('dashboard.customerGroup.index')}}"> @lang('site.customer_group') </a>
                    </li>
                    <li class="{{is_active('parentCompany')}}">
                        <a href="{{route('dashboard.parentCompany.index')}}"> @lang('site.parent_company') </a>
                    </li>

                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>{{ $current_lang == 'ar'  ? 'ادارة المستخدمين' :'Users Managment'}}</span></div>
            </li>

            {{-- <li class="menu">
                <a href="apps_chat.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        <span>Chat</span>
                    </div>
                </a>
            </li> --}}


            {{--user mangement --}}
            <li class="menu">
                <a href="#users" data-toggle="collapse" aria-expanded="{{is_true(['users','all-users'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                        <span>{{ $current_lang == 'ar'  ? ' المستخدمين' :'Users'}}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['users','all-users'])}}" id="users" data-parent="#accordionExample">
                @if (auth()->user()->hasPermission('read_users'))

                    <li class="{{is_active('all-users')}}">
                        <a href="{{route('dashboard.users.all')}}">  {{ $current_lang == 'ar'  ? ' قائمة المستخدمين' :'List Users'}} </a>
                    </li>
                    @endif

                    @if (auth()->user()->hasPermission('create_users'))

                    <li class="{{is_active('users')}}">
                        <a href="{{route('dashboard.users.create')}}"> {{ $current_lang == 'ar'  ? ' اضافة مستخدم' :'Add User'}} </a>
                    </li>
                    @endif

                </ul>
            </li>
            @if (auth()->user()->hasRole('Super_admin'))
            <li class="menu">
                <a href="#roles" data-toggle="collapse" aria-expanded="{{is_true(['roles','all-roles'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="8" cy="12" r="3"></circle></svg>
                        <span>{{ $current_lang == 'ar'  ? ' الأدوار' :'roles'}}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['roles','all-roles'])}}" id="roles" data-parent="#accordionExample">
                    <li class="{{is_active('roles')}}">
                        <a href="{{route('dashboard.roles.index')}}">  {{ $current_lang == 'ar'  ? ' قائمة المستخدمين' :'List roles'}} </a>
                    </li>
                    <li class="{{is_active('roles')}}">
                        <a href="{{route('dashboard.roles.create')}}"> {{ $current_lang == 'ar'  ? ' اضافة مستخدم' :'Add roles'}} </a>
                    </li>

                </ul>
            </li>
            @endif

            {{--settings  --}}

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>{{ $current_lang == 'ar'  ? ' الإعدادات' :'settings'}}</span></div>
            </li>
            <li class="menu">
                <a href="#setting" data-toggle="collapse" aria-expanded="{{is_true(['tax',''])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <span>{{ $current_lang == 'ar'  ? ' الإعدادات' :'settings'}}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['tax',''])}}" id="setting" data-parent="#accordionExample">


                    <li class="{{is_active('tax')}}">
                        <a href="{{route('dashboard.tax.index')}}">@lang('site.tax') </a>
                    </li>
                </ul>
            </li>



        </ul>

    </nav>

</div>
