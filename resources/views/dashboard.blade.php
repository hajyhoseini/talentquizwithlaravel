<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('صفحه شما خانواده بنیاد ملل ') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-4xl w-full bg-white shadow-md rounded-lg p-6 text-center">
            <p class="text-lg text-gray-700 font-semibold mb-6">
                ❤️ به صفحه آزمون های بنیاد ملل خوش آمدید
            </p>

            <!-- دکمه رفتن به آزمون‌ها -->
            <a href="{{ route('exams.index') }}" 
               class="bg-green-600 text-white px-8 py-4 rounded-lg text-lg font-bold block w-1/3 mx-auto mb-6 transition transform hover:scale-105 hover:shadow-lg">
                رفتن به آزمون‌ها
            </a>

            <!-- فرم خروج -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="bg-red-500 text-white px-8 py-4 rounded-lg text-lg font-bold block w-1/3 mx-auto transition transform hover:scale-105 hover:shadow-lg">
                    خروج از حساب کاربری
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
