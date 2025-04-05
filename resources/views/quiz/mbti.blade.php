<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            شروع آزمون MBTI
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">آزمون MBTI</h3>
                <p class="text-gray-600">در این بخش، شما به سوالات آزمون MBTI پاسخ خواهید داد.</p>

                <a href="{{ route('mbti.quiz.questions') }}" 
                   class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">
                    شروع پاسخگویی
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
