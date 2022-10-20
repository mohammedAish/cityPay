<?php

return [
    'default_currency_id'  => 1,//USD $
    'country_id'           => 247,//for YEMEN in DB is 247
    'per_page'             => 10,//USD $
    'transfer'             => [
        'commission' => 0.09,
    ], 'pay_order'         => [
        'commission' => 0.07,
    ],
    'internal_withdraw'    => [
        'fee_percent' => 0.01,
    ],
    'parent_services_ids'  => [
        'wallet_paid'         => 1,
        'digital_card'        => 2,
        'consultants'         => 3,
        'training'            => 4,
        'trading'             => 5,
        'loyalty'             => 6,
        'commissions_tasweeg' => 7,
    ],
    'wallet_user_id'       => 1,
    'wallet_comms_user_id' => 1,
    'max_yt_wallet_codes'  => 100,
    'wallet_services'      => [
        'deposit'           => 1,
        'internal_withdraw' => 2,
        'transfer'          => 3,
    ],
    'all_services'         => [
        'payment_from_net'         => 1,
        'pull_earning'             => 2,
        'tadawul_pay_trans'        => 3,
        'consultants'              => 4,
        'training'                 => 5,
        'cash_pack'                => 6,
        'live_trading'             => 7,
        'recommendations_analysis' => 8,
        'copy_trading'             => 9,
        'loyalty'                  => 10,
        'commissions_tasweeg'      => 11,
        'digital_cards'            => 12,
    ],
    'order_status'         => [
        'ordering'          => 'pending', //after order
        'order_accepted'    => 'accepted', // if admin can pay this product and the customer
        // now must feed him balance by the required amount
        'customer_canceled' => 'order canceled by customer', // canceled by customer
        'admin_rejected'    => 'order rejected from admin', //admin cant accept or bay order
        //after accept by admin the customer must have balance to move to this status
        'in_processing'     => 'order in processing',
        'order_completed'   => 'order completed',// after completing processing
        'canceled_by_admin' => 'order canceled by admin', //during processing maybe admin cancel the order

    ],
    'local_order_status'   => [
        'ordering'          => 'تحت الطلب',
        'pending'           => 'تحت الطلب',
        'order_accepted'    => 'تم قبول الطلب',
        'customer_canceled' => 'تم الالغاء من طرف العميل',
        'admin_rejected'    => 'تم الرفض من قبل الإدارة',
        'in_processing'     => 'يتم معالجة الطلب',
        'order_completed'   => 'تم اكمال الطلب',
        'canceled_by_admin' => 'تم الالغاء من الادارة',
    ],

    'notifications'   => [
        'types'    => [

        ]
        ,
        'contents' => [

            /* 'new_order'                   => [
                 'job'   => 1,
                 'title' => 'هناك طلب جديد',
                 'body'  => 'بامكانك قبول الطلب أو رفضه',
             ],*/


        ],
    ]
    ,
    'deposit_methods' => [
        'cash', 'direct_exchange', 'e_payment',
    ],
    'notifi'          => [
        'sendNewOrder' => 'FCMToAdmin',
    ],


    'accounting' => [
        'voucher_types'   => [
            'reserved'  => 'reserved',
            'confirmed' => 'confirmed',
        ]
        ,
        'statements'      => [
            'transfer_statement'                      => 'اجراء عملية تحويل من حساب الى حساب ',
            'credit_trans_statement'                  => 'لكم جراء عملية تحويل الى حساب',
            'debit_trans_statement'                   => 'عليكم جراء عملية تحويل من حساب',
            'pay_from_wallet_statement'               => 'اجراء عملية دفع عبر المحفظة ',
            'credit_from_wallet_transfer'             => 'لكم من عملية سداد عبر تحويل من محفظة العميل مقابل الاشتراك في خدمة ',
            'collect_commission_from_wallet_transfer' => ' ايراد عمولة من عملية تحويل من محفظة العميل ',
            'deposit_statement'                       => 'لكم من سند قبض بعملية ايداع رقم:  ',
            'withdrawals_statement'                   => 'عليكم من سند صرف بعملية سحب رقم:  ',
        ],
        'account_numbers' => [
            'commission_income' => 3010001, //  حساب ايرادات النشاط الجاري ايرادات عمولات خدمات الاستشارات المدفوعة
            'center_fund'       => 1010001, //حساب الصندوق الرئيسي  //deprecated
        ],
        'acc_groups'      => [
            'customers_groups'     => '201', //مجموعة حساب العملاء- المدينون
            'ex_customers_groups'  => '202', //مجموعة حساب العملاء- المدينون الاجانب
            'banks_exchange_group' => '101',
        ],

        'deposit_types'         => [
            1 => 'cash',
            2 => 'electronic_bank',
            3 => 'bank_deposit',
            4 => 'national_wallets',
            5 => 'bitcoin',
            6 => 'earning_withdrawals',
            7 => 'credit_cards',
            8 => 'trading_accounts',
            9 => 'international_bank',
        ],
        'deposit_types_drivers' => [
            'electronic_bank'        => [
                'ar' => 'الحوالات التي يتم ايداعها عن طريق تحويل من حساب بايبال مثلا',
                'en' => 'deposits from PayPal ect..',
            ], 'bitcoin'             => [
                'ar' => 'الحوالات التي يتم ايداعها عن طريق تحويل من عملة رقمية',
                'en' => 'deposits from Bitcoin ect..',
            ], 'cash'                => [
                'ar' => 'الحوالات التي يتم ايداعها عن طريق تحويل مباشر عبر أي صرافة',
                'en' => 'deposits from Exchanges Agencies ect..',
            ], 'bank_deposit'        => [
                'ar' => 'الحوالات التي يتم ايداعها عن طريق ايداع الى حساب الشركة في أحد البنوك أو محلات الصرافة بطريقة ايداع',
                'en' => 'deposits from banks Or Exchanges Agencies by deposit method ect..',
            ], 'earning_withdrawals' => [
                'ar' => 'الحوالات التي يتم ايداعها عن طريق سحب أرباح من النت لأناس وايداعها في محفظة يمن تداول',
                'en' => 'deposits from by withdrawals earnings and deposit it in YTadawul wallet..',
            ], 'credit_cards'        => [
                'ar' => 'البطائق الائتمانية الايداع عن طريق وسيط خارجي ',
                'en' => 'deposits from by withdrawals earnings and deposit it in YTadawul wallet..',
            ], 'trading_accounts'    => [
                'ar' => 'الايداع عن طريق حسابات التداول  ',
                'en' => 'deposits from by withdrawals earnings and deposit it in YTadawul wallet..',
            ], 'national_wallets'    => [
                'ar' => 'الايداع عن طريق المحافظ المحلية ',
                'en' => 'deposits from by withdrawals earnings and deposit it in YTadawul wallet..',
            ], 'international_bank'  => [
                'ar' => 'الايداع عن طريق البنوك الدولية التي تقبل التحويل من دولة لدولة  ',
                'en' => 'deposits from by withdrawals earnings and deposit it in YTadawul wallet..',
            ],
        ],
        //old report durations
        'start_acc_year'        => Env('START_ACTIVE_YEAR', now()->startOfYear()->toDateTimeString()),
    ],

];
