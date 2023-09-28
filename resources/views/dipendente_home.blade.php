 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Dipendente') }} 
            <a href="{{ route('daOrdinare') }}" class="text-gray-800 dark:text-gray-200">| Prodotti da ordinare</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h1 class="text-2xl mt-4">Elenco dei prodotti disponibili</h1>
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
                                    Disponibilità
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Prezzo (€)
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($prodotti as $prodotto)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->tipo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->disponibilita }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $prodotto->prezzo }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        
                                    <form method="POST" action="{{ route('aggiungi_al_carrello') }}">
                                        @csrf
                                        <select class="form-select" name="quantita">
                                            @for ($i = 0;$i <= min($prodotto->disponibilita, 3); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="prodotto_id" value="{{ $prodotto->id }}">
                                        <input type="hidden" name="azione" value="aggiungi">
                                        <x-primary-button class="ml-3" type="submit">
                                            Venduto
                                        </x-primary-button>
                                    </form>

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

                  
    <div class="py-6 mt-[-40px]">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">

    <h1 class="text-2xl mt-2">Aggiungi un nuovo prodotto</h1>
    <form action="{{ route('aggiungiProdotto') }}" method="POST">
        @csrf
        <table class="my-1">
            <tr>
                <td class="px-2 py-2 whitespace-nowrap "><label for="name">Nome:</label></td>
                <td class="px-2 py-2 whitespace-nowrap "><label for="tipo">Tipo:</label></td>
                <td class="px-2 py-2 whitespace-nowrap "><label for="scadenza" >Scadenza:</label></td>
                <td class="px-2 py-2 whitespace-nowrap "><label for="disponibilita">Quantità:</label></td>
                <td class="px-2 py-2 whitespace-nowrap "><label for="prezzo">Prezzo:</label></td>
                <td class="px-2 py-2 whitespace-nowrap "><label for="descrizione">Descrizione:</label></td>

            </tr>
            <tr>
            <td class="px-1 py-2 whitespace-nowrap "><input type="text" name="name" required></td>
            <td class="px-1 py-2 whitespace-nowrap "><input type="text" name="tipo" required></td>
            <td class="px-1 py-2 whitespace-nowrap "><input type="date" name="scadenza" required></td>
            <td class="px-1 py-2 whitespace-nowrap w-5"><input type="number" name="disponibilita" required class="w-30"></td>
            <td class="px-1 py-2 whitespace-nowrap w-5 "><input type="number" name="prezzo" step="0.01" required class="w-20"></td>
            <td class="px-1 py-2 whitespace-nowrap "><input type="text" name="descrizione" ></td>
            </tr>

        </table>
        <div style="text-align: right;">
        <input type="hidden" name="prodotto_id" value="{{ $prodotto->id }}">
                                        <input type="hidden" name="azione" value="aggiungi">
                                        <x-primary-button class="ml-3" type="submit">
                                            Aggiungi prodotto
                                        </x-primary-button>
        </div>
    </form>

    </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/ricerca.js') }}"></script>
</x-app-layout>

