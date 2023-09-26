 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} Ciao
            <a href="{{ route('daOrdinare') }}" class="text-gray-800 dark:text-gray-200">| Prodotti da ordinare</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                
                    <h3 class="text-2xl mt-4">Elenco dei prodotti disponibili</h3>
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
                                    Prezzo
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
                                        {{ $prodotto->prezzo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select class="form-select" name="quantita">
                                            @for ($i = 0; $i <= $prodotto->disponibilita; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="{{ route('aggiungi_al_carrello') }}">
                                            @csrf
                                            <input type="hidden" name="prodotto_id" value="{{ $prodotto->id }}">
                                            <input type="hidden" name="azione" value="aggiungi">
                                                <x-primary-button class="ml-3" type="submit">
                                                    Aggiungi al carrello
                                                </x-primary-button>
                                        </form>
                                    </td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



</x-app-layout>

