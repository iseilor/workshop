<?php

return [
    'adminEmail' => '',
    'supportEmail' => ['obedkinav@ya.ru'],
    'senderEmail' => 'workshop@rt.ru',
    'senderName' => 'WORKSHOP',
    'user.passwordResetTokenExpire' => 3600,
    'ad' => [
        'account_suffix' => '',
        'hosts' => [],
        'base_dn' => '',
        'username' => '',
        'password' => '',
        'port' => 0,
    ],
    'btn' => [
        'send' => [
            'icon' => '<i class="fas fa-paper-plane"></i>'
        ],
        'save' => [
            'icon' => '<i class="fas fa-save nav-icon"></i>'
        ],
        'email' => [
            'icon' => '<i class="fas fa-envelope"></i>'
        ],
        'user' => [
            'icon' => '<i class="fas fa-user"></i>'
        ]
    ],
    'file'=>[
        'img'=>[
            'extensions'=>'jpg,jpeg,png,bmp'
        ],
    ],

    'module' => [
        'jk' => [
            'icon' => '<i class="fas fa-home"></i>',
            'order' => [
                'icon' => '<i class="fas fa-ruble-sign nav-icon"></i>',
                'filePath' => 'files/jk/order/',
            ],
            'percent' => [
                'icon' => '<i class="fas fa-percent nav-icon"></i>'
            ],
            'zaim' => [
                'icon' => '<i class="fas fa-wallet nav-icon"></i>'
            ],
            'doc' => [
                'filePath' => 'files/jk/doc/',
                'icon' => '<i class="fas fa-file-word nav-icon"></i>'
            ],
            'faq' => [
                'icon' => '<i class="fas fa-question nav-icon"></i>'
            ],
            'min' => [
                'icon' => '<i class="fas fa-wallet nav-icon"></i>'
            ]
        ],
        'user' => [
            'icon' => '<i class="fas fa-home"></i>',
            'icon2' => '<i class="fas fa-users"></i>',
            'photo' => [
                'path' => 'files/user/photo/',
                'default' => '0.jpg'
            ],
            'passport' => [
                'path' => 'files/user/passport/',
                'icon' => '<i class="far fa-address-card"></i>',
            ],
            'snils' => [
                'path' => 'files/user/snils/',
                'icon' => '<i class="far fa-address-card"></i>'
            ],
        ],
        'admin' => [
            'icon' => '<i class="fas fa-home"></i>',
            'ad' => [
                'icon' => '<i class="fas fa-ad"></i>'
            ],
            'user-social' => [
                'icon' => '<i class="fas fa-users"></i>'
            ],
        ],
        'main' => [
            'icon' => '<i class="fas fa-home"></i>'
        ],
        'chat' => [
            'icon' => '<i class="fas fa-comments"></i>'
        ],
        'news'=>[
            'icon'=>'<i class="fas fa-bullhorn"></i>',
            'path'=>'files/news/'
        ]
    ]
];