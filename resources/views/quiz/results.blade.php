<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            🎉 {{ __('نتایج آزمون شما') }} 🎉
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl mt-8 text-center">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-8">🌟 نتایج آزمون شما 🌟</h2>

        @foreach ($results as $section => $data)
            <div class="bg-gradient-to-r from-yellow-300 to-pink-300 p-8 rounded-xl shadow-lg mb-8 hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ $section }} ✨</h3>
                <p class="text-lg text-gray-700 mb-3">📌 {{ $data['result'] }}</p>
                <p class="text-xl font-bold text-purple-600 mb-4">🎯 امتیاز: {{ $data['score'] }}</p>
                
                <div class="w-full border-t-2 border-dashed border-gray-300 mt-4 mb-4"></div>
                <p class="text-sm text-gray-500">نتیجه‌ی آزمون شما را می‌توانید در هر زمان مشاهده کنید. اگر بخواهید، می‌توانید دوباره امتحان کنید.</p>
            </div>
        @endforeach

        <div class="text-center mt-12">
            <a href="{{ route('quiz.show') }}" 
               class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-10 py-5 rounded-xl text-lg font-semibold shadow-lg transform hover:scale-110 hover:shadow-2xl transition-all duration-300 ease-in-out hover:rotate-3 active:scale-95">
                🎈 دوباره امتحان کن! 🚀
            </a>
        </div>
    </div>
</x-app-layout>
