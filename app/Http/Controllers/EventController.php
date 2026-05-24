<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Halaman daftar event (index + search)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $events = Event::with('category')
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhereHas('category', function ($q) use ($search) {
                          $q->where('name', 'LIKE', "%{$search}%");
                      });
            })
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

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
    public function checkout($id)
    {
        $event = Event::findOrFail($id);
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
