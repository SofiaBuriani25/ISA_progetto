<x-app-layout>
    @include('intestazione_cliente')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h1 class="titoli_pagine">Elenco delle visite disponibili</h1>
                    <h3 class="sottotitoli_pagine">Puoi prenotare al massimo <span id="numero-visite-disponibili" style="font-size: larger; color: black;"><b> {{ $limitePrenotazioni - $numeroPrenotazioni }}</b></span> visite</h3>
                    <br>
                    <div class="mt-2 mb-4">
                    <input type="text" id="search" class="form-input rounded-md shadow-sm" placeholder="Cerca visita...">
                    </div>
                    <br>
                    <table class="min-w-full divide-y divide-gray-200" id="table">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tipologia
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Data/ora
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Medico
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Prezzo
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($visite as $visita)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $visita->tipologia }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $visita->dataVisita }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $visita->medico }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $visita->prezzo }} €
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($puoPrenotare)
                                    <form method="POST" action="{{ route('prenota_visita') }}">
                                        @csrf
                                        <input type="hidden" name="visita_id" value="{{ $visita->id}}">
                                        <input type="hidden" name="azione" value="aggiungi">
                                        <x-primary-button class="ml-3" type="submit" id="bottone">
                                            Prenota
                                        </x-primary-button>
                                    </form>
                                    @endif

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
                                <br>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                 <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tipologia
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Data/ora
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Medico
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Prezzo
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @foreach ($prenotazioni as $prenotazione)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->tipologia }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->dataVisita }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->medico }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->prezzo }} €
                                    </td>

                                    <td>
                        <form method="POST" action="{{ route('visite.cancel', $prenotazione->id) }}">
                            @csrf
                            @method('DELETE')
                            
                            <button class="delete-button">X</button>
                        </form>
                    </td>

                                </tr>
                                @endforeach

                                
                        </tbody>
                    </table>
       
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/ricerca.js') }}"></script>

   
</x-app-layout>
