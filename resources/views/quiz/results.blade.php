<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">📊 کارنامه تست علاقه‌مندی‌ها</h2>
    </x-slot>

    @php
        $totalScore = collect($results)->sum('score');
        $percentage = round(($totalScore / 200) * 100);
    @endphp

    <div class="min-h-screen flex flex-col justify-center items-center bg-cover bg-center" style="background-image: url('{{ asset('images/dried-leaves-gray-blank-background_53876-102451.avif') }}');">
        <div class="rounded-2xl p-8 w-full max-w-5xl text-center">

            <h3 class="text-2xl font-bold mb-6 text-green-700">نتایج نهایی شما</h3>

            <div class="text-right bg-white/50 text-sm text-gray-800 leading-relaxed mb-10">
                <p class="mb-4 text-xl font-bold" dir="rtl">برای هر بخش (۵ سؤال)، حداکثر نمره ۲۰ و حداقل نمره ۵ است. جمع کل امتیازات آزمون ۲۰۰ خواهد بود.</p>
                <p class="text-lg font-semibold mb-2 text-indigo-800" dir="rtl">📌 تفسیر نمرات:</p>
                <ul class="bg-white/60 backdrop-blur-md p-4 rounded-lg shadow text-lg space-y-3 font-semibold text-gray-800">
                    <li  dir="rtl"> ۱۷ تا ۲۰: استعداد بالا در این زمینه</li>
                    <li dir="rtl"> ۱۲ تا ۱۶: استعداد متوسط که با تقویت رشد می‌کند</li>
                    <li dir="rtl"> ۵ تا ۱۱: نیاز به تمرین و توجه بیشتر</li>
                </ul>
            </div>

            <!-- ✅ نمودار -->
            <div class="mb-12">
                <h4 class="text-xl font-semibold text-blue-600 mb-4">📈 نمایش گرافیکی امتیازات</h4>
                <canvas id="resultChart" height="200"></canvas>
            </div>

            <!-- ✅ تحلیل بخش‌ها -->
            <div class="mt-4 flex flex-col justify-center items-center">
    <h4 class="text-2xl font-semibold text-blue-600 mb-6 text-center">🔍 تحلیل بخش‌ها</h4>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-items-center">
        @forelse ($results as $section => $data)
            <div class="bg-white/60 backdrop-blur-md rounded-xl shadow p-6 flex flex-col items-center space-y-4 w-full max-w-sm">
                <!-- عنوان سکشن (فقط در بالای بخش) -->
                <p class="font-bold text-xl w-full text-center mb-4">{{ $section }}</p>

                <!-- ردیف دایره پیشرفت و امتیاز و تفسیر -->
                <div class="flex items-center justify-between w-full space-x-4">
                    <!-- دایره پیشرفت (سمت چپ) -->
                    <div class="w-24 h-24 relative flex justify-center items-center">
    <svg width="96" height="96" viewBox="0 0 120 120" class="rotate-90">
        <defs>
            <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#34d399" />
                <stop offset="100%" stop-color="#10b981" />
            </linearGradient>
        </defs>
        <circle cx="60" cy="60" r="50" stroke="#e5e7eb" stroke-width="8" fill="none" />
        <circle cx="60" cy="60" r="50" stroke="url(#progressGradient)" stroke-width="8" fill="none"
                stroke-dasharray="314.16"
                stroke-dashoffset="{{ 314.16 - (314.16 * $data['score'] / 20) }}"/>
    </svg>
    <div class="absolute flex justify-center items-center w-full h-full text-lg font-bold text-gray-800 z-10 drop-shadow-sm">
        {{ round(($data['score'] / 20) * 100) }}%
    </div>
</div>


                    <!-- امتیاز و تفسیر (سمت راست) -->
                    <div class="text-right w-full max-w-[300px]">
                        <p class="text-sm text-gray-700">امتیاز: <span class="font-semibold">{{ $data['score'] }}</span></p>

                        @if (!empty($data['interpretation']))
                            <p class="font-semibold text-green-700 mt-2" dir="rtl">تفسیر:</p>
                            <p class="mb-1" dir="rtl">{{ $data['interpretation'] }}</p>
                        @endif
                    </div>
                </div>

                <!-- راهکارها (زیر تفسیر و امتیاز) -->
                @if (!empty($data['suggestions']))
                    <div class="text-xs text-gray-500 italic mt-4 w-full">
                        <p class="font-semibold text-blue-700 mt-2" dir="rtl">راهکارها:</p>
                        <ul class="list-disc pr-6 text-right space-y-2 text-lg">
                            @foreach ($data['suggestions'] as $tip)
                                <li class="text-base text-gray-700" dir="rtl">{{ $tip }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @empty
            <p class="col-span-full text-red-600 font-bold text-center">هیچ نتیجه‌ای یافت نشد.</p>
        @endforelse
    </div>
</div>


            <!-- جمع نهایی -->
            <div class="mt-10 p-4 bg-purple-100 border border-purple-300 rounded-lg text-right">
                <p class="text-xl font-bold text-purple-800">✅ جمع کل امتیازات شما:
                    <span class="text-purple-900">{{ $totalScore }}</span> از ۲۰۰
                </p>
                <p class="text-lg mt-2 text-purple-700">
                    📈 درصد موفقیت کلی:
                    <span class="font-semibold text-purple-900">{{ $percentage }}%</span>
                </p>
            </div>

            <a href="{{ route('quiz.show') }}" class="inline-block mt-8 px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                بازگشت به تست
            </a>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('resultChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($results)) !!},
                datasets: [{
                    label: 'امتیاز',
                    data: {!! json_encode(array_map(fn($item) => $item['score'], $results)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 20,
                        ticks: {
                            stepSize: 5
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</x-app-layout>
