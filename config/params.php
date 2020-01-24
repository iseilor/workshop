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
        'save' => [
            'icon' => '<i class="fas fa-save nav-icon"></i>'
        ]
    ],
    'module' => [
        'jk' => [
            'icon' => '<i class="fas fa-home"></i>',
            'order' => [
                'icon' => '<i class="fas fa-ruble-sign nav-icon"></i>'
            ],
            'percent' => [
                'icon' => '<i class="fas fa-ruble-sign nav-icon"></i>'
            ],
            'zaim' => [
                'icon' => '<i class="fas fa-ruble-sign nav-icon"></i>'
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
            'icon2'=> '<i class="fas fa-users"></i>',
            'photoPath' => 'files/user/photo/',
            'photoDefault' => 'files/user/photo/0.jpg'
        ],
        'admin' => [
            'icon' => '<i class="fas fa-home"></i>'
        ],
        'main' => [
            'icon' => '<i class="fas fa-home"></i>'
        ]
    ]
];