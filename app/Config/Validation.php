<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use Config\CustomRules;

class Validation extends BaseConfig
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $login = [
        'user_email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email',
        ],
        'user_password' => [
            'label' => 'Kata Sandi',
            'rules' => 'required',
        ],
        'g-recaptcha-response' => [
            'label' => 'reCaptcha',
            'rules' => 'required|verify_recaptcha',
            'errors' => [
                'verify_recaptcha' => 'Gagal verifikasi reCaptcha google!'
            ]
        ]
    ];
    public $forgetPassword = [
        'user_email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email',
        ],
        'g-recaptcha-response' => [
            'label' => 'reCaptcha',
            'rules' => 'required|verify_recaptcha',
            'errors' => [
                'verify_recaptcha' => 'Gagal verifikasi reCaptcha google!'
            ]
        ]
    ];
    public $resetPassword = [
        'user_password' => [
            'label' => 'Kata Sandi',
            'rules' => 'required|min_length[6]',
        ],
        'password_verify' => [
            'label' => 'Verifikasi Kata Sandi',
            'rules' => 'required|matches[user_password]',
            'errors' => [
                'matches'  => 'Kata Sandi Harus Sama!'
            ]
        ],
        'g-recaptcha-response' => [
            'label' => 'reCaptcha',
            'rules' => 'required|verify_recaptcha',
            'errors' => [
                'verify_recaptcha' => 'Gagal verifikasi reCaptcha google!'
            ]
        ]
    ];
}
