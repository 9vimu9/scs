<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Validator::extend('is_same_thing_twice_on_list', function($attribute, $value, $parameters, $validator) {
        // $table = array_get($this->data, $parameters[0]);
        // $column1 = array_get($this->data, $parameters[1]);
        // $value1 = array_get($this->data, $parameters[2]);
        // $column2 = array_get($this->data, $parameters[3]);
        // $value2 = array_get($this->data, $parameters[4]);
           
        //     $result=DB::table( $table )->where( $column1,$value1 )->where( $column2,$value2)->get();
        //     if($result->count()==0){
        //         return true;
        //     }
        //         return false;
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
