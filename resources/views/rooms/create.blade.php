@extends('layouts.app')

@section('title', 'Kurti kambarį')

@section('content')
    <h1 style="font-size: 2.5rem; font-weight: bold">Kurti naują kambarį</h1>

    <div class="card">
        <form method="POST" action="{{ route('rooms.store') }}">
            @csrf

            <div class="form-group">
                <label for="room_number">Kambario numeris:</label>
                <input type="text" id="room_number" name="room_number" value="{{ old('room_number') }}" required>
                @error('room_number')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="room_type">Kambario tipas:</label>
                <select id="room_type" name="room_type" required>
                    <option value="">Pasirinkti tipą</option>
                    @foreach ($roomTypes as $type)
                        <option value="{{ $type->value }}" {{ old('room_type') === $type->value ? 'selected' : '' }}>
                            {{ ucfirst($type->value) }}
                        </option>
                    @endforeach
                </select>
                @error('room_type')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price_per_night">Kaina už naktį:</label>
                <input type="number" id="price_per_night" name="price_per_night" step="0.01" value="{{ old('price_per_night') }}" required>
                @error('price_per_night')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Kambario privalumai:</label>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <textarea id="room_features" name="room_features">{{old('room_features')}}</textarea>
                </div>
                @error('room_features')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Aprašymas:</label>
                <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Kurti kambarį</button>
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Atšaukti</a>
            </div>
        </form>
    </div>
@endsection
