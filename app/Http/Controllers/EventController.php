<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan daftar acara
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Menampilkan form tambah acara
    public function create()
    {
        return view('events.create');
    }

    // Menyimpan acara baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->route('detail')->with('success', 'Acara berhasil ditambahkan!');
    }

    // Menampilkan form edit acara
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Mengupdate acara
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('detail')->with('success', 'Acara berhasil diperbarui!');
    }

    // Menghapus acara
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('detail')->with('success', 'Acara berhasil dihapus!');
    }

    public function show(Event $event)
{
    return view('events.show', compact('event'));
}

public function detail()
{
    $events = Event::all(); // Ambil semua event
    return view('detail', compact('events'));
}

    
}
