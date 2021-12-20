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
            'App\Http\Interfaces\Purchases\PurchaseInvoiceInterface',
            'App\Http\Repositories\Purchases\PurchaseInvoiceRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Sales\SalInvoiceInterface',
            'App\Http\Repositories\Sales\SalInvoiceRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Settings\TaxInterface',
            'App\Http\Repositories\Settings\TaxRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Stores\PriceListInterface',
            'App\Http\Repositories\Stores\PriceListRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\HrEmployeeInterface',
            'App\Http\Repositories\Hr\HrEmployeeRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\HrDepartmentInterface',
            'App\Http\Repositories\Hr\HrDepartmentRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\HrAttendanceInterface',
            'App\Http\Repositories\Hr\HrAttendanceRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Hr\HrRewardInterface',
            'App\Http\Repositories\Hr\HrRewardRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Hr\HrEmployeeFileInterface',
            'App\Http\Repositories\Hr\HrEmployeeFileRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\HrMedicalInterface',
            'App\Http\Repositories\Hr\HrMedicalRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Hr\Payroll\HrSalaryTypeInterface',
            'App\Http\Repositories\Hr\Payroll\HrSalaryTypeRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\Payroll\HrSalarySetupInterface',
            'App\Http\Repositories\Hr\Payroll\HrSalarySetupRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\Payroll\HrSalaryGenerateInterface',
            'App\Http\Repositories\Hr\Payroll\HrSalaryGenerateRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\Payroll\HrSalaryEmployeeInterface',
            'App\Http\Repositories\Hr\Payroll\HrSalaryEmployeeRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Hr\HrWorkdayInterface',
            'App\Http\Repositories\Hr\HrWorkdayRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Hr\HrHolidayInterface',
            'App\Http\Repositories\Hr\HrHolidayRepository'
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
