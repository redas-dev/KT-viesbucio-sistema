@extends('layouts.app')

@section('title', 'Sveiki - Viešbutis')

@section('content')
    <div style="text-align: center; padding: 3rem 0;">
        <h1 style="font-size: 3rem; color: #667eea; margin-bottom: 1rem; font-weight: bold;">Sveiki atvykę į Viešbutį</h1>
        <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">Atraskite geriausius kambarius pagal savo norus</p>
        <p style="color: #666; margin-bottom: 2rem; font-weight: bold">Autorius: Redas Domkus IFF-3/2</p>

        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary" style="font-size: 1.1rem;">Informacija</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 1.1rem; margin-right: 1rem;">Registruotis</a>
            <a href="{{ route('login') }}" class="btn btn-secondary" style="font-size: 1.1rem;">Prisijungti</a>
        @endauth
    </div>

    <div class="card">
        <h2 style="font-size: 2.5rem; font-weight: bold; text-align: center">Patikrink laisvus kambarius</h2>
        <div class="form-group">
            <label for="room_type">Kambario tipas:</label>
            <select id="room_type">
                <option selected value="vienvietis">Vienvietis</option>
                <option value="dvivietis">Dvivietis</option>
                <option value="trivietis">Trivietis</option>
            </select>
        </div>
        <div class="form-group">
            <label for="arrival_date">Atvykimo Data:</label>
            <input type="date" id="arrival_date" min="{{ now()->toDateString() }}">
        </div>
        <div class="form-group">
            <label for="departure_date">Išvykimo data:</label>
            <input type="date" id="departure_date" min="{{ now()->addDay()->toDateString() }}">
        </div>
        <button onclick="checkAvailability()" class="btn btn-primary">Tikrinti</button>
        <div id="availability-result" style="margin-top: 1rem;"></div>
    </div>

    <div class="flex flex-col justify-center items-center card">
        <h2 style="font-size: 2.5rem; font-weight: bold; text-align: center">Naujausi atsiliepimai</h2>
        <div id="reviews-list"></div>
        <a href="{{route('reviews.index')}}" class="btn btn-primary max-w-fit" style="margin-top: 1rem; ">Peržiūrėti visus atsiliepimus</a>
    </div>

    <script>
        function checkAvailability() {
            const roomType = document.getElementById('room_type').value;
            const arrivalDate = document.getElementById('arrival_date').value;
            const departureDate = document.getElementById('departure_date').value;

            if (!arrivalDate || !departureDate) {
                alert('Prašome įvesti tiek atvykimo, tiek išvykimo datas.');
                return;
            }

            if (new Date(arrivalDate) > new Date(departureDate)) {
                alert('Išvykimo data turi būti vėlesnė nei atvykimo data.');
                return;
            }

            fetch('{{ route("reservations.checkAvailability") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    room_type: roomType,
                    arrival_date: arrivalDate,
                    departure_date: departureDate
                })
            })
                .then(response => response.json())
                .then(data => {
                    const result = document.getElementById('availability-result');
                    if (data.available) {
                        result.innerHTML = `<div class="alert alert-success">✓ ${data.count} laisvų kambarių!</div>`;
                    } else {
                        result.innerHTML = `<div class="alert alert-danger">✗ Nėra laisvų kambarių pasirinktoms datoms</div>`;
                    }
                });
        }

        function loadReviews() {
            fetch('{{ route("reviews.getAll") }}')
                .then(response => response.json())
                .then(reviews => {
                    const list = document.getElementById('reviews-list');
                    if (reviews.length === 0) {
                        list.innerHTML = '<p>Nėra įvertinimų</p>';
                        return;
                    }
                    list.innerHTML = reviews.map(review => `
                        <div class="card" style="margin: 1rem 0;">
                            <strong>${review.user_name}</strong> - ${'<i class="fas fa-star" style="color: #FFD700;"></i>'.repeat(review.rating)}
                            <p>${review.comment || 'Įvertinta be komentaro'}</p>
                            <small style="color: #999;">${review.review_date}</small>
                        </div>
                    `).join('');
                });
        }

        loadReviews();
    </script>
@endsection
