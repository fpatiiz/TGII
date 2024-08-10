<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
  
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <div class="p-6 bg-white border-b border-gray-200">

            <h2 class="font-semibold text-lg text-gray-800 leading-tight">

                Quantidade de vendas: {{ $vendas->count() }}

            </h2>

            <h2 class="font-semibold text-lg text-gray-800 leading-tight">

                Níveis de estoque:

            </h2>

            <ul>

                @foreach($produtos as $produto)

                    <li>{{ $produto->nome }}: {{ $produto->quantidade }}</li>

                @endforeach

            </ul>

        </div>

    </div>

</div>

</div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Você está logado!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


