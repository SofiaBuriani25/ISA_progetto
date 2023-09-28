
@php
    $isMostraPrenotazioni = request()->routeIs('mostra-prenotazioni');
@endphp
    
    <x-slot name="header">
    <a href="{{ route('dashboard') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text_navbar">
            {{ __('Dashboard Cliente') }} | 
            <a href="{{ route('mostra-prenotazioni') }}" class="{{ request()->routeIs('mostra-prenotazioni') ? 'highlight-link' : '' }}">
                {{ __('Storico ordini') }}
            </a>
        </h2>
    </x-slot>
