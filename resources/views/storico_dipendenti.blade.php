<x-app-layout>
        @include('intestazione_dipendente')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h2 class="titoli_pagine">Storico prodotti ordinati</h2>
                    <br>

                    <table class="min-w-full divide-y divide-gray-200" id="table">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID Dipendente
                            </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome Dipendente
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Cognome Dipendente
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome Prodotto
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Quantità
                                </th>
                                </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach($ordini as $ordine)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ordine->dipendenti_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ordine->dipendenti->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ordine->dipendenti->cognome }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ordine->prodotto->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ordine->quantita }}
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
