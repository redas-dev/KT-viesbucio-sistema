@extends('layouts.app')

@section('title', 'Mano informacija')

@section('content')
    <h1 style="font-size: 3rem; font-weight: bold; text-align: center">Labas, {{ auth()->user()->name }}!</h1>

    <div class="grid">
        <div class="card" style="text-align: center;">
            <h3 style="color: #667eea; font-size: 2.5rem; font-weight: bold">{{ $reservations->count() }}</h3>
            <p style="font-weight: bold">Visos rezervacijos</p>
        </div>
        <div class="card" style="text-align: center;">
            <h3 style="color: #28a745; font-size: 2.5rem; font-weight: bold">{{ $activeReservations->count() }}</h3>
            <p style="font-weight: bold">Aktyvios rezervacijos</p>
        </div>
        <div class="card" style="text-align: center;">
            <h3 style="color: #ffc107; font-size: 2.5rem; font-weight: bold">{{ $myReviews }}</h3>
            <p style="font-weight: bold">Mano atsiliepimai</p>
        </div>
    </div>

    <div class="card">
        <h2 style="font-size: 3rem; font-weight: bold; text-align: center">Mano rezervacijos</h2>
        <div style="display: flex; justify-content: right; align-items: center; margin-bottom: 1rem;">
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">+ Nauja rezervacija</a>
        </div>

        @if ($reservations->isEmpty())
            <p style="text-align: center; color: #999; padding: 2rem;">Dar neturi rezervacijų</p>
        @else
            <table>
                <thead>
                <tr>
                    <th>Kambarys</th>
                    <th>Atvykimo data</th>
                    <th>Išvykimo data</th>
                    <th>Galutinė kaina</th>
                    <th>Statusas</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->room->room_number }}</td>
                        <td>{{ $reservation->arrival_date->format('Y-m-d') }}</td>
                        <td>{{ $reservation->departure_date->format('Y-m-d') }}</td>
                        <td>€{{ number_format($reservation->total_price, 2) }}</td>
                        <td>
                            <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: {{ $reservation->reservation_status === 'active' ? '#d4edda' : ($reservation->reservation_status === 'cancelled' ? '#f8d7da' : '#d1ecf1') }}; color: {{ $reservation->reservation_status === 'active' ? '#155724' : ($reservation->reservation_status === 'cancelled' ? '#721c24' : '#0c5460') }};">
                                {{ ucfirst($reservation->reservation_status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem;">Peržiūrėti</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="card">
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 1rem;">
            <h2 style="font-size: 3rem; font-weight: bold; text-align: center">Palik atsiliepimą</h2>

        <p>Ar jau buvai pas mus? Palik atsiliepimą</p>
        <a href="{{ route('reviews.create') }}" class="btn btn-primary">Palikti atsiliepimą</a>
        </div>
    </div>
@endsection
