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
            <li class="menu active">
                <a href="{{route('dashboard.home')}}" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> {{ $current_lang == 'ar'  ? ' الرئيسية' :'Dashboard'}}</span>
                    </div>

                </a>

            </li>


            {{-- purchases Management --}}

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>@lang('site.purchases_mangment')</span>
                </div>
            </li>


            <li class="menu">
                <a href="#purchase-requisitions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span>@lang('site.purchase_requisitions')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="purchase-requisitions" data-parent="#accordionExample">
                    <li>
                        <a class="text-white" href="{{route('dashboard.purchase-requisitions.index')}}">  @lang('site.all_purchase_requisitions') </a>
                    </li>
                    <li>
                        <a class="text-white" href="{{route('dashboard.purchase-requisitions.create')}}">  @lang('site.add_purchase_requisitions') </a>
                    </li>

                </ul>
            </li>

            <li class="menu">
                <a href="#purchase-orders" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span>@lang('site.purchase_orders')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="purchase-orders" data-parent="#accordionExample">
                    <li>
                        <a class="text-white" href="{{route('dashboard.purchase-orders.index')}}">  @lang('site.all_purchase_orders') </a>
                    </li>
                    <li>
                        <a class="text-white" href="{{route('dashboard.purchase-orders.create')}}">  @lang('site.add_purchase_orders') </a>
                    </li>

                </ul>
            </li>



            <li class="menu">
                <a href="#purchases" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span>@lang('site.purchases_invoices')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="purchases" data-parent="#accordionExample">
                    <li>
                        <a class="text-white" href="{{route('dashboard.purchases.index')}}">  @lang('site.all_invoices') </a>
                    </li>
                    <li>
                        <a class="text-white" href="{{route('dashboard.purchases.create')}}">  @lang('site.add_invoice') </a>
                    </li>

                </ul>
            </li>


            <li class="menu">
                <a href="#suppliers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span>@lang('site.suppliers')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="suppliers" data-parent="#accordionExample">
                    <li>
                        <a class="text-white" href="{{route('dashboard.suppliers.index')}}">  @lang('site.all_suppliers') </a>
                    </li>
                    <li>
                        <a class="text-white" href="{{route('dashboard.suppliers.create')}}">  @lang('site.add_supplier') </a>
                    </li>

                </ul>
            </li>

            {{-- sales management  --}}
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
                        <a class="text-white" href="{{route('dashboard.sales.index')}}"> @lang('site.invoices') </a>
                    </li>
                    <li class="{{is_active('invoices')}}">
                        <a class="text-white" href="{{route('dashboard.sales.create')}}"> @lang('site.create_invoice') </a>
                    </li>
                    <li class="{{is_active('invoices')}}">
                        <a class="text-white" href="{{route('dashboard.quotations.index')}}"> @lang('site.quotatiions') </a>
                    </li>
                    <li class="{{is_active('invoices')}}">
                        <a class="text-white" href="{{route('dashboard.quotations.create')}}"> @lang('site.create_offer_price') </a>
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

            {{-- Inventory Management --}}

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>@lang('site.inventory_management')</span>
                </div>
            </li>




            <li class="menu {{ menu_active('stores') }}">
                <a href="#stores" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span>@lang('site.inventory_definitions')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>

                <ul class="collapse submenu list-unstyled {{ menu_show('stores') }}" id="stores" data-parent="#accordionExample">
                    <li class="{{ is_active('brands') }}">
                        <a class="text-white" href="{{route('dashboard.stores.brands.index')}}">  @lang('site.brands')</a>
                    </li>
                    <li class="{{ is_active('categories') }}">
                        <a class="text-white" href="{{route('dashboard.stores.categories.index')}}"> @lang('site.categories') </a>
                    </li>
                    <li class="{{ is_active('units') }}">
                        <a class="text-white" href="{{route('dashboard.stores.units.index')}}"> @lang('site.units') </a>
                    </li>
                    <li class="{{ is_active('items') }}">
                        <a class="text-white" href="{{route('dashboard.stores.items.index')}}"> @lang('site.products') </a>
                    </li>
                    <li class="{{ is_active('stores') }}">
                        <a class="text-white" href="{{route('dashboard.stores.stores.index')}}"> @lang('site.stores') </a>
                    </li>
                    <li  class="{{ is_active('tags') }}">
                        <a class="text-white" href="{{route('dashboard.stores.tags.index')}}">  @lang('site.tags') </a>
                    </li>
                    <li class="{{ is_active('priceList') }}">
                        <a class="text-white" href="{{route('dashboard.stores.priceList.index')}}"> @lang('site.price_list') </a>
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

                    <li class="{{is_active('journals')}}">
                        <a class="text-white" href="{{route('dashboard.journals.index')}}"> @lang('site.journal entries')</a>
                    </li>
                    <li class="{{is_active('finSettings')}}">
                        <a class="text-white" href="{{route('dashboard.finSettings.index')}}"> @lang('site.settings')</a>
                    </li>

                </ul>
            </li>


             {{-- HR Management --}}

             <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>@lang('site.hr_management')</span>
                </div>
            </li>




            <li class="menu">
                <a href="#hrm" data-toggle="collapse" aria-expanded="{{is_true(['employees','departments','attendances','rewards','employeeFiles','medicals'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span>@lang('site.hrm')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['employees','departments','attendances','rewards','employeeFiles','medicals'])}}" id="hrm" data-parent="#accordionExample" >
                    <li class="{{is_active('departments')}}">
                        <a class="text-white" href="{{route('dashboard.departments.index')}}">  @lang('site.departments') </a>
                    </li>
                    <li class="{{is_active('employees')}}">
                        <a class="text-white" href="{{route('dashboard.employees.index')}}">  @lang('site.employee') </a>
                    </li>
                    <li class="{{is_active('employeeFiles')}}">
                        <a class="text-white" href="{{route('dashboard.employeeFiles.index')}}">  @lang('site.employeeFiles') </a>
                    </li>

                    <li class="{{is_active('attendances')}}">
                        <a class="text-white" href="{{route('dashboard.attendances.index')}}">  @lang('site.attendances') </a>
                    </li>
                    <li class="{{is_active('rewards')}}">
                        <a class="text-white" href="{{route('dashboard.rewards.index')}}">  @lang('site.rewards') </a>
                    </li>

                    <li class="{{is_active('medicals')}}">
                        <a class="text-white" href="{{route('dashboard.medicals.index')}}">  @lang('site.medicals') </a>
                    </li>


                </ul>
            </li>

            <li class="menu">
                <a href="#payroll" data-toggle="collapse" aria-expanded="{{is_true(['salaryTypes','salarySetups'])}}" class="dropdown-toggle text-white">



                     <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                        <span> @lang('site.payroll')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>

                </a>
                <ul class="collapse submenu list-unstyled {{is_show(['salaryTypes','salarySetups'])}}" id="payroll" data-parent="#accordionExample">
                    <li class="{{is_active('salaryTypes')}}">
                        <a href="{{route('dashboard.salaryTypes.index')}}">   @lang('site.salary_type') </a>
                    </li>
                    <li class="{{is_active('salarySetups')}}">
                        <a href="{{route('dashboard.salarySetups.index')}}">   @lang('site.salary_setup') </a>
                    </li>

                </ul>
            </li>
            <li class="menu">
                <a href="{{route('dashboard.tickets.index')}}"  aria-expanded="{{is_true(['tickets'])}}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>                        <span>@lang('site.tickets')</span>
                    </div>

                </a>

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
                <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                        <span>{{ $current_lang == 'ar'  ? ' المستخدمين' :'Users'}}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('dashboard.users.all')}}"> {{ $current_lang == 'ar'  ? ' قائمة المستخدمين' :'List Users'}} </a>
                    </li>
                    <li>
                        <a href="{{route('dashboard.users.create')}}"> {{ $current_lang == 'ar'  ? ' اضافة مستخدم' :'Add User'}} </a>
                    </li>

                </ul>
            </li>

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
                        <a href="{{route('dashboard.settings.general')}}">@lang('site.general') </a>
                    </li>

                    <li class="{{is_active('tax')}}">
                        <a href="{{route('dashboard.tax.index')}}">@lang('site.tax') </a>
                    </li>


                </ul>
            </li>




        </ul>

    </nav>

</div>
