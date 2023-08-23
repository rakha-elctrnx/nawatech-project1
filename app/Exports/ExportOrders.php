<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExportOrders implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Order::all();
    // }

    public function view(): View
    {
        $data = Order::with('type.product')->where('user_id', Auth::user()->id)->get(); // Ganti dengan query sesuai kebutuhan Anda

        return view('exports.orders', [
            'data' => $data,
        ]);
    }
}
