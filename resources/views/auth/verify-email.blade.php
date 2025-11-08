@extends('layouts.app')

@section('title', 'Patvirtinti El. paštą - Viešbutis')

@section('content')
    <div style="max-width: 400px; margin: 4rem auto; padding: 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; color: #667eea; margin-bottom: 0.5rem;">✉️ Patvirtink savo el. paštą</h1>
            <p style="color: #666;">Jau beveik! Reikia tik patvirtinti tavo el. paštą</p>
        </div>

        <div style="padding: 1.5rem; background: #f0f7ff; border-radius: 8px; border-left: 4px solid #667eea; margin-bottom: 2rem;">
            <p style="color: #0052cc; margin: 0;">
                Mes jau išsiuntėme el. laišką su patvirtinimo nuoroda į tavo nurodytą el. pašto adresą.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                ✓ Nauja patvirtinimo nuoroda buvo išsiųsta į tavo el. pašto adresą.
            </div>
        @endif

        <div class="card">
            <form method="POST" action="{{ route('verification.store') }}">
                @csrf
                <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1rem; padding: 0.875rem;">
                    Persiųsti patvirtinimo el. laišką
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
                @csrf
                <button type="submit" class="btn btn-secondary" style="width: 100%; font-size: 1rem; padding: 0.875rem;">
                    Atsijungti
                </button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 2rem; padding: 1.5rem; background: #f9f9f9; border-radius: 8px;">
            <p style="color: #666; margin: 0.5rem 0;">
                <strong>Negavai laiško?</strong>
            </p>
            <ul style="color: #999; font-size: 0.875rem; text-align: left; display: inline-block; margin: 0.5rem 0;">
                <li>Patikrink 'Spam' aplanką</li>
                <li>Įsitikink, kad teisingai įvedei el. paštą</li>
                <li>Pabandyk pernaują išsiųsti nuorodą</li>
            </ul>
        </div>
    </div>

    <style>
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert p {
            margin: 0;
        }
    </style>
@endsection
