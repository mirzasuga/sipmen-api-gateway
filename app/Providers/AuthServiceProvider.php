<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Vendor\RoleVendor as Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    // protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        // dd(config('scopes'));
        Passport::tokensCan(config('scopes.tokensCan'));
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));

        $this->defineBranchPolicy();
        $this->defineVehiclePolicy();
        $this->defineBookingPolicy();
        $this->defineStaffPolicy();

    }

    private function defineBranchPolicy() {
        Gate::define('branch.create', 'App\Policies\BranchPolicy@create');
        Gate::define('branch.getList', 'App\Policies\BranchPolicy@getList');
    }

    private function defineVehiclePolicy() {
        Gate::define('vehicle.create', 'App\Policies\VehiclePolicy@create');
    }

    private function defineBookingPolicy() {
        Gate::define('booking.getList', 'App\Policies\BookingPolicy@getList');
    }
    private function defineStaffPolicy() {
        Gate::define('staff.getList', 'App\Policies\StaffPolicy@getList');
    }

}
