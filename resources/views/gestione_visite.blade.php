<x-app-layout>
        @include('intestazione_dipendente')

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h1 class="titoli_pagine">Elenco delle visite disponibili</h1>
                    <h3 class="sottotitoli_pagine"> Visualizza tutte le visite comprese le prenotazioni. </h3>
                    <br>
                    <div class="mt-1 mb-2">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Prenotata da:
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
                                    @if ($visita->cliente)
                                        {{ $visita->cliente->name }}  {{ $visita->cliente->cognome }}  <br>
                                        CF: {{ $visita->cliente->codicefiscale }} 
                                    @endif
                                    </td>
                                </tr>
                                
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

                    
    <div class="py-3 mt-[-40px] ">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-8 mb-3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-3">
                <div class="p-2 text-gray-900 dark:text-gray-100 mb-3">

    <h1 class="titoli_pagine">Aggiungi una nuova visita</h1>
    <form action="{{ route('aggiungi_visita') }}" method="POST">
        @csrf
        <table class="min-w-full divide-y">
            <tr>
                <td class="px-6 py-3 whitespace-nowrap "><label for="tipologia">Tipologia:</label></td>
                <td class="px-6 py-3 whitespace-nowrap "><label for="dataVisita">Data:</label></td>
                <td class="px-6 py-3 whitespace-nowrap "><label for="medico" >Medico:</label></td>
                <td class="px-6 py-3 whitespace-nowrap "><label for="prezzo">Prezzo:</label></td>
            </tr>
            <tr>
            <td class="px-4 py-2 whitespace-nowrap "><input type="text" name="tipologia" required></td>
            <td class="px-4 py-2 whitespace-nowrap "><input type="datetime-local" name="dataVisita" required></td>
            <td class="px-4 py-2 whitespace-nowrap "><input type="text" name="medico" required></td>
            <td class="px-4 py-2 whitespace-nowrap w-5 "><input type="number" name="prezzo" step="0.01" required ></td>
            <td class="px-4 py-2 whitespace-nowrap w-5">
            <input type="hidden" name="visita_id" value="{{ $visita->id }}">
                                        <input type="hidden" name="azione" value="aggiungi">
                                        <button class="ml-1" type="submit" id="bottone">
                                            Aggiungi visita
                                        </button>
            </td>
            </tr>

        </table>
    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/ricerca.js') }}"></script>
</x-app-layout>
