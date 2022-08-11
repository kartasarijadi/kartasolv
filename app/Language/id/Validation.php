<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Validation language settings
return [
    // Core Messages
    'noRuleSets'      => 'Tidak ada aturan yang ditentukan dalam konfigurasi Validasi.',
    'ruleNotFound'    => '{0} bukan sebuah aturan yang valid.',
    'groupNotFound'   => '{0} bukan sebuah grup aturan validasi.',
    'groupNotArray'   => '{0} grup aturan harus berupa sebuah array.',
    'invalidTemplate' => '{0} bukan sebuah template Validasi yang valid.',

    // Rule Messages
    'alpha'                 => 'Kolom {field} hanya boleh mengandung karakter alfabet.',
    'alpha_dash'            => 'Kolom {field} hanya boleh berisi karakter alfanumerik, setrip bawah, dan tanda pisah.',
    'alpha_numeric'         => 'Kolom {field} hanya boleh berisi karakter alfanumerik.',
    'alpha_numeric_punct'   => 'Kolom {field} hanya boleh berisi karakter alfanumerik, spasi, dan karakter ~! # $% & * - _ + = | :..',
    'alpha_numeric_space'   => 'Kolom {field} hanya boleh berisi karakter alfanumerik dan spasi.',
    'alpha_space'           => 'Kolom {field} hanya boleh berisi karakter alfabet dan spasi.',
    'decimal'               => 'Kolom {field} harus mengandung sebuah angka desimal.',
    'differs'               => 'Kolom {field} harus berbeda dari kolom {param}.',
    'equals'                => 'Kolom {field} harus persis: {param}.',
    'exact_length'          => 'Kolom {field} harus tepat {param} panjang karakter.',
    'greater_than'          => 'Kolom {field} harus berisi sebuah angka yang lebih besar dari {param}.',
    'greater_than_equal_to' => 'Kolom {field} harus berisi sebuah angka yang lebih besar atau sama dengan {param}.',
    'hex'                   => 'Kolom {field} hanya boleh berisi karakter heksadesimal.',
    'in_list'               => 'Kolom {field} harus salah satu dari: {param}.',
    'integer'               => 'Kolom {field} harus mengandung bilangan bulat.',
    'is_natural'            => 'Kolom {field} hanya boleh berisi angka.',
    'is_natural_no_zero'    => 'Kolom {field} hanya boleh berisi angka dan harus lebih besar dari nol.',
    'is_not_unique'         => 'Kolom {field} harus berisi nilai yang sudah ada sebelumnya dalam database.',
    'is_unique'             => 'Kolom {field} harus mengandung sebuah nilai unik.',
    'less_than'             => 'Kolom {field} harus berisi sebuah angka yang kurang dari {param}.',
    'less_than_equal_to'    => 'Kolom {field} harus berisi sebuah angka yang kurang dari atau sama dengan {param}.',
    'matches'               => 'Kolom {field} tidak cocok dengan kolom {param}.',
    'max_length'            => 'Kolom {field} tidak bisa melebihi {param} panjang karakter.',
    'min_length'            => 'Kolom {field} setidaknya harus {param} panjang karakter.',
    'not_equals'            => 'Kolom {field} tidak boleh: {param}.',
    'not_in_list'           => 'Kolom {field} tidak boleh salah satu dari: {param}.',
    'numeric'               => 'Kolom {field} hanya boleh mengandung angka.',
    'regex_match'           => 'Kolom {field} tidak dalam format yang benar.',
    'required'              => 'Kolom {field} harus diisi.',
    'required_with'         => 'Kolom {field} harus diisi saat {param} diisi.',
    'required_without'      => 'Kolom {field} harus diisi saat {param} tidak diisi.',
    'string'                => 'Kolom {field} harus berupa string yang valid.',
    'timezone'              => 'Kolom {field} harus berupa sebuah zona waktu yang valid.',
    'valid_base64'          => 'Kolom {field} harus berupa sebuah string base64 yang valid.',
    'valid_email'           => 'Kolom {field} harus berisi sebuah alamat surel yang valid.',
    'valid_emails'          => 'Kolom {field} harus berisi semua alamat surel yang valid.',
    'valid_ip'              => 'Kolom {field} harus berisi sebuah IP yang valid.',
    'valid_url'             => 'Kolom {field} harus berisi sebuah URL yang valid.',
    'valid_url_strict'      => 'Kolom {field} harus berisi sebuah URL yang valid.',
    'valid_date'            => 'Kolom {field} harus berisi sebuah tanggal yang valid.',

    // Credit Cards
    'valid_cc_num' => '{field} tidak tampak sebagai sebuah nomor kartu kredit yang valid.',

    // Files
    'uploaded' => '{field} bukan sebuah berkas diunggah yang valid.',
    'max_size' => '{field} terlalu besar dari sebuah berkas.',
    'is_image' => '{field} bukan berkas gambar diunggah yang valid.',
    'mime_in'  => '{field} tidak memiliki sebuah tipe mime yang valid.',
    'ext_in'   => '{field} tidak memiliki sebuah ekstensi berkas yang valid.',
    'max_dims' => '{field} bukan gambar, atau terlalu lebar atau tinggi.',
];
