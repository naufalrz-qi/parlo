<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }
    public function boot()
    {
        View::composer('*', function ($view) {
            $layout = 'layouts.app'; // Default layout

            if (Auth::check()) {
                switch (Auth::user()->role) {
                    case 'admin':
                        $layout = 'admin.layouts.app';
                        break;
                    case 'employee':
                        $layout = 'employee.layouts.app';
                        break;
                    case 'user':
                        $layout = 'user.layouts.app';
                        break;
                }
            }

            $view->with('layout', $layout);
        });
    }


}
