<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barbeiros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('barbeiros.update', $barbeiro) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Name -->
                        <div>
                            <x-label for="nome" :value="__('Nome')" />

                            <x-input id="nome" class="block mt-1 w-full" type="text" name="nome"
                                value="{{ $barbeiro->nome }}" required autofocus />
                        </div>
                        <div class="mt-2">
                            <x-label for="idade" :value="__('Idade')" />

                            <x-input id="idade" class="block mt-1 w-full" type="number" name="idade" step="1"
                                value="{{ $barbeiro->idade }}" required autofocus />
                        </div>
                        <div class="mt-2">
                            <x-label for="data_contratacao" :value="__('Data Contratação')" />

                            <x-input id="data_contratacao" class="block mt-1 w-full" type="date" name="data_contratacao"
                                value="{{ $barbeiro->data_contratacao }}" required autofocus />
                        </div>
                        <div class="mt-2">
                            <x-label for="especialidades" :value="__('Especialidades')" />
                            <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="especialidades" name="especialidades[]" multiple="multiple" required autofocus>
                                @foreach ($especialidades as $especialidade)
                                    <option value="{{ $especialidade->id }}"
                                        @if (in_array($especialidade->id, $barbeiroEspecialidades)) selected @endif>{{ $especialidade->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Editar
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
