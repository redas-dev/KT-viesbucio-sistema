@extends('layouts.app')

@section('title', 'Rezervacijos detalės')

@section('content')
    <h1>Rezervacija #{{ $reservation->id }}</h1>

    <div class="card">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div>
                <p><strong>Svečio vardas:</strong> {{ $reservation->user->name }} {{ $reservation->user->surname }}</p>
                <p><strong>El. paštas:</strong> {{ $reservation->user->email }}</p>
                <p><strong>Kambario numeris:</strong> {{ $reservation->room->room_number }}</p>
                <p><strong>Kambario tipas:</strong> <span style="text-transform: capitalize;">{{ $reservation->room->room_type }}</span></p>
            </div>
            <div>
                <p><strong>Atvykimo data:</strong> {{ $reservation->arrival_date->format('Y-m-d') }}</p>
                <p><strong>Išvykimo data:</strong> {{ $reservation->departure_date->format('Y-m-d') }}</p>
                <p><strong>Kiek naktų:</strong> {{ $reservation->arrival_date->diffInDays($reservation->departure_date) }}</p>
                <p><strong>Galutinė kaina:</strong> €{{ number_format($reservation->total_price, 2) }}</p>
            </div>
        </div>

        <div style="margin-top: 2rem; padding: 1rem; background: #f0f0f0; border-radius: 4px;">
            <p><strong>Statusas:</strong>
                <span style="padding: 0.25rem 0.75rem; border-radius: 4px;
                background: {{ $reservation->reservation_status === 'aktyvi' ? '#d4edda' : ($reservation->reservation_status === 'atšaukta' ? '#f8d7da' : '#d1ecf1') }};
                color: {{ $reservation->reservation_status === 'aktyvi' ? '#155724' : ($reservation->reservation_status === 'atšaukta' ? '#721c24' : '#0c5460') }};">
                {{ ucfirst($reservation->reservation_status) }}
            </span>
            </p>
        </div>

        <div style="margin-top: 2rem;">
            @if($reservation->reservation_status === 'aktyvi')
                <form method="POST" action="{{ route('reservations.cancel', $reservation) }}" style="display: inline;" onsubmit="return confirm('Atšaukti rezervaciją?');">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger">Atšaukti rezervaciją</button>
                </form>
            @endif

            @can('edit reservations')
                <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-primary">Redaguoti</a>
            @endif

            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Atgal į rezervacijas</a>
        </div>
    </div>
@endsection
