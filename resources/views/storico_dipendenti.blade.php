<x-app-layout>
        @include('intestazione_dipendente')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h2 class="titoli_pagine">Storico prodotti ordinati</h2>
                    <br>


                    <h1>Tabella Ordini Dipendenti</h1>

    <table>
        <thead>
            <tr>
                <th>Dipendente ID</th>
                <th>Nome Dipendente</th>
                <th>Cognome Dipendente</th>
                <th>Nome Prodotto</th>
                <th>Quantità</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordiniDipendenti as $ordine)
                <tr>
                    <td>{{ $ordine->dipendente_id }}</td>
                    <td>{{ $ordine->dipendente->name }}</td>
                    <td>{{ $ordine->dipendente->cognome }}</td>
                    <td>{{ $ordine->prodotto->name }}</td>
                    <td>{{ $ordine->quantita }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>










                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Dipendente
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome Prodotto
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tipo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Quantità 
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($ordini as $ordini)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $ordini->dipendente_id}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $ordini->prodotto_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                       CIAOCIAO <!-- {{ $ordini->prodotto->tipo}} -->
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $ordini->quantita }}

                                    </td>

                                
                                </tr>
                        
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
