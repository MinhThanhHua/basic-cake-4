<?php
/** ==================== PATH ==================== */

/** ==================== Common ==================== */
const OWASP_ZAP_TEST = false;
const DEFAULT_LIMIT_PAGINATE = 25;
const LIST_OPTION_PAGINATE = [
    25,
    50,
    100
];
const USER_ROLE = [
    1 => 'Admin',
    2 => 'User'
];
const CONFIG_FOR_ONCE_PAGE = [
    'Web/index' => [
        'title' => 'Top'
    ],
    'Account/index' => [
        'title' => 'Admin Account',
        'css' => [
            'ticket-list-2.css',
            'datatables.min.css',
        ],
        'js' => null
    ]
];
const JS_DEFAULT_COMMON = [
    'jquery.min.js',
    'datatables.min.js'
];
const CSS_DEFAULT_COMMON = [
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css',
    'common.css',
    'custom.css'
];

/** =============== Validate message ================== */
const MSG_LOGIN_FAILED = 'メールアドレスまたはパスワードが間違っています。';
const MSG_LOGIN_ON_ONE_BROWSER = '認証に失敗しました。';

/** =============== Session ================== */
const SUCCESS_DATA_INPUT = 'msg_success';
const MIDDLEWARE_MESSAGE_FLASH = 'middleware_msg';
