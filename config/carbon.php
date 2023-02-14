<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Carbon Locale e Timezone
    |--------------------------------------------------------------------------
    |
    | criado por Drylian com o objetivo de deixar o tempo em portugues,
    | este arquivo serve apenas para esse proposito.
    | 
    */

    'timezone' => env('APP_TIMEZONE', 'Brazil/Brasilia'),
    'locale' => env('LINGUA_TIMEZONE', 'pt_BR'),
    'fallback_locale' => 'pt_BR',
    
    
    'aliases' => Facade::defaultAliases()->merge([
        'Carbon' => Carbon\Carbon::class,
    ])->toArray(),
];
