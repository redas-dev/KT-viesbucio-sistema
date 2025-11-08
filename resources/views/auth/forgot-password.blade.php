@extends('layouts.app')

@section('title', 'Pamiršau slaptažodį - Viešbutis')

@section('content')
    <div style="max-width: 600px; margin: 4rem auto; padding: 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; color: #667eea; margin-bottom: 0.5rem;">🔐 Pamiršai slaptažodį?</h1>
            <p style="color: #666;">Nesijaudink, mes padėsime tau jį atkurti</p>
        </div>

        <p style="color: #666; text-align: center; margin-bottom: 2rem;">
            Įrašyk savo el. pašto adresą žemiau, ir mes atsiųsime tau nuorodą slaptažodžio atstatymui.
        </p>

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

        <form method="POST" action="{{ route('password.email') }}" class="card">
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
                    placeholder="Įveskite savo el. pašto adresą"
                >
                @error('email')
                <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem; font-size: 1rem; padding: 0.875rem;">
                Siųsti nuorodą
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

        .alert p {
            margin: 0.5rem 0;
        }
    </style>
@endsection
