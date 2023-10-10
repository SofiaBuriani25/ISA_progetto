<x-app-layout>
    <!--
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <a href="{{ route('dipendente_home') }}" class="text-gray-800 dark:text-gray-200">{{ __('Dashboard') }} Ciao</a>
            | Prodotti da ordinare
        </h2>
    </x-slot>
-->

    @include('intestazione_dipendente')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h1 class="titoli_pagine">Elenco dei prodotti da ordinare</h1>
                    <br>
                    <div class="mt-4 mb-4">
                    <input type="text" id="search" class="form-input rounded-md shadow-sm" placeholder="Cerca prodotto...">
                    </div>
                   
                    <br>
                    <table class="min-w-full divide-y divide-gray-200" id="table">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tipo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Prezzo (€)
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Quantità disponibile
                                </th>
                                <th class="px-1 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Quantità da ordinare
                                </th>
                              
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($prodotti as $prodotto)
                                @if ($prodotto->disponibilita <= 5)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->tipo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->prezzo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->disponibilita }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        
                                    <form method="POST" action="{{ route('ordina_prodotto') }}">
                                        @csrf
                                        <input type="number" class="form-control" name="quantita" min="1"  style="width:100px">

                                        <input type="hidden" name="prodotto_id" value="{{ $prodotto->id }}">
                                        <input type="hidden" name="azione" value="aggiungi">
                                        <x-primary-button class="ml-3" type="submit">
                                            Aggiungi disponibilità
                                        </x-primary-button>
                                    </form>

                                    </td>

                                </tr>
                                @endif
                            @endforeach
                            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/ricerca.js') }}"></script>
</x-app-layout>

