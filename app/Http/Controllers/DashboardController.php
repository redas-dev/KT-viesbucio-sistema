<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Room;

class DashboardController extends Controller
{
    /**
     * Show role-specific dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('director')) {
            return $this->directorDashboard();
        } else {
            return $this->clientDashboard();
        }
    }

    /**
     * Admin Dashboard - room and reservation management.
     */
    private function adminDashboard()
    {
        $totalRooms = Room::count();
        $activeReservations = Reservation::where('reservation_status', ReservationStatus::Active->value)->count();
        $totalRevenue = Reservation::where('reservation_status', ReservationStatus::Completed->value)->sum('total_price');
        $bookedRooms = Reservation::where('reservation_status', ReservationStatus::Active->value)->distinct('room_id')->count();

        $rooms = Room::withCount('reservations')->get();
        $recentReservations = Reservation::with('user', 'room')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin-dashboard', compact(
            'totalRooms',
            'activeReservations',
            'totalRevenue',
            'bookedRooms',
            'rooms',
            'recentReservations'
        ));
    }

    /**
     * Director Dashboard - statistics and reviews.
     */
    private function directorDashboard()
    {
        $totalReservations = Reservation::count();
        $activeReservations = Reservation::where('reservation_status', ReservationStatus::Active->value)->count();
        $totalRevenue = Reservation::where('reservation_status', ReservationStatus::Completed->value)->sum('total_price');
        $averageRating = Review::avg('rating');

        $reservationsByStatus = Reservation::groupBy('reservation_status')
            ->selectRaw('reservation_status, count(*) as count')
            ->get();

        $roomOccupancy = Room::withCount(['reservations' => function($query) {
            $query->where('reservation_status', ReservationStatus::Active->value);
        }])->get();

        $reviews = Review::with('user')->latest()->limit(10)->get();

        return view('director-dashboard', compact(
            'totalReservations',
            'activeReservations',
            'totalRevenue',
            'averageRating',
            'reservationsByStatus',
            'roomOccupancy',
            'reviews'
        ));
    }

    /**
     * Client Dashboard - personal reservations.
     */
    private function clientDashboard()
    {
        $reservations = auth()->user()->reservations()->with('room')->get();
        $activeReservations = $reservations->where('reservation_status', ReservationStatus::Active->value);
        $myReviews = auth()->user()->reviews()->count();

        return view('client-dashboard', compact(
            'reservations',
            'activeReservations',
            'myReviews'
        ));
    }
}
