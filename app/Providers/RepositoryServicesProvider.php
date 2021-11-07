<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\UserInterface',
            'App\Http\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\AuthInterface',
            'App\Http\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\RoleInterface',
            'App\Http\Repositories\RoleRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\ParentCompanyInterface',
            'App\Http\Repositories\ParentCompanyRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\CustomerGroupInterface',
            'App\Http\Repositories\CustomerGroupRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\CustomerInterface',
            'App\Http\Repositories\CustomerRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Purchases\SupplierInterface',
            'App\Http\Repositories\Purchases\SupplierRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\ContactInterface',
            'App\Http\Repositories\ContactRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\BankInfoInterface',
            'App\Http\Repositories\BankInfoRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Hr\DepartmentInterface',
            'App\Http\Repositories\Hr\DepartmentRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Tickets\TicketInterface',
            'App\Http\Repositories\Tickets\TicketRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Stores\StoBrandInterface',
            'App\Http\Repositories\Stores\StoBrandRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Stores\StoCategoryInterface',
            'App\Http\Repositories\Stores\StoCategoryRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Stores\StoUnitInterface',
            'App\Http\Repositories\Stores\StoUnitRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Stores\StoStoreInterface',
            'App\Http\Repositories\Stores\StoStoreRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Stores\StoItemInterface',
            'App\Http\Repositories\Stores\StoItemRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Finance\FinAccountInterface',
            'App\Http\Repositories\Finance\FinAccountRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Finance\FinJournalInterface',
            'App\Http\Repositories\Finance\FinJournalRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Finance\FinSettingInterface',
            'App\Http\Repositories\Finance\FinSettingRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Purchases\BuyPurchaseInvoiceInterface',
            'App\Http\Repositories\Purchases\BuyPurchaseInvoiceRepository'
        );




    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
