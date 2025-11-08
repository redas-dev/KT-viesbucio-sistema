@extends('layouts.app')

@section('title', 'Palikti atsiliepimą')

@section('content')
    <h1>Palikti atsiliepimą</h1>

    <div class="card">
        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf

            <div class="form-group">
                <label for="rating">Įvertinimas (1-5 žvaigždučių):</label>
                <div style="display: flex; gap: 1rem; font-size: 2rem; margin-bottom: 1rem;">
                    @for($i = 1; $i <= 5; $i++)
                        <span onclick="document.getElementById('rating').value = {{ $i }}; updateStarDisplay({{ $i }});" style="cursor: pointer; opacity: 0.3; transition: opacity 0.2s;" id="star-{{ $i }}"><i class="fas fa-star" style="color: #FFD700;"></i></span>
                    @endfor
                </div>
                <input type="hidden" id="rating" name="rating" value="{{ old('rating') }}" required>
                @error('rating')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="comment">Tavo atsiliepimas:</label>
                <textarea id="comment" name="comment" rows="5" placeholder="Pasidalink savo patirtimi..." maxlength="1000">{{ old('comment') }}</textarea>
                @error('comment')
                <span style="color: #dc3545;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Pateikti atsiliepimą</button>
                <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Atšaukti</a>
            </div>
        </form>
    </div>

    <script>
        function updateStarDisplay(rating) {
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById(`star-${i}`);
                if (i <= rating) {
                    star.style.opacity = '1';
                } else {
                    star.style.opacity = '0.3';
                }
            }
        }

        // Initialize stars on page load
        const initialRating = document.getElementById('rating').value;
        if (initialRating) {
            updateStarDisplay(initialRating);
        }
    </script>
@endsection
