<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('buat_tanggal')) {
    function buat_tanggal($str)
    {
        $str = str_replace("Jan", "Januari", $str);
        $str = str_replace("Feb", "Februari", $str);
        $str = str_replace("Mar", "Maret", $str);
        $str = str_replace("Apr", "April", $str);
        $str = str_replace("May", "Mei", $str);
        $str = str_replace("Jun", "Juni", $str);
        $str = str_replace("Jul", "Juli", $str);
        $str = str_replace("Aug", "Agustus", $str);
        $str = str_replace("Sep", "September", $str);
        $str = str_replace("Oct", "Oktober", $str);
        $str = str_replace("Nov", "Nopember", $str);
        $str = str_replace("Dec", "Desember", $str);
        $str = str_replace("Mon", "Senin", $str);
        $str = str_replace("Tue", "Selasa", $str);
        $str = str_replace("Wed", "Rabu", $str);
        $str = str_replace("Thu", "Kamis", $str);
        $str = str_replace("Fri", "Jumat", $str);
        $str = str_replace("Sat", "Sabtu", $str);
        $str = str_replace("Sun", "Minggu", $str);
        return $str;
    }
}

if (!function_exists('get_tp_sekarang')) {
    function get_tp_sekarang() {
        $tahun_sekarang = date('Y');
        $bulan_sekarang = date('n');
        if ($bulan_sekarang >= 7) {
            return $tahun_sekarang . '/' . ($tahun_sekarang + 1);
        } else {
            return ($tahun_sekarang - 1) . '/' . $tahun_sekarang;
        }
    }
}

if (!function_exists('get_smt_sekarang')) {
    function get_smt_sekarang() {
        $bulan_sekarang = date('n');
        if ($bulan_sekarang >= 7) {
            return '1';
        } else {
            return '2';
        }
    }
}

if (!function_exists('singkat_tanggal')) {
    function singkat_tanggal($str)
    {
        $str = str_replace('Jan', 'Jan', $str);
        $str = str_replace('Feb', 'Feb', $str);
        $str = str_replace('Mar', 'Mar', $str);
        $str = str_replace('Apr', 'Apr', $str);
        $str = str_replace('May', 'Mei', $str);
        $str = str_replace('Jun', 'Jun', $str);
        $str = str_replace('Jul', 'Jul', $str);
        $str = str_replace('Aug', 'Ags', $str);
        $str = str_replace('Sep', 'Sep', $str);
        $str = str_replace('Oct', 'Okt', $str);
        $str = str_replace('Nov', 'Nop', $str);
        $str = str_replace('Dec', 'Des', $str);
        $str = str_replace('Mon', 'Sen', $str);
        $str = str_replace('Tue', 'Sel', $str);
        $str = str_replace('Wed', 'Rab', $str);
        $str = str_replace('Thu', 'Kam', $str);
        $str = str_replace('Fri', 'Jum', $str);
        $str = str_replace('Sat', 'Sab', $str);
        $str = str_replace('Sun', 'Min', $str);
        return $str;
    }
}

if (!function_exists('form_error')) {
    function form_error($field = '', $prefix = '<div class="text-danger small mt-1">', $suffix = '</div>')
    {
        $validation = \Config\Services::validation();
        if ($validation->hasError($field)) {
            return $prefix . $validation->getError($field) . $suffix;
        }
        return '';
    }
}

if (!function_exists('detectSchoolType')) {
    /**
     * Mendeteksi jenis instansi pendidikan (Kemenag: MI/MTs/MA vs Kemendikdasmen: SD/SMP/SMA/SMK)
     * secara cerdas berdasarkan jenjang, satuan pendidikan, dan nama instansi sekolah.
     */
    function detectSchoolType($setting = null) {
        if (!$setting) {
            try {
                $db = \Config\Database::connect();
                $setting = $db->table('setting')->get()->getRow();
            } catch (\Throwable $e) {
                $setting = null;
            }
        }

        $namaSekolah = trim($setting->sekolah ?? '');
        $jenjang = strval($setting->jenjang ?? '');
        $satuan = strval($setting->satuan_pendidikan ?? '');

        $satuanList = [
            '1' => ['1' => 'SD', '2' => 'MI'],
            '2' => ['1' => 'SMP', '2' => 'MTs'],
            '3' => ['1' => 'SMA', '2' => 'MA', '3' => 'SMK', '4' => 'MAK']
        ];
        $satuanNama = $satuanList[$jenjang][$satuan] ?? '';

        $isExplicitKemenag = preg_match('/\b(mts|madrasah|tsanawiyah|aliyah|ibtidaiyah|mi|ma|mak)\b/i', $namaSekolah);
        $isExplicitDiknas = preg_match('/\b(sd|sdn|smp|smpn|sma|sman|smk|smkn|sekolah dasar|sekolah menengah)\b/i', $namaSekolah);

        if (!empty($satuanNama)) {
            $isKemenag = in_array(strtoupper($satuanNama), ['MI', 'MTS', 'MA', 'MAK']);
        } elseif ($isExplicitDiknas) {
            $isKemenag = false;
        } elseif ($isExplicitKemenag) {
            $isKemenag = true;
        } elseif ($satuan === '2') {
            $isKemenag = true;
        } elseif ($satuan === '1' || $satuan === '3' || $satuan === '4') {
            $isKemenag = false;
        } else {
            $isKemenag = false;
        }

        $schoolType = $isKemenag ? 'kemenag' : 'diknas';
        $satuanLabel = $isKemenag ? 'Madrasah' : 'Sekolah';
        $kepsekLabel = $isKemenag ? 'Kepala Madrasah' : 'Kepala Sekolah';
        $kementerian = $isKemenag ? 'KEMENTERIAN AGAMA REPUBLIK INDONESIA' : 'KEMENTERIAN PENDIDIKAN DASAR DAN MENENGAH';
        $logoGov = $isKemenag ? base_url('assets/img/kemenag_logo_kop.jpg') : base_url('assets/img/tutwuri.png');

        $isSd = ($jenjang === '1') || in_array(strtoupper($satuanNama), ['SD', 'MI']) || preg_match('/\b(sd|sdn|mi|sekolah dasar)\b/i', $namaSekolah);
        $isSma = ($jenjang === '3' || $jenjang === '4') || in_array(strtoupper($satuanNama), ['SMA', 'MA', 'SMK', 'MAK']) || preg_match('/\b(sma|sman|ma|smk|smkn|mak)\b/i', $namaSekolah);

        return (object) [
            'is_kemenag'   => (bool)$isKemenag,
            'is_diknas'    => !(bool)$isKemenag,
            'is_sd'        => (bool)$isSd,
            'is_sma'       => (bool)$isSma,
            'school_type'  => $schoolType,
            'satuan_nama'  => !empty($satuanNama) ? $satuanNama : ($isKemenag ? 'MTs' : ($isSd ? 'SD' : 'SMP')),
            'satuan_label' => $satuanLabel,
            'kepsek_label' => $kepsekLabel,
            'kementerian'  => $kementerian,
            'logo_gov'     => $logoGov
        ];
    }
}
