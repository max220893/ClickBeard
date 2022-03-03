<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialidades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('agendamentos.store') }}">
                        @csrf
                        <div>
                            <x-label for="data" :value="__('Data')" />

                            <x-input id="data" class="block mt-1 w-full" type="date" min="{{ date('Y-m-d') }}"
                                name="data" :value="old('data')" required autofocus />
                        </div>
                        <div class="mt-2">
                            <x-label for="horario" :value="__('Horário')" />

                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="horario" id="horario" required autofocus>
                                <option>Selecione</option>
                                @foreach ($horarios as $horario)
                                    <option value="{{ $horario }}">{{ $horario }}</option>
                                @endforeach>
                            </select>
                        </div>

                        <div class="mt-2">
                            <x-label for="especialidade" :value="__('Especialidades')" />
                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="especialidade" name="especialidade" required
                                autofocus>
                                <option>Selecione</option>
                                @foreach ($especialidades as $especialidade)
                                    <option value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-2">
                            <x-label for="barbeiro" :value="__('Barbeiro')" />
                            <select
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="barbeiro" name="barbeiro" required autofocus>
                                <option value="">Selecione os filtros acima</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4 btn-agendamento">
                                Cadastrar
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
