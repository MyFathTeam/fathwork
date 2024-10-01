<?php

return [
    'user' => 'User',
    'module_title' => 'Listing all Users',
    'module_description' => 'Create & Manage all the user\'s account.',
    'props' => [
        'name' => 'Name',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'force_change_password' => 'Force Change Password',
    ],
    'status' => 'Status',
    'statuses' => [
        'activated' => 'Activated',
        'banned' => 'Banned',
        'disapproved' => 'Disapproved',
        'pending_verification' => 'Pending Verification',
        'pending_approval' => 'Pending Approval',
    ],
    'preference' => [
        'preference' => 'User Preference',
        'props' => [
            'date_format' => 'Date Format',
            'time_format' => 'Time Format',
            'locale' => 'Locale',
            'timezone' => 'Timezone',
        ],
    ],
    'profile' => [
        'profile' => 'Profile',
        'account' => 'Account',
        'props' => [
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'existing_email_otp' => 'OTP',
            'new_email_otp' => 'OTP',
        ],
        'verification_otp' => 'OTP received on :attribute',
        'verify_otp_to_continue' => 'Please verify OTP sent on your email to continue.',
        'verification_otp_expired' => 'The OTP entered is expired. Please try again.',
    ],
    'avatar' => 'Avatar',
    'errors' => [
        'permission_denied' => 'Permission denied.',
        'auth_user_permission_denied' => 'You are not authorize to perform this action with your account.',
        'default_user_permission_denied' => 'You are not authorize to perform this action with this account.',
        'admin_user_permission_denied' => 'You are not authorize to perform this action with admin account.',
    ],
];
