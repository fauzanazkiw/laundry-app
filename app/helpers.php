<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('format_nomor_wa')) {
    // format nomor HP jadi format wa.me: hapus non-digit, awalan 0 -> 62 (mis. 082255335533 -> 6282255335533)
    function format_nomor_wa($nomor)
    {
        $digit = preg_replace('/\D/', '', (string) $nomor);
        if (str_starts_with($digit, '0')) {
            $digit = '62' . substr($digit, 1);
        } elseif (!str_starts_with($digit, '62')) {
            $digit = '62' . $digit;
        }

        return $digit;
    }
}

if (!function_exists('no_hp_html')) {
    // markup no HP dgn 2 tombol terpisah: salin ke clipboard (+ toast), dan buka chat wa.me
    // dipakai di semua tabel/detail Panel (controller & blade view)
    function no_hp_html($nomor)
    {
        if (empty($nomor)) {
            return '-';
        }

        return '<span class="no-hp-wrap">'
            . '<span class="no-hp-text">' . e($nomor) . '</span>'
            . '<i class="fas fa-copy no-hp-copy" data-phone="' . e($nomor) . '" title="Salin nomor"></i>'
            . '<a href="https://wa.me/' . format_nomor_wa($nomor) . '" target="_blank" rel="noopener" class="no-hp-wa" title="Chat via WhatsApp">'
            . '<i class="fab fa-whatsapp"></i></a>'
            . '</span>';
    }
}

if (!function_exists('app_setting')) {
    // profil web statis dari config/laundry.php (bukan dari DB, tidak ada halaman kelola Setting lagi)
    function app_setting()
    {
        return (object) config('laundry');
    }
}

if (!function_exists('recaptcha_verify')) {
    // verifikasi token reCAPTCHA v2 ke Google (siteverify). Kalau secret key belum diisi, langsung true (lewati).
    function recaptcha_verify($token)
    {
        $secret = config('recaptcha.secret_key');
        if (empty($secret)) {
            return true;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secret,
                'response' => $token,
            ]);

            return $response->successful() && $response->json('success') === true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}

