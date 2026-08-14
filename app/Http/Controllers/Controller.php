<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // markup no HP yang bisa diklik (copy ke clipboard + toast, sekaligus buka wa.me) dipakai di semua tabel/detail Panel
    protected function noHp($nomor)
    {
        return no_hp_html($nomor);
    }
}
