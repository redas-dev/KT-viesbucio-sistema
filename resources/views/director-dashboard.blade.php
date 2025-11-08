@extends('layouts.app')

@section('title', 'Direktoriaus informacija')

@section('content')
<h1 style="font-size: 3rem; font-weight: bold; text-align: center">Bendra informacija</h1>

<div class="grid">
    <div class="card" style="text-align: center;">
        <h3 style="color: #667eea; font-size: 2.5rem; font-weight: bold">{{ $totalReservations }}</h3>
        <p style="font-weight: bold">Visos rezervacijos</p>
    </div>
    <div class="card" style="text-align: center;">
        <h3 style="color: #28a745; font-size: 2.5rem; font-weight: bold">{{ $activeReservations }}</h3>
        <p style="font-weight: bold">Aktyvios rezervacijos</p>
    </div>
    <div class="card" style="text-align: center;">
        <h3 style="color: #ffc107; font-size: 2.5rem; font-weight: bold">€{{ number_format($totalRevenue, 2) }}</h3>
        <p style="font-weight: bold">Bendras pelnas</p>
    </div>
    <div class="card" style="text-align: center;">
        <h3 style="color: #17a2b8; font-size: 2.5rem; font-weight: bold">{{ number_format($averageRating, 1) }}</h3>
        <p style="font-weight: bold">Vidutinis įvertinimas</p>
    </div>
</div>

<div class="grid">
    <div class="card">
        <h2 style="font-weight: bold; text-align: center">Rezervacijos pagal statusą</h2>
        <table>
            <thead>
            <tr>
                <th>Statusas</th>
                <th>Kiekis</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($reservationsByStatus as $item)
            <tr>
                <td style="text-transform: capitalize;">{{ $item->reservation_status }}</td>
                <td><strong>{{ $item->count }}</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="2" style="text-align: center;">Nėra duomenų</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2 style="font-weight: bold; text-align: center">Kambarių užimtumas</h2>
        <table>
            <thead>
            <tr>
                <th>Kambario numeris</th>
                <th>Tipas</th>
                <th>Svečiai</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($roomOccupancy as $room)
            <tr>
                <td>{{ $room->room_number }}</td>
                <td style="text-transform: capitalize;">{{ $room->room_type }}</td>
                <td>{{ $room->reservations_count }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center;">No data</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <h2 style="font-size: 3rem; font-weight: bold; text-align: center">Naujausi atsiliepimai</h2>
    @forelse ($reviews as $review)
    <div style="padding: 1rem; border-bottom: 1px solid #eee;">
        <div style="display: flex; justify-content: space-between;">
            <div>
                <strong>{{ $review->user->name }} {{ $review->user->surname }}</strong> - @for($i = 0; $i < $review->rating; $i++)<i class="fas fa-star" style="color: #FFD700;"></i>@endfor
                <p style="color: #666; margin: 0.5rem 0;">{{ $review->comment ?: 'Nėra komentaro' }}</p>
                <small style="color: #999;">{{ $review->review_date->format('Y-m-d') }}</small>
            </div>
        </div>
    </div>
    @empty
    <p style="text-align: center; color: #999;">Nėra atsiliepimų</p>
    @endforelse
</div>
@endsection
