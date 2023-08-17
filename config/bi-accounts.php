<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    |
    */
    'table' => env('ACCOUNT_TABLE', 'accounts'),

    /*
    |--------------------------------------------------------------------------
    | Address model
    |--------------------------------------------------------------------------
    |
    | You can create your own methods by extending this \NRB\Address\Address
    | class and this with your full class name.
    |
    */
    'model' => \Bi\Users\Account::class,
];
