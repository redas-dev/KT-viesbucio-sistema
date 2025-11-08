@extends('layouts.app')

@section('title', 'Administratoriaus Informacinė Sritis')

@section('content')
    <h1 style="font-size: 3rem; font-weight: bold; text-align: center">Bendra informacija</h1>

    <div class="grid grid-cols-2">
        <div class="card" style="text-align: center;">
            <h3 style="color: #667eea; font-size: 2.5rem; font-weight: bold">{{ $totalRooms }}</h3>
            <p style="font-weight: bold">Kambarių kiekis</p>
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
            <h3 style="color: #17a2b8; font-size: 2.5rem; font-weight: bold">{{ $bookedRooms }}</h3>
            <p style="font-weight: bold">Užrezervuoti kambariai</p>
        </div>
    </div>

    <div class="card">
        <h2 style="font-size: 3rem; font-weight: bold; text-align: center">Kambarių statusas</h2>
        <table>
            <thead>
            <tr>
                <th>Kambario numeris</th>
                <th>Tipas</th>
                <th>Statusas</th>
                <th>Dabartinės rezervacijos</th>
                <th>Kaina už naktį</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($rooms as $room)
                <tr>
                    <td>{{ $room->room_number }}</td>
                    <td style="text-transform: capitalize;">{{ $room->room_type }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: {{ $room->room_status === 'laisvas' ? '#d4edda' : '#f8d7da' }}; color: {{ $room->room_status === 'laisvas' ? '#155724' : '#721c24' }};">
                            {{ ucfirst($room->room_status) }}
                        </span>
                    </td>
                    <td>{{ $room->reservations_count }}</td>
                    <td>€{{ number_format($room->price_per_night, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Nėra kambarių</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2 style="font-size: 3rem; font-weight: bold; text-align: center">Naujausios rezervacijos</h2>
        <table>
            <thead>
            <tr>
                <th>Rezervacijos ID</th>
                <th>Svečias</th>
                <th>Kambarys</th>
                <th>Atvykimo data</th>
                <th>Išvykimo data</th>
                <th>Statusas</th>
                <th>Galutinė suma</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($recentReservations as $reservation)
                <tr>
                    <td><strong>#{{ $reservation->id }}</strong></td>
                    <td>{{ $reservation->user->name }} {{ $reservation->user->surname }}</td>
                    <td>{{ $reservation->room->room_number }}</td>
                    <td>{{ $reservation->arrival_date->format('Y-m-d') }}</td>
                    <td>{{ $reservation->departure_date->format('Y-m-d') }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: {{ $reservation->reservation_status === 'aktyvi' ? '#d4edda' : '#f8d7da' }}; color: {{ $reservation->reservation_status === 'aktyvi' ? '#155724' : '#721c24' }};">
                            {{ ucfirst($reservation->reservation_status) }}
                        </span>
                    </td>
                    <td>€{{ number_format($reservation->total_price, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Nėra rezervacijų</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
