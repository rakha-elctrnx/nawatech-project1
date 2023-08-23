<?php

namespace App\Http\Controllers;

use App\Exports\ExportOrders;
use App\Mail\OrderCreated;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class GuestController extends Controller
{
    public function index()
    {
        $data = Brand::all();

        return Inertia::render('Welcome', [
            "data"  => $data
        ]);
    }

    public function product(Request $request)
    {
        $brand = Brand::all();

        $dataQuery = Type::with('product.brand');

        if ($request->q) {
            $dataQuery->where('type_name', 'like', '%' . $request->q . '%');
            $dataQuery->whereHas('product.brand', function ($query) use ($request) {
                $query->where('brand_name', 'like', '%' . $request->brand . '%');
            });
        }

        $data = $dataQuery->get();
        return Inertia::render('Product', [
            "data"  => $data,
            "brand" => $brand
        ]);
    }

    public function productDetail($type_id)
    {
        $data = Type::with('product.brand', 'specs')->find($type_id);
        $data['groupedSpecs'] = $data->specs->groupBy('spec');

        return Inertia::render('ProductDetail', [
            "data"  => $data
        ]);
    }

    public function order()
    {
        $data = Order::with('type.product.brand')->where('user_id', Auth::user()->id)->get();

        $data->transform(function ($order) {
            $order->date = $order->created_at->format('M d, Y');
            return $order;
        });

        return Inertia::render('Order', [
            "data"  => $data
        ]);
    }

    public function orderCreate($type_id)
    {
        $data = [
            'type_id'   => $type_id,
            'user_id'   => Auth::user()->id,
        ];

        $data = Order::create($data);
        $order = Order::with('type.product')->find($data->id);

        Mail::to(Auth::user()->email)->send(new OrderCreated($order));

        return Redirect::route('order.index');
    }

    public function orderExport()
    {
        return Excel::download(new ExportOrders, 'orders.xlsx');
    }

    public function orderCancel($order_id)
    {
        $order = Order::find($order_id);
        $order->delete();

        return Redirect::route('order.index');
    }
}
