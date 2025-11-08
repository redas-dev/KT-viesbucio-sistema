@extends('layouts.app')

@section('title', 'Kambario detalės')

@section('content')
    <h1 style="font-size: 2.5rem; font-weight: bold">Kambarys {{ $room->room_number }}</h1>

    <div class="card">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div>
                <p><strong>Kambario numeris:</strong> {{ $room->room_number }}</p>
                <p><strong>Tipas:</strong> <span style="text-transform: capitalize;">{{ $room->room_type }}</span></p>
                <p><strong>Kaina už naktį:</strong> €{{ number_format($room->price_per_night, 2) }}</p>
                <p><strong>Statusas:</strong>
                    <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: {{ $room->room_status === 'laisvas' ? '#d4edda' : '#f8d7da' }}; color: {{ $room->room_status === 'laisvas' ? '#155724' : '#721c24' }};">
                    {{ ucfirst($room->room_status) }}
                </span>
                </p>
            </div>
            <div>
                <p><strong>Aprašymas:</strong></p>
                <p>{{ $room->description ?? 'Nėra aprašymo' }}</p>
                <p><strong>Privalumai:</strong></p>
                <p>
                    @php
                        $features = is_string($room->room_features) ? json_decode($room->room_features, true) : $room->room_features;
                    @endphp
                    @if (is_array($features) && count($features) > 0)
                        {{ implode(', ', $features) }}
                    @else
                        Nėra privalumų
                    @endif
                </p>
            </div>
        </div>

        <div style="margin-top: 2rem;">
            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-primary">Redaguoti kambarį</a>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Atgal į kambarių sąraša</a>
        </div>
    </div>
@endsection
