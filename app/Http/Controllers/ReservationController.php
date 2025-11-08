<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Enums\RoomType;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations (Admin & Director).
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('director')) {
            $reservations = Reservation::with('user', 'room')->get();
        } else {
            $reservations = auth()->user()->reservations()->with('room')->get();
        }

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation (Guests only).
     */
    public function create()
    {
        if (!auth()->user()->hasRole('user')) {
            abort(403);
        }

        $roomTypes = RoomType::cases();
        return view('reservations.create', compact('roomTypes'));
    }

    /**
     * Store a newly created reservation (Guests only).
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('user')) {
            abort(403);
        }

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:arrival_date',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        if (!$room->isAvailable($validated['arrival_date'], $validated['departure_date'])) {
            return back()->withErrors(['room_id' => 'Kambarys yra užimtas pasirinktu laikotarpiu']);
        }

        $arrivalDate = \Carbon\Carbon::parse($validated['arrival_date']);
        $departureDate = \Carbon\Carbon::parse($validated['departure_date']);
        $days = abs($departureDate->diffInDays($arrivalDate));
        $totalPrice = $days * $room->price_per_night;

        $reservation = auth()->user()->reservations()->create([
            'room_id' => $validated['room_id'],
            'arrival_date' => $validated['arrival_date'],
            'departure_date' => $validated['departure_date'],
            'total_price' => $totalPrice,
            'reservation_status' => ReservationStatus::Active->value,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('reservations.show', $reservation)->with('success', 'Rezervacija sukurta sėkmingai');
    }

    /**
     * Display the specified reservation.
     */
    public function show(Reservation $reservation)
    {
        if (auth()->user()->id !== $reservation->user_id &&
            !auth()->user()->hasRole('admin') &&
            !auth()->user()->hasRole('director')) {
            abort(403);
        }

        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing a reservation (Admin only).
     */
    public function edit(Reservation $reservation)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $rooms = Room::all();
        $statuses = ReservationStatus::cases();

        return view('reservations.edit', compact('reservation', 'rooms', 'statuses'));
    }

    /**
     * Update the specified reservation (Admin only).
     */
    public function update(Request $request, Reservation $reservation)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
            'total_price' => 'required|numeric|min:0',
            'reservation_status' => 'required|in:aktyvi,atšaukta,baigta',
        ]);

        $reservation->update([
            'room_id' => $validated['room_id'],
            'arrival_date' => $validated['arrival_date'],
            'departure_date' => $validated['departure_date'],
            'total_price' => $validated['total_price'],
            'reservation_status' => $validated['reservation_status'],
        ]);

        return redirect()->route('reservations.index')->with('success', 'Rezervacija atnaujinta sėkmingai');
    }

    /**
     * Remove the specified reservation (Admin only).
     */
    public function destroy(Reservation $reservation)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Rezervacija ištrinta sėkmingai');
    }

    /**
     * Cancel a reservation (Client or Admin).
     */
    public function cancel(Reservation $reservation)
    {
        if (auth()->user()->id !== $reservation->user_id && !auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $reservation->update(['reservation_status' => ReservationStatus::Cancelled->value]);

        return redirect()->route('reservations.index')->with('success', 'Rezervacija atšaukta sėkmingai');
    }

    /**
     * Get available rooms by type and dates (API endpoint).
     */
    public function checkAvailability(Request $request)
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
            'available' => count($rooms) > 0,
            'count' => count($rooms),
            'rooms' => $rooms->map(fn($room) => [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'price_per_night' => $room->price_per_night,
                'features' => $room->room_features,
            ])
        ]);
    }
}
