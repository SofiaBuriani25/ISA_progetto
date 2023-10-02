<x-app-layout>
        @include('intestazione_cliente')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h2 class="titoli_pagine">Storico prodotti prenotati</h2>
                    <br>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tipo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Quantità
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tot
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Pagato
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($prenotazioni as $prenotazione)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->prodotto->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->prodotto->tipo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->quantita }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prenotazione->quantita * $prenotazione->prodotto->prezzo }} € {{-- Moltiplica quantità per prezzo --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($prenotazione->pagato == 0)
                                        <span class="text-red-500">✘</span>
                                    @else
                                        <span class="text-green-500">✔</span>
                                    @endif
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
