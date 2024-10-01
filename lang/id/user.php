<?php

return [
    'user' => 'Pengguna',
    'module_title' => 'Menampilkan Semua Pengguna',
    'module_description' => 'Membuat & Mengelola semua akun pengguna.',
    'props' => [
        'name' => 'Nama',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
        'force_change_password' => 'Paksa Ganti Password',
    ],
    'status' => 'Status',
    'statuses' => [
        'activated' => 'Diaktifkan',
        'banned' => 'Dilarang',
        'disapproved' => 'Tidak Disetujui',
        'pending_verification' => 'Menunggu Verifikasi',
        'pending_approval' => 'Menunggu Persetujuan',
    ],
    'preference' => [
        'preference' => 'Preferensi Pengguna',
        'props' => [
            'date_format' => 'Format Tanggal',
            'time_format' => 'Format Waktu',
            'locale' => 'Lokal',
            'timezone' => 'Zona Waktu',
        ],
    ],
    'profile' => [
        'profile' => 'Profil',
        'account' => 'Akun',
        'props' => [
            'name' => 'Nama',
            'username' => 'Username',
            'email' => 'Email',
            'existing_email_otp' => 'OTP',
            'new_email_otp' => 'OTP',
        ],
        'verification_otp' => 'OTP diterima pada :attribute',
        'verify_otp_to_continue' => 'Harap verifikasi OTP yang dikirimkan ke email Anda untuk melanjutkan.',
        'verification_otp_expired' => 'OTP yang dimasukkan telah kedaluwarsa. Silakan coba lagi.',
    ],
    'avatar' => 'Avatar',
    'errors' => [
        'permission_denied' => 'Izin ditolak.',
        'auth_user_permission_denied' => 'Anda tidak diizinkan untuk melakukan tindakan ini dengan akun Anda.',
        'default_user_permission_denied' => 'Anda tidak diizinkan untuk melakukan tindakan ini dengan akun ini.',
        'admin_user_permission_denied' => 'Anda tidak diizinkan untuk melakukan tindakan ini dengan akun admin.',
    ],
];
