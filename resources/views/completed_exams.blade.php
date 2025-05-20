<x-app-layout>
    {{-- 🎯 عنوان صفحه --}}
    <x-slot name="header">
        <h2 class="text-xl sm:text-2xl md:text-3xl text-center font-bold py-6 text-teal-900">
            📜 آخرین آزمون تکمیل شده
        </h2>
    </x-slot>

    {{-- 🔳 محتوای اصلی با فاصله از سایدبار راست --}}
   
        {{-- ✅ سایدبار (در سمت راست و fixed) --}}
        <div id="main-wrapper">
            @include('layouts.components.imageHeader')
            @include('layouts.components.sidebar')
        
 <div class="content-body">
    <div class="container-fluid">
        {{-- ✅ محتوای اصلی با فاصله از راست (به چپ رانده شده) --}}
    <div class="mx-auto w-full mt-10 mb-8 text-center bg-gradient-to-br from-white/70 to-teal-50/60 backdrop-blur-xl border border-teal-200 rounded-3xl shadow-xl relative overflow-hidden transition duration-300 hover:shadow-2xl text-sm sm:text-base">
            @if ($completedExams)
                <div class="mx-auto max-w-4xl mt-10 mb-8 text-center bg-gradient-to-br from-white/70 to-teal-50/60 backdrop-blur-xl border border-teal-300 rounded-3xl p-6 sm:p-7 shadow-xl relative overflow-hidden transition duration-300 hover:shadow-2xl text-sm sm:text-base">
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-teal-800 mb-4 sm:mb-6">
                        📜 آخرین آزمون تکمیل شده
                    </h2>
                    <p class="text-sm sm:text-base md:text-lg text-gray-700 leading-relaxed sm:leading-loose font-medium mb-6">
                        شما آخرین آزمون خود را با موفقیت تکمیل کرده‌اید!
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    {{-- کارت ۱ --}}
                    <div class="card bg-white rounded-2xl shadow-lg p-6">
                        @if ($completedExams->image)
                            <div class="mt-4 mb-6">
                                <img src="{{ asset($completedExams->image) }}" alt="{{ $completedExams->title }}" class="mx-auto w-full h-32 object-cover rounded-lg shadow-lg">
                            </div>
                        @endif

                        <div class="card-title text-center text-2xl sm:text-3xl font-semibold text-teal-700 mb-4">
                            {{ $completedExams->title }}
                        </div>
                       
                        <div class="card-text text-center text-xs sm:text-sm text-gray-600 mt-2" style="direction: rtl; unicode-bidi: plaintext; font-family: Tahoma;">
                     تاریخ تکمیل: <span class="font-bold">{{ $completedExams->formatted_date }}</span>
                        </div>

                        {{-- دکمه ادامه در پایین کارت --}}
                        <div class="flex justify-center mt-6">
            <a href="{{ route('user.results', ['quizId' => $completedExams->id]) }}" id="next-button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition duration-300">
    دیدن کارنامه 
</a>


                        </div>
                    </div>

                    {{-- کارت ۲ --}}
                    <div class="card bg-white rounded-2xl shadow-lg p-6">
                        <p class="text-center text-xl text-gray-600">کارت دوم</p>
                    </div>

                    {{-- کارت ۳ --}}
                    <div class="card bg-white rounded-2xl shadow-lg p-6">
                        <p class="text-center text-xl text-gray-600">کارت سوم</p>
                    </div>
                </div>

            @else
                <p class="text-center text-gray-500 mt-10">هیچ آزمونی تکمیل نشده است.</p>
            @endif

            @include('layouts.components.faq')
             <footer>
        <x-footer/>
    </footer>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.querySelectorAll('.contact-button').forEach((button) => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                answer.classList.toggle('hidden');
            });
        });

        document.querySelectorAll('.faq-question').forEach((question) => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.classList.toggle('hidden');
            });
        });
    </script>
<style>
        body {
      margin: 0;
      font-family: 'Vazirmatn', sans-serif;
      background: linear-gradient(135deg, #e0f8f7, #f5ffff);
      min-height: 100vh;
      color: #333;
    }

</style>
   
</x-app-layout>
