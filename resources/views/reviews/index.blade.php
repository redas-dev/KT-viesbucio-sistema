@extends('layouts.app')

@section('title', 'Viešbučio atsiliepimai')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-weight: bold; font-size: 2.5rem; text-align: center">Viešbučio atsiliepimai</h1>
        @if(auth()->user() && auth()->user()->hasRole('user'))
            <a href="{{ route('reviews.create') }}" class="btn btn-primary">+ Palikti atsiliepimą</a>
        @endif
    </div>

    @if ($reviews->isEmpty())
        <div class="card">
            <p style="text-align: center; color: #999;">Dar nėra atsiliepimų. Būk pirmas, palikęs atsiliepimą!</p>
        </div>
    @else
        @foreach ($reviews as $review)
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <h3>{{ $review->user->name }} {{ $review->user->surname }}</h3>
                        <p style="margin: 0.5rem 0;">
                            @for($i = 0; $i < $review->rating; $i++)
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                            @endfor
                            <span style="color: #999;">({{ $review->rating }}/5)</span>
                        </p>
                        <p style="color: #666; margin: 0.5rem 0;">{{ $review->comment }}</p>
                        <small style="color: #999;">{{ $review->review_date->format('Y-m-d') }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
