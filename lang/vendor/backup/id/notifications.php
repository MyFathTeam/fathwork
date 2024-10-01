<?php

return [
    'exception_message' => 'Pesan exception: :message',
    'exception_trace' => 'Jejak exception: :trace',
    'exception_message_title' => 'Pesan exception',
    'exception_trace_title' => 'Jejak exception',

    'backup_failed_subject' => 'Gagal backup dari :application_name',
    'backup_failed_body' => 'Penting: Terjadi kesalahan saat melakukan backup dari :application_name',

    'backup_successful_subject' => 'Berhasil backup baru dari :application_name',
    'backup_successful_subject_title' => 'Backup baru berhasil!',
    'backup_successful_body' => 'Berita baik, backup baru dari :application_name berhasil dibuat di disk bernama :disk_name.',

    'cleanup_failed_subject' => 'Gagal membersihkan backup dari :application_name.',
    'cleanup_failed_body' => 'Terjadi kesalahan saat membersihkan backup dari :application_name',

    'cleanup_successful_subject' => 'Pembersihan backup dari :application_name berhasil',
    'cleanup_successful_subject_title' => 'Pembersihan backup berhasil!',
    'cleanup_successful_body' => 'Pembersihan backup dari :application_name di disk bernama :disk_name berhasil.',

    'healthy_backup_found_subject' => 'Backup untuk :application_name di disk :disk_name sehat',
    'healthy_backup_found_subject_title' => 'Backup untuk :application_name sehat',
    'healthy_backup_found_body' => 'Backup untuk :application_name dianggap sehat. Kerja bagus!',

    'unhealthy_backup_found_subject' => 'Penting: Backup untuk :application_name tidak sehat',
    'unhealthy_backup_found_subject_title' => 'Penting: Backup untuk :application_name tidak sehat. :problem',
    'unhealthy_backup_found_body' => 'Backup untuk :application_name di disk :disk_name tidak sehat.',
    'unhealthy_backup_found_not_reachable' => 'Tujuan backup tidak dapat dijangkau. :error',
    'unhealthy_backup_found_empty' => 'Tidak ada backup aplikasi ini sama sekali.',
    'unhealthy_backup_found_old' => 'Backup terbaru dibuat pada :date dianggap terlalu lama.',
    'unhealthy_backup_found_unknown' => 'Maaf, alasan yang tepat tidak dapat ditentukan.',
    'unhealthy_backup_found_full' => 'Backup menggunakan terlalu banyak penyimpanan. Penggunaan saat ini adalah :disk_usage yang lebih tinggi dari batas yang diizinkan :disk_limit.',
];
