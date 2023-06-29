<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | Configure the resources (models) you'd like to be available in Runway.
    |
    */

    'resources' => [
        \App\Models\Module::class => [
            'name' => 'Modules',
            'cp_icon' => 'date',
             'blueprint' => 'modules',
        ],
        \App\Models\Topic::class => [
            'name' => 'Topics',
            'cp_icon' => 'date',
            'blueprint' => [
                'tabs' => [
                    'main' => [
                        'fields' => [
                            [
                                'handle' => 'title',
                                'field' => [
                                    'type' => 'text',
                                    'validate' => 'required',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        \App\Models\Slide::class => [
            'name' => 'Slides',
            'cp_icon' => 'date',
            'blueprint' => [
                'tabs' => [
                    'main' => [
                        'fields' => [
                            [
                                'handle' => 'title',
                                'field' => [
                                    'type' => 'text',
                                    'validate' => 'required',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        // \App\Models\Order::class => [
        //     'name' => 'Orders',

        //     'blueprint' => [
        //         'tabs' => [
        //             'main' => [
        //                 'fields' => [
        //                     [
        //                         'handle' => 'price',
        //                         'field' => [
        //                             'type' => 'number',
        //                             'validate' => 'required',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Disable Migrations?
    |--------------------------------------------------------------------------
    |
    | Should Runway's migrations be disabled?
    | (eg. not automatically run when you next vendor:publish)
    |
    */

    'disable_migrations' => false,

];
