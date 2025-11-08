@extends('layouts.app')

@section('title', 'Registracija - Viešbutis')

@section('content')
    <div style="max-width: 500px; margin: 4rem auto; padding: 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; color: #667eea; margin-bottom: 0.5rem;">🏨 Susikurk paskyrą</h1>
            <p style="color: #666;">Prisijunk prie mūsų ir rezervuok sau tinkamą kambarį</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Registracija nepavyko:</strong>
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

        <form method="POST" action="{{ route('register') }}" class="card">
            @csrf

            <div class="form-group">
                <label for="name">Vardas</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="given-name"
                    placeholder="Įveskite savo vardą"
                >
                @error('name')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="surname">Pavardė</label>
                <input
                    type="text"
                    id="surname"
                    name="surname"
                    value="{{ old('surname') }}"
                    required
                    autocomplete="family-name"
                    placeholder="Įveskite savo pavardę"
                >
                @error('surname')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">El. paštas</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="Įveskite savo el. paštą"
                >
                @error('email')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Slaptažodis</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Susikurkite slaptažodį (min. 8 simboliai)"
                >
                @error('password')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
                <p style="color: #999; font-size: 0.875rem; margin-top: 0.5rem;">
                    Turi būti bent 8 simbolių ilgumo
                </p>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Patvirtinti slaptažodį</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Pakartokite slaptažodį"
                >
                @error('password_confirmation')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 1.5rem; font-size: 1rem; padding: 0.875rem;">
                Registruotis
            </button>
        </form>

        <!-- Login Link -->
        <div style="text-align: center; margin-top: 1.5rem; padding: 1.5rem; background: #f9f9f9; border-radius: 8px;">
            <p style="margin: 0; color: #666;">Jau turi paskyrą?</p>
            <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: 600; font-size: 1.1rem;">
                Prisijungti
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

        .alert p:first-of-type {
            margin-top: 0;
        }

        .alert p:last-child {
            margin-bottom: 0;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
    </style>
@endsection
