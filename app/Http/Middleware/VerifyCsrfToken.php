<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "superAdmin/check-current-password",
        "admin/check-current-password",
        'superAdmin/update-category-status',
        'superAdmin/update-testimonial-status',
        'superAdmin/update-banner-status',
        'update-cart-item-quantity',
        'call-waiter',
        'admin/daily_report',
        '/admin/monthly_report',
        'search-post',
        // 'admin/ajax-food-table'
        '/admin/update-post-status',
    ];
}
