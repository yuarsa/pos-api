<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\UserRepository;
use App\Repositories\Auth\OauthAccessTokenRepository;
use App\Repositories\Master\CompanyRepository;
use App\Repositories\Master\OutletRepository;
use App\Repositories\Master\CustomerRepository;
use App\Repositories\Reference\BusinessUnitRepository;
use App\Repositories\Reference\ProvinceRepository;
use App\Repositories\Reference\RegionRepository;
use App\Repositories\Master\SupplierRepository;
use App\Repositories\Master\TaxRepository;
use App\Repositories\Master\ProductMerkRepository;
use App\Repositories\Master\ProductCategoryRepository;
use App\Repositories\Master\ProductRepository;
use App\Repositories\Master\ProductVarianRepository;
use App\Repositories\Master\EmployeeRepository;
use App\Repositories\Master\VarianRepository;
use App\Repositories\Master\VarianValueRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Transaction\TransactionDetailRepository;
use App\Repositories\Reference\PaymentTermRepository;
use App\Repositories\Transaction\PurchaseOrderRepository;
use App\Repositories\Transaction\PurchaseOrderDetailRepository;
use App\Repositories\Transaction\ReceivedOrderRepository;
use App\Repositories\Transaction\ReceivedOrderDetailRepository;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\Transaction\SaleOrderRepository;
use App\Repositories\Transaction\SaleOrderDetailRepository;

use App\Repositories\Master\ProductWholesalerRepository;
use App\Repositories\Master\MarketplaceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Contracts\Auth\UserContract', UserRepository::class);
        $this->app->bind('App\Contracts\Auth\OauthAccessTokenContract', OauthAccessTokenRepository::class);
        $this->app->bind('App\Contracts\Master\CompanyContract', CompanyRepository::class);
        $this->app->bind('App\Contracts\Master\OutletContract', OutletRepository::class);
        $this->app->bind('App\Contracts\Master\CustomerContract', CustomerRepository::class);
        $this->app->bind('App\Contracts\Master\SupplierContract', SupplierRepository::class);
        $this->app->bind('App\Contracts\Master\TaxContract', TaxRepository::class);
        $this->app->bind('App\Contracts\Master\ProductMerkContract', ProductMerkRepository::class);
        $this->app->bind('App\Contracts\Master\ProductCategoryContract', ProductCategoryRepository::class);
        $this->app->bind('App\Contracts\Master\ProductContract', ProductRepository::class);
        $this->app->bind('App\Contracts\Master\ProductVarianContract',ProductVarianRepository::class);
        $this->app->bind('App\Contracts\Master\ProductWholesalerContract', ProductWholesalerRepository::class);
        $this->app->bind('App\Contracts\Master\EmployeeContract', EmployeeRepository::class);
        $this->app->bind('App\Contracts\Master\VarianContract', VarianRepository::class);
        $this->app->bind('App\Contracts\Master\VarianValueContract', VarianValueRepository::class);
        $this->app->bind('App\Contracts\Master\MarketplaceContract', MarketplaceRepository::class);

        $this->app->bind('App\Contracts\Reference\BusinessUnitContract', BusinessUnitRepository::class);
        $this->app->bind('App\Contracts\Reference\ProvinceContract', ProvinceRepository::class);
        $this->app->bind('App\Contracts\Reference\RegionContract', RegionRepository::class);
        $this->app->bind('App\Contracts\Reference\PaymentTermContract', PaymentTermRepository::class);

        $this->app->bind('App\Contracts\Transaction\TransactionContract', TransactionRepository::class);
        $this->app->bind('App\Contracts\Transaction\TransactionDetailContract', TransactionDetailRepository::class);
        $this->app->bind('App\Contracts\Transaction\PurchaseOrderContract', PurchaseOrderRepository::class);
        $this->app->bind('App\Contracts\Transaction\PurchaseOrderDetailContract', PurchaseOrderDetailRepository::class);
        $this->app->bind('App\Contracts\Transaction\ReceivedOrderContract', ReceivedOrderRepository::class);
        $this->app->bind('App\Contracts\Transaction\ReceivedOrderDetailContract', ReceivedOrderDetailRepository::class);
        $this->app->bind('App\Contracts\Transaction\SaleOrderContract', SaleOrderRepository::class);
        $this->app->bind('App\Contracts\Transaction\SaleOrderDetailContract', SaleOrderDetailRepository::class);

        $this->app->bind('App\Contracts\Dashboard\DashboardContract', DashboardRepository::class);

    }
}
