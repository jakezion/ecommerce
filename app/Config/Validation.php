<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
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
        \App\Validation\ClientRules::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $register = [
        'username' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'A username must be entered.',
                'max_length' => 'The username must be entered cannot be longer than 255 characters.'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email|max_length[255]|is_unique[account.email]',
            'errors' => [
                'required' => 'An email must be entered.',
                'valid_email' => 'The email entered must be a valid email address.',
                'max_length' => 'The email entered cannot be longer than 255 characters.',
                'is_unique' => 'The email entered is already linked to an account'
            ]
        ],
        'phone' => [
            'rules' => 'required|exact_length[10]|numeric|is_unique[account.phone]',
            'errors' => [
                'required' => 'A phone number must be entered.',
                'exact_length' => 'The phone number entered must be exactly 10 digits.',
                'numeric' => 'The phone number entered can only contain numbers.',
                'is_unique' => 'The phone number entered is already linked to an account'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[4]',
            'errors' => [
                'required' => 'A password must be entered.',
                'min_length' => 'The password entered must be at least 4 characters.',
            ]
        ]
    ];

//        'password_confirm' => [
//            'required' => 'A password must be entered.',
//            'min_length' => 'The password entered must be at least 8 characters.'
//        ]


    public $login = [
        'phone' => [
            'rules' => 'required|exact_length[10]|numeric',
            'errors' => [
                'required' => 'A phone number must be entered.',
                'exact_length' => 'The phone number entered must be exactly 10 digits.',
                'numeric' => 'The phone number entered can only contain numbers.'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[4]|validate_client[phone,password]',
            'errors' => [
                'required' => 'A password must be entered.',
                'min_length' => 'The password entered must be at least 4 characters.',
                'validate_client' => 'The phone number or password is incorrect.'
            ]
        ]
    ];

}
