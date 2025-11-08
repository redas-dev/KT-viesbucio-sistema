<?php

namespace App\Http\Controllers;

use App\Enums\RoomType;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of all rooms (Admin only).
     */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room (Admin only).
     */
    public function create()
    {
        $roomTypes = RoomType::cases();
        return view('rooms.create', compact('roomTypes'));
    }

    /**
     * Store a newly created room in storage (Admin only).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms',
            'room_type' => 'required|in:vienvietis,dvivietis,trivietis',
            'price_per_night' => 'required|numeric|min:0',
            'room_features' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $validated['room_features'] = json_encode(explode(',', $request->input('room_features', "")));

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
    }

    /**
     * Display the specified room details (Admin only).
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room (Admin only).
     */
    public function edit(Room $room)
    {
        $roomTypes = RoomType::cases();

        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    /**
     * Update the specified room in storage (Admin only).
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'room_type' => 'required|in:vienvietis,dvivietis,trivietis',
            'price_per_night' => 'required|numeric|min:0',
            'room_features' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $validated['room_features'] = json_encode(explode(',', $request->input('room_features', "")));

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Kambarys atnaujintas sėkmingai');
    }

    /**
     * Remove the specified room from storage (Admin only).
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Kambarys ištrintas sėkmingai');
    }

    /**
     * Get available rooms for a given type and date range (for guests).
     */
    public function getAvailable(Request $request)
    {
        $validated = $request->validate([
            'room_type' => 'required|in:vienvietis,dvivietis,trivietis',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:arrival_date',
        ]);

        $rooms = Room::where('room_type', $validated['room_type'])
            ->get()
            ->filter(function ($room) use ($validated) {
                return $room->isAvailable($validated['arrival_date'], $validated['departure_date']);
            });

        return response()->json([
            'available_count' => count($rooms),
            'rooms' => $rooms->map(fn($room) => [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'price_per_night' => $room->price_per_night,
                'features' => $room->room_features,
            ])
        ]);
    }
}
