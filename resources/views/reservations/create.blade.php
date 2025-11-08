@extends('layouts.app')

@section('title', 'Rezervacija')

@section('content')
    <h1>Rezervuokite kambarį</h1>

    <div class="card">
        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf

            <div class="form-group">
                <label for="arrival_date">Atvykimo data:</label>
                <input type="date" id="arrival_date" name="arrival_date" value="{{ old('arrival_date') }}" min="{{ now()->toDateString() }}" required onchange="updateRoomOptions()">
                @error('arrival_date')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="departure_date">Išvykimo data:</label>
                <input type="date" id="departure_date" name="departure_date" value="{{ old('departure_date') }}" min="{{ now()->addDay()->toDateString() }}" required onchange="updateRoomOptions()">
                @error('departure_date')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="room_type">Kambario tipas:</label>
                <select id="room_type" onchange="updateRoomOptions()">
                    <option value="vienvietis">Vienvietis</option>
                    <option value="dvivietis">Dvivietis</option>
                    <option value="trivietis">Trivietis</option>
                </select>
            </div>

            <div id="room-selection">
                <h3>Laisvi kambariai</h3>
                <div id="rooms-container">
                    <p>Pasirinkite atvykimo ir išvykimo datas, kad matytumėte laisvus kambarius.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="room_id">Pasirinktas kambarys:</label>
                <input type="text" id="selected_room" readonly placeholder="Pasirinkite kambarį iš aukščiau esančio sąrašo">
                <input type="hidden" id="room_id" name="room_id" required>
                @error('room_id')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div id="price-info" style="display: none; background: #f0f0f0; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                <p><strong>Naktų:</strong> <span id="nights">0</span></p>
                <p><strong>Kainą už naktį:</strong> $<span id="price-per-night">0</span></p>
                <p style="font-size: 1.2rem;"><strong>Galutinė kaina:</strong> $<span id="total-price">0</span></p>
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Rezervuoti</button>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Atšaukti</a>
            </div>
        </form>
    </div>

    <script>
        function updateRoomOptions() {
            const arrivalDate = document.getElementById('arrival_date').value;
            const departureDate = document.getElementById('departure_date').value;
            const roomType = document.getElementById('room_type').value;

            if (!arrivalDate || !departureDate) return;

            const arrival = new Date(arrivalDate);
            const departure = new Date(departureDate);
            const nights = Math.ceil((departure - arrival) / (1000 * 60 * 60 * 24));

            if (nights <= 0) {
                alert('Išvykimo data turi būti vėlesnė nei atvykimo data.');
                return;
            }

            document.getElementById('nights').textContent = nights;

            fetch('{{ route("reservations.checkAvailability") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    arrival_date: arrivalDate,
                    departure_date: departureDate,
                    room_type: roomType
                })
            })
                .then(response => response.json())
                .then(data => {
                    displayRooms(data.rooms, nights);
                });
        }

        function displayRooms(rooms, nights) {
            const container = document.getElementById('rooms-container');

            if (rooms.length === 0) {
                container.innerHTML = '<p>Nėra laisvų kambarių pasirinktoms datoms</p>';
                return;
            }

            container.innerHTML = rooms.map(room => `
        <div style="padding: 1rem; border: 1px solid #ddd; border-radius: 4px; margin: 0.5rem 0; cursor: pointer;" onclick="selectRoom(${room.id}, '${room.room_number}', ${room.price_per_night}, ${nights})">
            <strong>Kambarys ${room.room_number}</strong> - ${room.price_per_night} už naktį
            <p style="color: #666; margin: 0.5rem 0;">Total: $${(room.price_per_night * nights).toFixed(2)}</p>
        </div>
    `).join('');
        }

        function selectRoom(roomId, roomNumber, pricePerNight, nights) {
            document.getElementById('room_id').value = roomId;
            document.getElementById('selected_room').value = `Room ${roomNumber}`;
            document.getElementById('price-per-night').textContent = pricePerNight.toFixed(2);
            document.getElementById('total-price').textContent = (pricePerNight * nights).toFixed(2);
            document.getElementById('price-info').style.display = 'block';

            // Highlight selected room
            document.querySelectorAll('#rooms-container > div').forEach(el => {
                el.style.background = '';
                el.style.borderColor = '#ddd';
            });
            event.currentTarget.style.background = '#e7f3ff';
            event.currentTarget.style.borderColor = '#667eea';
        }
    </script>
@endsection
