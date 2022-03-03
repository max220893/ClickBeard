<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialidades') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <a href="{{ route('especialidades.create') }}" class="ml-4">
                <x-button class="ml-4 mb-2">
                    {{ __('Cadastrar') }}
                </x-button>
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    @if (count($especialidades) > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Nome
                                    </th>
                                    <th scope="col" class="relative py-3 px-6">
                                        <span class="sr-only"></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especialidades as $especialidade)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $especialidade->id }}</td>
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $especialidade->nome }}</td>
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="{{ route('especialidades.edit', [$especialidade]) }}">
                                                Editar
                                            </a>
                                        </td>
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="/" class="btn btn-danger" onclick="
                                            var result = confirm('Tem certeza que deseja apagar?');

                                            if(result){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $especialidade->id }}').submit();
                                            }">
                                                Apagar
                                            </a>

                                            <form method="POST" id="delete-form-{{ $especialidade->id }}"
                                                action="{{ route('especialidades.destroy', [$especialidade]) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Não há registros</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
