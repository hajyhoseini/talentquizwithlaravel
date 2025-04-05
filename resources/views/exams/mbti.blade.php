<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            🎯 {{ __('آزمون‌ها') }} 🎯
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-4xl w-full bg-white shadow-xl rounded-2xl p-8 text-center">
            <h3 class="text-3xl font-bold text-blue-600 mb-8">آزمون استعدادیابی MBTI</h3>

            <div class="bg-gradient-to-r from-yellow-300 to-pink-400 p-8 rounded-2xl shadow-2xl mb-8 transition-all duration-300 ease-in-out hover:shadow-xl hover:scale-105">
                <h4 class="text-2xl font-semibold text-gray-800 mb-4">آزمون MBTI</h4>
                <p class="text-lg text-gray-600 mb-6">
                    این آزمون شامل ۴ بخش است و به شما کمک می‌کند که نوع شخصیت خود را از بین ۱۶ تیپ شخصیتی MBTI شناسایی کنید.
                    بخش‌ها شامل برون‌گرایی/درون‌گرایی، حسی/شهودی، تفکری/احساسی، و قضاوتی/ادراکی هستند.
                </p>
                <a href="{{ route('quiz.start', ['type' => 'mbti']) }}" 
                   class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-4 rounded-xl text-lg font-bold block w-1/3 mx-auto transition-all duration-300 transform hover:scale-110 hover:shadow-xl">
                    🧠 شروع آزمون
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
