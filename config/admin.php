<?php
/* Configuration file to create admin users */

return [
    'email' => env('ADMIN_EMAIL', 'admin@uwindsor.ca'),
    'password' => env('ADMIN_PASSWORD', 'password'),
    'phone' => env('ADMIN_PHONE', null), // Optional 
];