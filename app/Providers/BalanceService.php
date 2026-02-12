<?php

namespace App\Services;

use App\Models\Donasi;
use App\Models\Pengeluaran;

class BalanceService
{
    /**
     * Hitung total donasi yang berhasil (Global).
     */
    public function getTotalDonations()
    {
        return Donasi::where('status', 'berhasil')->sum('nominal');
    }

    /**
     * Hitung total pengeluaran (Global).
     */
    public function getTotalExpenses()
    {
        return Pengeluaran::sum('nominal');
    }

    /**
     * Hitung saldo saat ini (Donasi Berhasil - Pengeluaran).
     */
    public function getCurrentBalance()
    {
        return $this->getTotalDonations() - $this->getTotalExpenses();
    }
}