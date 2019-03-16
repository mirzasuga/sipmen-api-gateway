<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\VendorRegistered;
use App\Listeners\VendorRegisteredListener;
use App\Events\VendorDetailCreated;
use App\Listeners\AttachVendorDetailToVendorUser;
use App\Listeners\AttachRoleToVendorUser;
use App\Events\VendorStaffCreated;
use App\Listeners\VendorStaffSetPasswordSendMail;
use App\Events\ResiCreated;
use App\Listeners\SendEmailResiToPenerima;
use App\Listeners\InitialShippingStatus;
use App\Events\ShippingStatusUpdated;
use App\Listeners\NotifyShippingStatus;
use App\Events\QueueShippingStatus;
use App\Listeners\AttachShippingStatus;
use App\Events\ResiAttachedToSuratJalan;
use App\Events\SuratJalanOnTheWayWarehouse;
use App\Listeners\BulkUpdateShippingStatus;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VendorRegistered::class => [
            VendorRegisteredListener::class
        ],
        VendorDetailCreated::class => [
            AttachVendorDetailToVendorUser::class,
            AttachRoleToVendorUser::class
        ],
        VendorStaffCreated::class => [
            AttachRoleToVendorUser::class,
            AttachVendorDetailToVendorUser::class,
            VendorStaffSetPasswordSendMail::class
        ],
        ResiCreated::class => [
            SendEmailResiToPenerima::class,
            InitialShippingStatus::class
        ],
        ShippingStatusUpdated::class => [
            NotifyShippingStatus::class
        ],
        QueueShippingStatus::class => [
            AttachShippingStatus::class
        ],
        ResiAttachedToSuratJalan::class => [
            AttachShippingStatus::class
        ],
        SuratJalanOnTheWayWarehouse::class => [
            BulkUpdateShippingStatus::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
