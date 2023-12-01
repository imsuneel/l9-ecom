<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
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
        $this->setStringMacros();
    }

    /**
     * Define all macros for String.
     *
     * @return void
     */
    public function setStringMacros()
    {
        /**
         * @param  string|int|array|null  $string
         * @param  bool  $unique
         * @param  bool  $removeZero
         * @return array|null
         */
        Str::macro('snap', function (string|int|array|null $string, bool $unique = true, bool $removeZero = true) {
            if ($string) {
                $values = is_array($string) ? $string : explode(',', $string);
                $values = array_map('trim', $values);

                if ($removeZero) {
                    $values = array_filter($values);
                } else {
                    $values = array_filter($values, fn ($value) => (! is_null($value) && $value !== '') || $value == '0');
                }

                if ($unique) {
                    $values = array_unique($values);
                }

                $values = Arr::map($values, function ($value) {
                    return is_numeric($value) ? $value + 0 : $value;
                });

                return count($values) ? array_values($values) : null;
            }

            return null;
        });
    }
}
