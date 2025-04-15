<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-center font-semibold text-gray-800">
            {{ __('صفحه شما خانواده بنیاد ملل') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex justify-center items-center px-4 sm:px-6"
         style="
            background-image: url('/images/dried-leaves-gray-blank-background_53876-102451.avif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: right center;
        ">
        
        <div class="bg-white/30 rounded-lg p-6 sm:p-8 text-center backdrop-blur-md w-full max-w-xl">
            <p class="text-gray-700 mb-6 font-bold text-3xl">
.                به صفحه آزمون‌های بنیاد ملل خوش آمدید
</p>

            <!-- دکمه رفتن به آزمون‌ها -->
            <a href="{{ route('exams.index') }}"
               class="border-2 border-green-500 text-green-600 bg-transparent hover:bg-green-500 hover:text-white transition py-3 rounded-lg font-bold block w-full sm:w-1/2 mx-auto mb-4 text-2xl">
                رفتن به آزمون‌ها
            </a>

            <!-- دکمه ساخت آزمون جدید -->
            <!-- <a href="{{ route('quiz.builder') }}"
               class="border-2 border-blue-500 text-blue-600 bg-transparent hover:bg-blue-500 hover:text-white transition py-3 rounded-lg font-bold block w-full sm:w-1/2 mx-auto mb-4 text-2xl">
                ساخت آزمون
            </a> -->

            <!-- فرم خروج -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="border-2 border-red-500 text-red-600 bg-transparent hover:bg-red-500 hover:text-white transition py-3 rounded-lg font-bold block w-full sm:w-1/2 mx-auto text-2xl">
                    خروج از حساب کاربری
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
