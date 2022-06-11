<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_numeric_spaces', function ($attribute, $value, $parameters, $validator) {
            $value = trim($value);
            return preg_match("/^[a-zA-Z0-9\s]+$/",$value);
        });
        
        Validator::extend('alpha_spaces', function ($attribute, $value, $parameters, $validator) {
            $value = trim($value);
            // return preg_match('/^[\pL\s]+$/u', $value);
            return preg_match("/^[a-zA-Z\s]+$/",$value);
        });

        Validator::extend('alpha_numeric_with_special_chars', function ($attribute, $value, $parameters, $validator) {
            $value = trim($value);
            return preg_match("/[A-Za-z0-9]+[0-9]?+[0-9 .,'@#_-|?:*()&%!&\[\]\s]?$/",$value);
        });

        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            $value = trim($value);
            return preg_match('/[0-9 -]/', $value); // && strlen($value) >= 10
            //return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?) {0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value); // && strlen($value) >= 10
        });

        Validator::extend('custom_valid_date', function ($attribute, $value, $parameters, $validator) {
            // if(!empty($value) && !empty($parameters[0])) {
            if(!empty($value)) {
                try {
                    $form_data = implode('-', explode('/', $value));
                    Carbon::parse($form_data);
                    return true;
                } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                    return false;
                }
                // $value = __dbDateCustomConvert($form_data);
            }
            return true;
        });
    }
}
