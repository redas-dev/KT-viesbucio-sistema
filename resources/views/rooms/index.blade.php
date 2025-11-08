@extends('layouts.app')

@section('title', 'Kambarių peržiūra')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Kambarių peržiūra</h1>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">+ Pridėti naują kambarį</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>Kambario numeris</th>
            <th>Tipas</th>
            <th>Kaina už naktį</th>
            <th>Statusas</th>
            <th>Kambario privalumai</th>
            <th>Veiksmai</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($rooms as $room)
            <tr>
                <td>{{ $room->room_number }}</td>
                <td><span style="text-transform: capitalize;">{{ $room->room_type }}</span></td>
                <td>€{{ number_format($room->price_per_night, 2) }}</td>
                <td>
                    <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: {{ $room->room_status === 'laisvas' ? '#d4edda' : '#f8d7da' }}; color: {{ $room->room_status === 'laisvas' ? '#155724' : '#721c24' }};">
                        {{ ucfirst($room->room_status) }}
                    </span>
                </td>
                <td>
                    @php
                        $features = is_string($room->room_features) ? json_decode($room->room_features, true) : $room->room_features;
                    @endphp
                    {{ is_array($features) ? implode(', ', $features) : 'N/A' }}
                </td>
                <td>
                    <a href="{{ route('rooms.show', $room) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; margin-right: 0.5rem;"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('rooms.edit', $room) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; margin-right: 0.5rem;"><i class="fas fa-pen"></i></a>
                    <form method="POST" action="{{ route('rooms.destroy', $room) }}" style="display: inline;" onsubmit="return confirm('Trinti kambarį?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem;"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 2rem;">Kambarių nerasta</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
