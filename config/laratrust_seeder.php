<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'finAccount' => 'c,r,u,d',
            'finJournal' => 'c,r,u,d',
            'finSetting' => 'c,r,u,d',


        ],
        'admin' => [

        ],
        'company_user' => [


        ],
        'company' => [

        ],
    ],
    'permission_structure' => [

    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
