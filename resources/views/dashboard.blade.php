<x-app-layout>
    
    @include('intestazione_cliente')

    @php
    $dataOdierna = now();
    $dataOdiernaFormattata = $dataOdierna->format('Y-m-d');
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h1 class="titoli_pagine">Elenco dei prodotti disponibili</h1>
                    <h3 class="sottotitoli_pagine">Max <b><span style="font-size: larger; color: black;">{{ $numeroRimenenti }}</span></b> quantità prenotabile </h3>
                    <br>
                    <div class="mt-4 mb-4">
                    <input type="text" id="search" class="form-input rounded-md shadow-sm" placeholder="Cerca prodotto...">
                    </div>
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
                                    Prezzo (€)
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($prodotti as $prodotto)
                                @if ($prodotto->disponibilita > 0 && $prodotto->scadenza > $dataOdiernaFormattata)
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

                                        @if ($numeroRimenenti > 0)
                                    <form method="POST" action="{{ route('aggiungi_al_carrello') }}">
                                        @csrf
                                        <select class="form-select" name="quantita">
                                            @for ($i = 1;$i <= min($prodotto->disponibilita, $numeroRimenenti); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="prodotto_id" value="{{ $prodotto->id }}">
                                        <input type="hidden" name="azione" value="aggiungi">
                                        <button class="ml-3" type="submit">
                                            Prenota
                                        </button>
                                    </form>
                                    @endif

                                    </td>

                                </tr>
                                @endif
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