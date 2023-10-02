
@php
    $isDaOrdinare = request()->routeIs('daOrdinare');
    $isDipendenteHome = request()->routeIs('dipendente_home');
   
@endphp

    
    <x-slot name="header">
    <a href="{{ route('dipendente_home') }}" class="{{ $isDipendenteHome ? 'highlight-link' : '' }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text_navbar">
            {{ __('Dashboard Dipendente') }} | 
            <a href="{{ route('gestionePrenotazioni') }}" class="{{ request()->routeIs('gestionePrenotazioni') ? 'highlight-link' : '' }}">
                {{ __('Prenotazioni dei Clienti') }} |
            </a>
            <a href="{{ route('daOrdinare') }}" class="{{ request()->routeIs('daOrdinare') ? 'highlight-link' : '' }}">
                {{ __('Prodotti da Ordinare') }} |
            </a>
            <a href="{{ route('storico_dipendenti') }}" class="{{ request()->routeIs('storico_dipendenti') ? 'highlight-link' : '' }}">
                {{ __('Storico Ordini') }} 
            </a>
        </h2>
    </x-slot>
