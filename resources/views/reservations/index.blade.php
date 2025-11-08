@extends('layouts.app')

@section('title', 'Rezervacijos')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: bold">Rezervacijos</h1>
        @if(auth()->user()->hasRole('user'))
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">+ Nauja rezervacija</a>
        @endcan
    </div>

    <table>
        <thead>
        <tr>
            <th>Rezervacijos ID</th>
            <th>Svečio vardas</th>
            <th>Kambarys</th>
            <th>Atvykimo data</th>
            <th>Išvykimo data</th>
            <th>Galutinė kaina</th>
            <th>Statusas</th>
            <th>Veiksmai</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($reservations as $reservation)
            <tr>
                <td>#{{ $reservation->id }}</td>
                <td>{{ $reservation->user->name }} {{ $reservation->user->surname }}</td>
                <td>{{ $reservation->room->room_number }}</td>
                <td>{{ $reservation->arrival_date->format('Y-m-d') }}</td>
                <td>{{ $reservation->departure_date->format('Y-m-d') }}</td>
                <td>€{{ number_format($reservation->total_price, 2) }}</td>
                <td>
                    <span style="padding: 0.25rem 0.75rem; border-radius: 4px;
                        background: {{ $reservation->reservation_status === 'aktyvi' ? '#d4edda' : ($reservation->reservation_status === 'atšaukta' ? '#f8d7da' : '#d1ecf1') }};
                        color: {{ $reservation->reservation_status === 'aktyvi' ? '#155724' : ($reservation->reservation_status === 'atšaukta' ? '#721c24' : '#0c5460') }};">
                        {{ ucfirst($reservation->reservation_status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; margin-right: 0.5rem;"><i class="fas fa-eye"></i></a>
                    @can('edit reservations')
                        <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; margin-right: 0.5rem;"><i class="fas fa-pen"></i></a>
                    @endif
                    @if($reservation->reservation_status === 'aktyvi')
                        <form method="POST" action="{{ route('reservations.cancel', $reservation) }}" style="display: inline;" onsubmit="return confirm('Atšaukti šią rezervaciją?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem;"><i class="fas fa-trash"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 2rem;">Rezervacijų nerasta</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
