<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'package_managment_access',
            ],
            [
                'id'    => 24,
                'title' => 'book_create',
            ],
            [
                'id'    => 25,
                'title' => 'book_edit',
            ],
            [
                'id'    => 26,
                'title' => 'book_show',
            ],
            [
                'id'    => 27,
                'title' => 'book_delete',
            ],
            [
                'id'    => 28,
                'title' => 'book_access',
            ],
            [
                'id'    => 29,
                'title' => 'video_create',
            ],
            [
                'id'    => 30,
                'title' => 'video_edit',
            ],
            [
                'id'    => 31,
                'title' => 'video_show',
            ],
            [
                'id'    => 32,
                'title' => 'video_delete',
            ],
            [
                'id'    => 33,
                'title' => 'video_access',
            ],
            [
                'id'    => 34,
                'title' => 'client_managment_create',
            ],
            [
                'id'    => 35,
                'title' => 'client_managment_edit',
            ],
            [
                'id'    => 36,
                'title' => 'client_managment_show',
            ],
            [
                'id'    => 37,
                'title' => 'client_managment_delete',
            ],
            [
                'id'    => 38,
                'title' => 'client_managment_access',
            ],
            [
                'id'    => 39,
                'title' => 'package_create',
            ],
            [
                'id'    => 40,
                'title' => 'package_edit',
            ],
            [
                'id'    => 41,
                'title' => 'package_show',
            ],
            [
                'id'    => 42,
                'title' => 'package_delete',
            ],
            [
                'id'    => 43,
                'title' => 'package_access',
            ],
            [
                'id'    => 44,
                'title' => 'real_estate_managment_access',
            ],
            [
                'id'    => 45,
                'title' => 'quote_create',
            ],
            [
                'id'    => 46,
                'title' => 'quote_edit',
            ],
            [
                'id'    => 47,
                'title' => 'quote_show',
            ],
            [
                'id'    => 48,
                'title' => 'quote_delete',
            ],
            [
                'id'    => 49,
                'title' => 'quote_access',
            ],
            [
                'id'    => 50,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => 51,
                'title' => 'country_create',
            ],
            [
                'id'    => 52,
                'title' => 'country_edit',
            ],
            [
                'id'    => 53,
                'title' => 'country_show',
            ],
            [
                'id'    => 54,
                'title' => 'country_delete',
            ],
            [
                'id'    => 55,
                'title' => 'country_access',
            ],
            [
                'id'    => 56,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 57,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 58,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 59,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 60,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 61,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 62,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 63,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 64,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 65,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 66,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 67,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 68,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 69,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 70,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 71,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 72,
                'title' => 'blogs_managment_create',
            ],
            [
                'id'    => 73,
                'title' => 'blogs_managment_edit',
            ],
            [
                'id'    => 74,
                'title' => 'blogs_managment_show',
            ],
            [
                'id'    => 75,
                'title' => 'blogs_managment_delete',
            ],
            [
                'id'    => 76,
                'title' => 'blogs_managment_access',
            ],
            [
                'id'    => 77,
                'title' => 'contact_us_create',
            ],
            [
                'id'    => 78,
                'title' => 'contact_us_edit',
            ],
            [
                'id'    => 79,
                'title' => 'contact_us_show',
            ],
            [
                'id'    => 80,
                'title' => 'contact_us_delete',
            ],
            [
                'id'    => 81,
                'title' => 'contact_us_access',
            ],
            [
                'id'    => 82,
                'title' => 'refugees_lega_managment_access',
            ],
            [
                'id'    => 83,
                'title' => 'refugees_lega_registration_create',
            ],
            [
                'id'    => 84,
                'title' => 'refugees_lega_registration_edit',
            ],
            [
                'id'    => 85,
                'title' => 'refugees_lega_registration_show',
            ],
            [
                'id'    => 86,
                'title' => 'refugees_lega_registration_delete',
            ],
            [
                'id'    => 87,
                'title' => 'refugees_lega_registration_access',
            ],
            [
                'id'    => 88,
                'title' => 'real_estate_registration_create',
            ],
            [
                'id'    => 89,
                'title' => 'real_estate_registration_edit',
            ],
            [
                'id'    => 90,
                'title' => 'real_estate_registration_show',
            ],
            [
                'id'    => 91,
                'title' => 'real_estate_registration_delete',
            ],
            [
                'id'    => 92,
                'title' => 'real_estate_registration_access',
            ],
            [
                'id'    => 93,
                'title' => 'refugees_legal_service_create',
            ],
            [
                'id'    => 94,
                'title' => 'refugees_legal_service_edit',
            ],
            [
                'id'    => 95,
                'title' => 'refugees_legal_service_show',
            ],
            [
                'id'    => 96,
                'title' => 'refugees_legal_service_delete',
            ],
            [
                'id'    => 97,
                'title' => 'refugees_legal_service_access',
            ],
            [
                'id'    => 98,
                'title' => 'consulting_management_access',
            ],
            [
                'id'    => 99,
                'title' => 'consulting_create',
            ],
            [
                'id'    => 100,
                'title' => 'consulting_edit',
            ],
            [
                'id'    => 101,
                'title' => 'consulting_show',
            ],
            [
                'id'    => 102,
                'title' => 'consulting_delete',
            ],
            [
                'id'    => 103,
                'title' => 'consulting_access',
            ],
            [
                'id'    => 104,
                'title' => 'packages_order_create',
            ],
            [
                'id'    => 105,
                'title' => 'packages_order_edit',
            ],
            [
                'id'    => 106,
                'title' => 'packages_order_show',
            ],
            [
                'id'    => 107,
                'title' => 'packages_order_delete',
            ],
            [
                'id'    => 108,
                'title' => 'packages_order_access',
            ],
            [
                'id'    => 109,
                'title' => 'consulting_booking_create',
            ],
            [
                'id'    => 110,
                'title' => 'consulting_booking_edit',
            ],
            [
                'id'    => 111,
                'title' => 'consulting_booking_show',
            ],
            [
                'id'    => 112,
                'title' => 'consulting_booking_delete',
            ],
            [
                'id'    => 113,
                'title' => 'consulting_booking_access',
            ],
            [
                'id'    => 114,
                'title' => 'seminars_managment_access',
            ],
            [
                'id'    => 115,
                'title' => 'seminar_create',
            ],
            [
                'id'    => 116,
                'title' => 'seminar_edit',
            ],
            [
                'id'    => 117,
                'title' => 'seminar_show',
            ],
            [
                'id'    => 118,
                'title' => 'seminar_delete',
            ],
            [
                'id'    => 119,
                'title' => 'seminar_access',
            ],
            [
                'id'    => 120,
                'title' => 'seminars_subscription_create',
            ],
            [
                'id'    => 121,
                'title' => 'seminars_subscription_edit',
            ],
            [
                'id'    => 122,
                'title' => 'seminars_subscription_show',
            ],
            [
                'id'    => 123,
                'title' => 'seminars_subscription_delete',
            ],
            [
                'id'    => 124,
                'title' => 'seminars_subscription_access',
            ],
            [
                'id'    => 125,
                'title' => 'code_for_pay_create',
            ],
            [
                'id'    => 126,
                'title' => 'code_for_pay_edit',
            ],
            [
                'id'    => 127,
                'title' => 'code_for_pay_show',
            ],
            [
                'id'    => 128,
                'title' => 'code_for_pay_delete',
            ],
            [
                'id'    => 129,
                'title' => 'code_for_pay_access',
            ],
            [
                'id'    => 130,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 131,
                'title' => 'setting_access',
            ],
            [
                'id'    => 132,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
