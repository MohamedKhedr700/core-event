<?php

use Raid\Core\Models\Authentication\Enum\LoginType;

return [

    /*
    |--------------------------------------------------------------------------
    | Login Managers
    |--------------------------------------------------------------------------
    |
    | Here you can define the login managers that will be used in the application.
    |
    */

    'managers' => [
        'managers' => [
            LoginType::DEVICE => [
                \Raid\Core\Authentication\Login\DeviceLogin\Manager\DeviceIdLoginManager::class,
            ],
            LoginType::SYSTEM => [
                \Raid\Core\Authentication\Login\SystemLogin\Manager\EmailLoginManager::class,
                \Raid\Core\Authentication\Login\SystemLogin\Manager\PhoneLoginManager::class,
                \Raid\Core\Authentication\Login\SystemLogin\Manager\EmailOrPhoneLoginManager::class,
            ],
        ],
    ],
];
