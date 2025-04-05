<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            🎉 {{ __('نتایج آزمون MBTI') }} 🎉
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6 text-center">
        <h2 class="text-3xl font-bold text-indigo-600 mb-6">🌟 نتایج آزمون شما 🌟</h2>

        <div class="p-8 shadow-lg rounded-lg bg-gradient-to-r from-teal-200 to-blue-300">
            <h2 class="text-2xl font-bold text-black mb-6">نتایج آزمون شما</h2>

            <div class="mt-6">
                <div class="text-lg font-semibold text-indigo-800">شیوه تعامل با دنیا:</div>
                <div class="text-xl font-medium text-gray-700">{{ $result['E_I'] }}</div>
            </div>
            <div class="mt-4">
                <div class="text-lg font-semibold text-indigo-800">حسی (S) / شهودی (N):</div>
                <div class="text-xl font-medium text-gray-700">{{ $result['S_N'] }}</div>
            </div>
            <div class="mt-4">
                <div class="text-lg font-semibold text-indigo-800">تفکری (T) / احساسی (F):</div>
                <div class="text-xl font-medium text-gray-700">{{ $result['T_F'] }}</div>
            </div>
            <div class="mt-4">
                <div class="text-lg font-semibold text-indigo-800">قضاوتی (J) / ادراکی (P):</div>
                <div class="text-xl font-medium text-gray-700">{{ $result['J_P'] }}</div>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('quiz.show') }}" 
               class="bg-gradient-to-r from-green-300 to-blue-400 text-white px-8 py-3 rounded-full text-lg shadow-lg 
                      hover:scale-110 transition transform hover:shadow-xl animate-pulse">
                🎈 دوباره امتحان کن! 🎉
            </a>
        </div>
    </div>
</x-app-layout>
