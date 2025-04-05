<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            🧪 {{ __('آزمون‌های موجود') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-4xl w-full bg-white shadow-lg rounded-2xl p-8 text-center">
            <h3 class="text-2xl font-bold text-purple-700 mb-10">📋 لیست آزمون‌ها</h3>

            <!-- آزمون استعدادیابی کودکان -->
            <div class="bg-gradient-to-r from-yellow-100 to-pink-100 border-l-8 border-yellow-400 p-6 mb-8 rounded-xl shadow-md hover:shadow-xl transition-all">
                <h4 class="text-xl font-bold text-gray-800 mb-3">🎨 آزمون استعدادیابی کودکان</h4>
                <p class="text-gray-700 mb-4 leading-relaxed">
                    این آزمون به شناسایی استعدادهای مختلف کودکان در زمینه‌های موسیقیایی، حرکتی، تحلیلی و... کمک می‌کند.
                </p>
                <a href="{{ route('quiz.show') }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-full text-lg font-bold transition transform hover:scale-105 shadow-md">
                    🚀 شروع آزمون
                </a>
            </div>

            <!-- آزمون MBTI -->
            <div class="bg-gradient-to-r from-purple-100 to-indigo-100 border-l-8 border-purple-400 p-6 rounded-xl shadow-md hover:shadow-xl transition-all">
                <h4 class="text-xl font-bold text-gray-800 mb-3">🧠 آزمون MBTI</h4>
                <p class="text-gray-700 mb-4 leading-relaxed">
                    آزمونی برای شناسایی تیپ شخصیتی شما بر اساس مدل معروف MBTI شامل ۴ بعد اصلی شخصیت.
                </p>
                <a href="{{ route('mbti.quiz') }}" 
                   class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-full text-lg font-bold transition transform hover:scale-105 shadow-md">
                    🔍 شروع آزمون
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
