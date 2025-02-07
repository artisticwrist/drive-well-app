<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg table">
                <div class="p-6 text-gray-900">
                    <span style="display: flex; align-items:center; padding:5px 0px;">
                        <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ $feedback->name }}</h1>
                        <p style="margin-left: 5px;">{{ $feedback->email }}</p>
                    </span>
                    <p>{{ $feedback->phone_number }}</p>

                    <p style="margin: 20px 0px;">{{ $feedback->message }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
