<x-app-layout>
    {{-- 🎯 عنوان صفحه --}}
    <x-slot name="header">
        <h2 class="text-xl sm:text-2xl md:text-3xl text-center font-bold py-6 text-teal-900">
            📜 آخرین آزمون تکمیل شده
        </h2>
    </x-slot>

    {{-- 🔳 محتوای اصلی با فاصله از سایدبار راست --}}
    <div class="flex">

        {{-- ✅ سایدبار (در سمت راست و fixed) --}}
        <div id="main-wrapper">
    @include('layouts.components.imageHeader')
    @include('layouts.components.sidebar')
  </div>

        {{-- ✅ محتوای اصلی با فاصله از راست (به چپ رانده شده) --}}
        <div class="flex-1 lg:pr-[280px] pt-10 px-6 w-full">


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
                        <div class="card-text text-center text-base sm:text-lg md:text-xl text-gray-600 mb-4">
                            آزمون شما با موفقیت تکمیل شد.
                        </div>
                        <div class="card-text text-center text-lg sm:text-xl text-teal-600" style="direction: rtl; unicode-bidi: plaintext; font-family: Tahoma;">
                            تاریخ تکمیل: <span class="font-bold">{{ $completedExams->formatted_date }}</span>
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
         <footer>
<x-footer/>
</footer>
</x-app-layout>
