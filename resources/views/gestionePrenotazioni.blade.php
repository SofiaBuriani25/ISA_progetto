<x-app-layout>
    
@include('intestazione_dipendente')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                
               <h1 class="titoli_pagine">Lista delle prenotazioni dei clienti</h1>
               <h3 class="sottotitoli_pagine"> Per ogni prodotto seleziona se il cliente a pagato oppure no.</h3>
               <br>
               <div class="mt-4 mb-4">
                    <input type="text" id="search" class="form-input rounded-md shadow-sm" placeholder="Cerca cliente o prodotto...">
                    </div>
                <br>
                   
               <table class="min-w-full divide-y divide-gray-200" id="table">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome e Cognome
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Prodotto
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Quantità
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tot
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($prenotazioni as $prenotazione)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->cliente->name }} {{ $prenotazione->cliente->cognome }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->prodotto->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->quantita }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->quantita * $prenotazione->prodotto->prezzo }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <form method="POST" action="{{ route('elimina_prenotazione', ['id' => $prenotazione->id]) }}">
                                        @csrf
                                        <button class="delete-button mr-5">✘</button>
                                    </form>
                            
                                    <form method="POST" action="{{ route('conferma_pagamento', ['id' => $prenotazione->id]) }}">
                                        @csrf
                                        <button class="add-button">✔</button>
                                    </form>
                                </div>
                                    
                                </td>
                                </tr>
                        
                            @endforeach

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                <br>
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
