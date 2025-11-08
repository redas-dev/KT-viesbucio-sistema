@extends('layouts.app')

@section('title', 'Prisijungimas - Viešbutis')

@section('content')
    <div style="max-width: 400px; margin: 4rem auto; padding: 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; color: #667eea; margin-bottom: 0.5rem;">🏨 Sveikas sugrįžęs</h1>
            <p style="color: #666;">Prisijunk prie savo paskyros</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
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

        <form method="POST" action="{{ route('login') }}" class="card">
            @csrf

            <div class="form-group">
                <label for="email">El. paštas</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="Įveskite savo el. paštą"
                >
                @error('email')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <label for="password">Slaptažodis</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="color: #667eea; text-decoration: none; font-size: 0.875rem;">
                            Pamiršai slaptažodį?
                        </a>
                    @endif
                </div>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Įveskite savo slaptažodį"
                >
                @error('password')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input
                        type="checkbox"
                        name="remember"
                        {{ old('remember') ? 'checked' : '' }}
                        style="margin-right: 0.5rem; width: auto; cursor: pointer;"
                    >
                    <span>Atsiminti mane</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem; font-size: 1rem; padding: 0.875rem;">
                Prisijungti
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; padding: 1.5rem; background: #f9f9f9; border-radius: 8px;">
            <p style="margin: 0; color: #666;">Dar neturi paskyros?</p>
            <a href="{{ route('register') }}" style="color: #667eea; text-decoration: none; font-weight: 600; font-size: 1.1rem;">
                Registruotis
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

        .alert p {
            margin: 0.5rem 0;
        }

        .alert p:first-child {
            margin-top: 0;
        }

        .alert p:last-child {
            margin-bottom: 0;
        }
    </style>
@endsection
