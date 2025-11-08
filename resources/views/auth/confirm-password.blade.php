@extends('layouts.app')

@section('title', 'Patvirtinti slaptažodį - Viešbutis')

@section('content')
    <div style="max-width: 400px; margin: 4rem auto; padding: 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; color: #667eea; margin-bottom: 0.5rem;">🔐 Patvirtinti slaptažodį</h1>
            <p style="color: #666;">Tai yra saugi aplikacijos vieta</p>
        </div>

        <div style="padding: 1.5rem; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107; margin-bottom: 2rem;">
            <p style="color: #856404; margin: 0;">
                <strong>⚠️ Patikrinimas:</strong> Prašome patvirtinti slaptažodį prieš tęsiant.
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Slaptažodžio patvirtinimas nesėkmingas:</strong>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('confirmation.store') }}" class="card">
            @csrf

            <div class="form-group">
                <label for="password">Slaptažodis</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autofocus
                    autocomplete="current-password"
                    placeholder="Įrašykite savo slaptažodį"
                >
                @error('password')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem; font-size: 1rem; padding: 0.875rem;">
                Patvirtinti
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('dashboard') }}" style="color: #667eea; text-decoration: none;">
                ← Grįžti
            </a>
        </div>
    </div>

    <style>
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert strong {
            display: block;
            margin-bottom: 0.5rem;
        }

        .alert p {
            margin: 0.5rem 0;
        }
    </style>
@endsection
