<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SwimSession;
use App\Models\User;
use Illuminate\Http\Request;

class AdminApiController extends Controller
{
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')
            ->get(['id', 'name', 'email', 'is_admin', 'created_at']);

        return response()->json(['users' => $users]);
    }

    public function orders(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get(['id', 'order_number', 'user_id', 'name', 'visit_date', 'status', 'total_price', 'payment_method', 'created_at']);

        return response()->json(['orders' => $orders]);
    }

    public function deleteSession(SwimSession $session)
    {
        $session->delete();
        return response()->json(['message' => 'Sesi berhasil dihapus.']);
    }

    public function deleteOrder(Order $order)
    {
        $order->ticket()->delete();
        $order->delete();
        return response()->json(['message' => 'Orderan berhasil dihapus.']);
    }
}
