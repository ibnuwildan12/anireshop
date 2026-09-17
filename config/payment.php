<?php

return [

    'bank' => [
        'name' => env('PAYMENT_BANK_NAME', 'BRI'),
        'account_name' => env(
            'PAYMENT_BANK_ACCOUNT_NAME',
            'Anireshop'
        ),
        'account_number' => env(
            'PAYMENT_BANK_ACCOUNT_NUMBER',
            ''
        ),
    ],

];