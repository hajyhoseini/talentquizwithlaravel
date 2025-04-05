<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('شروع آزمون') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold">آزمون شماره {{ $id }} شروع شد!</h3>
                <p class="text-gray-600">سوالات آزمون در اینجا قرار می‌گیرند.</p>
            </div>
        </div>
    </div>
</x-app-layout>
