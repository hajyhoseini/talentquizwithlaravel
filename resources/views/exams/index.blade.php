<x-app-layout> 
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">
            🧪 {{ __('آزمون‌های موجود') }}
        </h2>
    </x-slot>

    <div class="py-8 flex justify-center items-center min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/low-angle-view-plant-against-clear-sky_1048944-23925059.avif');">
        <div class="w-full max-w-2xlbg-white bg-opacity-90 p-6 rounded-xl border text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-6 bg-white/50 py-3 rounded-md">📋 لیست آزمون‌ها</h3>

            @foreach ($exams as $exam)
                <div class="border rounded-lg p-4 mb-6 text-right bg-gray-50/50">
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $exam->title }}</h4>
                    <p class="text-gray-700 mb-4 text-base leading-relaxed">
                        {{ $exam->description }}
                    </p>
                    <div class="text-left">
                        <a href="{{ route('exams.show', $exam->id) }}" 
                           class="inline-block bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-md text-sm font-semibold transition">
                            🚀 شروع آزمون
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
