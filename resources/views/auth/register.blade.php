<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="nome" :value="__('Nome')" />

                <x-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="senha" :value="__('Senha')" />

                <x-input id="senha" class="block mt-1 w-full"
                                type="password"
                                name="senha"
                                required autocomplete="new-senha" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="senha_confirmation" :value="__('Confirmar Senha')" />

                <x-input id="senha_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="senha_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já está cadastrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
