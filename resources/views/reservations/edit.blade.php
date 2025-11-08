@extends('layouts.app')

@section('title', 'Keisti rezervaciją')

@section('content')
    <h1>Keisti rezervaciją #{{ $reservation->id }}</h1>

    <div class="card">
        <form method="POST" action="{{ route('reservations.update', $reservation) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="room_id">Kambarys:</label>
                <select id="room_id" name="room_id" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $reservation->fk_room_id) === $room->id ? 'selected' : '' }}>
                            {{ $room->room_number }} - {{ ucfirst($room->room_type) }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="arrival_date">Atvykimo data:</label>
                <input type="date" id="arrival_date" name="arrival_date" value="{{ old('arrival_date', $reservation->arrival_date->toDateString()) }}" required>
                @error('arrival_date')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="departure_date">Išvykimo data:</label>
                <input type="date" id="departure_date" name="departure_date" value="{{ old('departure_date', $reservation->departure_date->toDateString()) }}" required>
                @error('departure_date')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="total_price">Galutinė kaina (€):</label>
                <input type="number" id="total_price" name="total_price" step="0.01" value="{{ old('total_price', $reservation->total_price) }}" required>
                @error('total_price')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="reservation_status">Statusas:</label>
                <select id="reservation_status" name="reservation_status" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}" {{ old('reservation_status', $reservation->reservation_status) === $status->value ? 'selected' : '' }}>
                            {{ ucfirst($status->value) }}
                        </option>
                    @endforeach
                </select>
                @error('reservation_status')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Atnaujinti rezervaciją</button>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Atšaukti</a>
            </div>
        </form>
    </div>
@endsection
