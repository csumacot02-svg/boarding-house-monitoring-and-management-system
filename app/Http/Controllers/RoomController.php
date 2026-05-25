<?php

// app/Http/Controllers/RoomController.php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return view('admin.rooms.index', [
            'rooms' => Room::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required',
            'capacity' => 'required|integer',
            'occupied' => 'required|integer',
            'monthly_rent' => 'required|numeric',
            'status' => 'required'
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room added successfully.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required',
            'capacity' => 'required|integer',
            'occupied' => 'required|integer',
            'monthly_rent' => 'required|numeric',
            'status' => 'required'
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return back()->with('success', 'Room deleted successfully.');
    }
}