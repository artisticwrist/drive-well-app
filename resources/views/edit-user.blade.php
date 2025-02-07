<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <span>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Profile Information') }}
                                </h2>
                            </span>
                    
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </header>
                    
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>
                    
                        <form method="post" action="{{ route('update.user') }}" class="mt-6 space-y-6">
                            @csrf
                            <x-text-input id="id" name="id" type="hidden" :value="old('id', $user->id)" class="mt-1 block w-full" required autofocus autocomplete="id" />
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" class="mt-1 block w-full" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                    
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" :value="old('email', $user->email)" type="email" class="mt-1 block w-full" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="phone_number" :value="__('phone_number')" />
                                <x-text-input id="phone_number" name="phone_number" :value="old('phone_number', $user->phone_number)" type="text" class="mt-1 block w-full" required autofocus autocomplete="phone_number" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                            </div>
                    
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                    
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>                    
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
