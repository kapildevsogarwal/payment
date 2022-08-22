<?php

namespace App\Mixins;


use Carbon\Carbon;

class StrMixin
{
    
    /**
     * @return \Closure
     */
    public function appDateFormat()
    {
        return function($dateTime) {
            // return $dateTime;
            return Carbon::parse($dateTime)->format(config('constant.date_format'));
        };
    }

    /**
     * @return \Closure
     */
    public function isLength()
    {
        return function($str, $length) {
            return static::length($str) == $length;
        };
    }

    /**
     * @return \Closure
     */
    public function appendTo()
    {
        return function($str, $char) {
            return $char.$str;
        };
    }
}