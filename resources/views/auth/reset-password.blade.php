@extends('layouts.app')

@section('title', 'Atkurti slaptažodį - Viešbutis')

@section('content')
    <div style="max-width: 400px; margin: 4rem auto; padding: 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; color: #667eea; margin-bottom: 0.5rem;">🔐 Slaptažodžio atkūrimas</h1>
            <p style="color: #666;">Susikurk naują slaptažodį paskyrai</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Slaptažodžio atkūrimas nepavyko:</strong>
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

        <form method="POST" action="{{ route('password.store') }}" class="card">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label for="email">El. paštas</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autofocus
                    autocomplete="email"
                    readonly
                    placeholder="Jūsų el. paštas"
                    style="background-color: #f5f5f5; cursor: not-allowed;"
                >
                @error('email')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Naujas slaptažodis</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Įveskite naują slaptažodį (min. 8 simboliai)"
                >
                @error('password')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
                <p style="color: #999; font-size: 0.875rem; margin-top: 0.5rem;">
                    Slaptažodis turi būti bent 8 simbolių ilgio.
                </p>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Pakartokite slaptažodį</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Pakartokite naują slaptažodį"
                >
                @error('password_confirmation')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 1.5rem; font-size: 1rem; padding: 0.875rem;">
                Atkurti slaptažodį
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none;">
                ← Grįžti į prisijungimo puslapį
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

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
    </style>
@endsection
