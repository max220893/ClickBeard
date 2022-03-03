<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach ($agendamentos as $agendamento)
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ date('d/m/Y H:i', strtotime($agendamento->data)) }}</div>
                    <p class="text-gray-700 text-base">
                        Nome -> {{ $agendamento->usuario->nome }}
                    </p>
                    <p class="text-gray-700 text-base">
                        Barbeiro -> {{ $agendamento->barbeiro->nome }}
                    </p>
                    <p class="text-gray-700 text-base">
                        Especialidade -> {{ $agendamento->especialidade->nome }}
                    </p>
                    <p class="text-gray-700 text-base">
                        <a href="/" class="btn btn-danger" onclick="
                                            var result = confirm('Tem certeza que deseja apagar?');

                                            if(result){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $agendamento->id }}').submit();
                                            }">
                            Apagar
                        </a>

                    <form method="POST" id="delete-form-{{ $agendamento->id }}"
                        action="{{ route('agendamentos.destroy', [$agendamento]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                    </p>
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>
