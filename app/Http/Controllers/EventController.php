<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Halaman detail event
     */
    public function show($id)
    {
        $event = Event::with('category')->findOrFail($id);
        return view('event-detail', compact('event'));
    }

    /**
     * Halaman checkout (DIPERBAIKI)
     */
    public function checkout($id) // 1. Tambahkan parameter $id
    {
        // 2. Ambil data event berdasarkan ID
        $event = Event::findOrFail($id);

        // 3. Kirim variabel $event ke view checkout
        return view('checkout', compact('event'));
    }

    /**
     * Halaman e-ticket setelah bayar
     */
    public function ticket()
    {
        return view('ticket');
    }
}