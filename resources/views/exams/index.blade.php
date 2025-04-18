<x-app-layout> 
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">
            🧪 {{ __('آزمون‌های موجود') }}
        </h2>
    </x-slot>

    <div class="py-8 flex justify-center items-center min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/top-view-keyboard-desk-with-succulent-plant-sticky-notes.jpg');">
        <div class=" w-5/6   bg-opacity-90 p-6 rounded-xl border text-center">
            <h3 class=" w-4/6 font-bold text-gray-800 mb-6 bg-white/70 py-5 rounded-md text-4xl">📋 لیست آزمون‌ها</h3>

            @foreach ($exams as $exam)
                <div class="border rounded-lg p-4 mb-6 text-right bg-white/70">
                    <h4 class="text-3xl font-semibold text-gray-900 mb-2">{{ $exam->title }}</h4>
                    <p class="text-gray-700 text-3xl mb-4  leading-relaxed">
                        {{ $exam->description }}
                    </p>
                    <div class="text-left w-full">
                        <a href="{{ route('exams.show', $exam->id) }}" 
                           class="inline-block text-xl bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-md  font-semibold transition">
                            🚀 شروع آزمون
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
