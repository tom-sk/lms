<?php

use App\Models\Module;
use App\Models\Onboard\Question;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Topic;

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
        Module::class => [
            'name' => 'Modules',
            'cp_icon' => 'date',
            'blueprint' => 'modules',
        ],
        Topic::class => [
            'name' => 'Topics',
            'cp_icon' => 'date',
            'blueprint' => 'topics',
        ],
        Slide::class => [
            'name' => 'Slides',
            'cp_icon' => 'date',
            'blueprint' => 'slides',
        ],
        Question::class => [
            'name' => 'Questions',
            'cp_icon' => 'date',
            'blueprint' => 'questions',
        ],
        Product::class => [
            'name' => 'Products',
            'cp_icon' => 'date',
            'blueprint' => 'products'
        ]
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
