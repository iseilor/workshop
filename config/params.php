<?php

use kartik\icons\Icon;

return [
    'icon-framework' => Icon::FAS,
    'adminEmail' => '',
    'supportEmail' => ['aleksey.obedkin@rt.ru'],
    'senderEmail' => 'hr.center@rt.ru',
    'senderName' => 'HR.CENTER.RT.RU',
    'user.passwordResetTokenExpire' => 3600,

    //'bsDependencyEnabled' => false, // Для Kartic не грузим Bootstrap
    'bsVersion' => '4.x',

    // Шаблон поля для прикрепления файлов
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
            'icon' => '<i class="fas fa-paper-plane"></i>',
        ],
        'save' => [
            'icon' => '<i class="fas fa-save nav-icon"></i>',
        ],
        'email' => [
            'icon' => '<i class="fas fa-envelope"></i>',
        ],
        'user' => [
            'icon' => '<i class="fas fa-user"></i>',
        ],
    ],
    'file' => [
        'img' => [
            'extensions' => 'jpg,jpeg,png,bmp',
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
                'icon' => '<i class="fas fa-percent nav-icon"></i>',
            ],
            'zaim' => [
                'icon' => '<i class="fas fa-wallet nav-icon"></i>',
            ],
            'doc' => [
                'filePath' => 'files/jk/doc/',
                'icon' => '<i class="fas fa-file-word nav-icon"></i>',
            ],
            'faq' => [
                'icon' => '<i class="fas fa-question nav-icon"></i>',
            ],
            'min' => [
                'icon' => '<i class="fas fa-wallet nav-icon"></i>',
            ],
        ],
        'user' => [
            'icon' => '<i class="fas fa-home"></i>',
            'icon2' => '<i class="fas fa-users"></i>',
            'path' => 'files/user/',
            'photo' => [
                'path' => 'files/user/photo/',
                'default' => '0.jpg',
            ],
            'passport' => [
                'path' => 'files/user/passport/',
                'icon' => '<i class="far fa-address-card"></i>',
            ],
            'snils' => [
                'path' => 'files/user/snils/',
                'icon' => '<i class="far fa-address-card"></i>',
            ],
        ],
        'child' => [
            'filePath' => 'files/child/',
        ],
        'spouse' => [
            'filePath' => 'files/spouse/',
        ],
        'admin' => [
            'icon' => '<i class="fas fa-home"></i>',
            'ad' => [
                'icon' => '<i class="fas fa-ad"></i>',
            ],
            'user-social' => [
                'icon' => '<i class="fas fa-users"></i>',
            ],
        ],
        'main' => [
            'icon' => '<i class="fas fa-home"></i>',
        ],
        'chat' => [
            'icon' => '<i class="fas fa-comments"></i>',
        ],
        'news' => [
            'iconClass' => 'newspaper',
            'icon' => '<i class="fas fa-newspaper"></i>',
            'path' => 'files/news/',
        ],

        // Нештатные ситуации
        'ns' => [
            'iconClass' => 'bell',
        ],

    ],

    //----------------------------------------------------------------------------------------------
    'widget' => [
        'MaskedInput' => [
            // Параметры для денежных полей
            'clientOptionsMoney' => [
                'rightAlign' => false,
                'alias' => 'decimal',
                'digits' => 2,
                'digitsOptional' => true,
                'radixPoint' => ',',
                'groupSeparator' => ' ',
                'autoGroup' => true,
                'removeMaskOnSubmit' => true, // Убираем пробелы перещ SUBMIT
            ],
            // Параметры для денежных полей
            'clientOptionsPercent' => [
                'max'=>100,
                'min'=>0,
                'rightAlign' => false,
                'alias' => 'decimal',
                'digits' => 2,
                'digitsOptional' => true,
                'radixPoint' => ',',
                'groupSeparator' => ' ',
                'autoGroup' => true,
                'removeMaskOnSubmit' => true,
            ],

        ],
    ],
    'card' => [
        'header' => [
            'tools' => '<div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                       </div>',
        ],
    ],
];