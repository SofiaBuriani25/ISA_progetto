
@php
    $isMostraPrenotazioni = request()->routeIs('mostra-prenotazioni');
    $isDashboard = request()->routeIs('dashboard');
@endphp

    
    <x-slot name="header">
    <a href="{{ route('dashboard') }}" class="{{ $isDashboard ? 'highlight-link' : '' }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text_navbar">
            {{ __('Dashboard Cliente') }} | 
            <a href="{{ route('mostra-prenotazioni') }}" class="{{ $isMostraPrenotazioni ? 'highlight-link' : '' }}">
                {{ __('Storico ordini') }} |
            </a>
            <a href="{{ route('visite') }}" class="{{ request()->routeIs('visite') ? 'highlight-link' : '' }}">
                {{ __('Prenota visita') }}
            </a>
        </h2>
    </x-slot>
