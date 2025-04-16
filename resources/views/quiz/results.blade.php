<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">📊 کارنامه تست علاقه‌مندی‌ها</h2>
    </x-slot>

    @php
        $totalScore = collect($results)->sum('score');
        $percentage = round(($totalScore / 200) * 100);
    @endphp

    <div class="min-h-screen flex flex-col justify-center items-center bg-cover bg-center" style="background-image: url('{{ asset('images/blank-document-with-paper-clip-toy-model-house_441362-1186.jpg') }}');">
        <div class="rounded-2xl p-8 w-full max-w-5xl text-center">

            <!-- 🟧 توضیحات نمره‌دهی -->
            <h3 class="text-3xl font-extrabold mb-6 text-white/80 text-center text-white p-3 rounded-lg bg-[#fb8c00]">📊 نتایج نهایی شما</h3>
            <div class="p-5 text-right rounded-2xl bg-yellow-50/70 backdrop-blur-md shadow-md mb-10 text-gray-800 leading-relaxed space-y-4" style="direction: rtl;">
                <p class="text-2xl font-extrabold text-black">برای هر بخش (۵ سؤال)، حداکثر نمره ۲۰ و حداقل نمره ۵ است. جمع کل امتیازات آزمون ۲۰۰ خواهد بود.</p>
                <p class="text-xl font-bold text-amber-700">📌 تفسیر نمرات:</p>
                <ul class="bg-white/60 p-5 rounded-xl text-lg font-semibold text-gray-800 space-y-3 border border-orange-100">
                    <li>۱۷ تا ۲۰: استعداد بالا در این زمینه</li>
                    <li>۱۲ تا ۱۶: استعداد متوسط که با تقویت رشد می‌کند</li>
                    <li>۵ تا ۱۱: نیاز به تمرین و توجه بیشتر</li>
                </ul>
            </div>

            <!-- 🔍 تحلیل بخش‌ها -->
            <div class="mt-4 flex flex-col items-center" dir="rtl">
                <h4 class="text-3xl font-bold text-white mb-8 bg-[#fb8c00] p-3 rounded-lg w-full text-center">🔍 تحلیل بخش‌ها</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-items-center w-full px-4">
                    @forelse ($results as $section => $data)
                        <div class="bg-white/50 section-box opacity-0 translate-y-8 transition-all duration-700 ease-out border border-orange-300 rounded-xl shadow-xl p-5 flex flex-col items-center w-full max-w-[280px] min-h-[300px] hover:scale-105">
                            <p class="text-lg font-bold text-orange-800 mb-2">{{ $section }}</p>

                            <div class="relative w-24 h-24 mb-4">
                                <svg width="100" height="100" viewBox="0 0 120 120" class="rotate-90 drop-shadow-md">
                                    <defs>
                                        <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#fbbf24" />
                                            <stop offset="100%" stop-color="#f97316" />
                                        </linearGradient>
                                    </defs>
                                    <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
                                    <circle class="progress-ring" data-score="{{ $data['score'] }}" cx="60" cy="60" r="50" stroke="url(#progressGradient)" stroke-width="8" fill="none" stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
                                </svg>
                                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-xl font-extrabold text-orange-700">
                                    {{ round(($data['score'] / 20) * 100) }}%
                                </div>
                            </div>

                            <div class="text-sm font-medium text-gray-800 space-y-2 text-center">
                                <p class="text-lg">امتیاز: <span class="text-base font-bold text-orange-700">{{ $data['score'] }}</span></p>
                                @if (!empty($data['interpretation']))
                                    <p class="font-semibold text-lg text-red-600">تفسیر:</p>
                                    <p class="text-sm text-gray-700 leading-relaxed">{{ $data['interpretation'] }}</p>
                                @endif
                            </div>

                            @if (!empty($data['suggestions']))
                                <div class="mt-3 text-sm text-gray-700 text-right w-full">
                                    <p class="font-semibold text-orange-600 mb-1 text-lg">💡 راهکارها:</p>
                                    <ul class="list-disc pr-4 space-y-1 text-[13px] leading-snug">
                                        @foreach ($data['suggestions'] as $tip)
                                            <li>{{ $tip }}</li>
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

            <!-- 📈 نمودار -->
            <div class="mt-12 w-full">
                <h4 class="text-2xl font-extrabold text-white mb-8 p-3 rounded-lg bg-[#fb8c00] text-center">📈 نمایش گرافیکی امتیازات</h4>
                <canvas id="resultChart" height="100"></canvas>
            </div>

            <!-- ✅ جمع نهایی با نوار پیشرفت -->
            <div class="mt-10 p-6 bg-white/50 border border-orange-300 rounded-lg text-right shadow-xl transition transform hover:scale-105 w-full max-w-xl mx-auto">
                <p class="text-2xl font-semibold text-orange-800">✅ جمع کل امتیازات شما:
                    <span class="text-orange-900">{{ $totalScore }}</span> از 200
                </p>
                <p class="text-lg mt-2 text-yellow-600">درصد موفقیت کلی: <span class="font-semibold text-orange-900">{{ $percentage }}%</span></p>

                <div class="relative mt-4 w-full h-6 bg-gray-300 rounded-full overflow-hidden shadow-inner">
                    <div id="progress-bar" class="h-full bg-gradient-to-r from-yellow-400 to-[#fb8c00] rounded-full text-white font-extrabold flex items-center justify-center transition-all duration-[1500ms] ease-in-out" style="width: 0%;">
                        <span class="w-full text-center">{{ $percentage }}%</span>
                    </div>
                </div>

                <a href="{{ route('quiz.show') }}" class="text-center justify-center inline-block mt-8 px-6 py-3 bg-[#fb8c00] text-white rounded-lg hover:bg-orange-600 transition transform hover:scale-105 shadow-xl">
                    بازگشت به تست
                </a>
            </div>
        </div>
    </div>
    <!-- 📦 Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- ✨ انیمیشن‌ها -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // ✅ نوار پیشرفت افقی
        const progressBar = document.getElementById('progress-bar');
        const finalPercentage = {{ $percentage }};
        setTimeout(() => {
            progressBar.style.transition = "width 2s ease-in-out";
            progressBar.style.width = finalPercentage + '%';
        }, 100);

        // ✅ حلقه‌های درصدی (دایره‌ای)
        const rings = document.querySelectorAll(".progress-ring");
        const animateRing = (el) => {
            const score = parseFloat(el.getAttribute("data-score")) || 0;
            const offset = 314.16 * (1 - (score / 20));
            el.style.transition = "none";
            el.style.strokeDashoffset = 314.16;
            setTimeout(() => {
                el.style.transition = "stroke-dashoffset 2s ease-in-out";
                el.style.strokeDashoffset = offset;
            }, 50);
        };

        const ringObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateRing(entry.target);
                    // اجرای دوباره انیمیشن در ورود مجدد
                    ringObserver.unobserve(entry.target);
                    setTimeout(() => ringObserver.observe(entry.target), 3000);
                }
            });
        }, { threshold: 0.7 });

        rings.forEach(ring => {
            ringObserver.observe(ring);
        });

        // ✅ باکس‌های تحلیل (با انیمیشن ظاهر شدن)
        const sections = document.querySelectorAll(".section-box");
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("opacity-100", "translate-y-0");
                    entry.target.classList.remove("opacity-0", "translate-y-8");

                    // اجرای مجدد انیمیشن در ورود مجدد
                    sectionObserver.unobserve(entry.target);
                    setTimeout(() => sectionObserver.observe(entry.target), 3000);
                } else {
                    entry.target.classList.remove("opacity-100", "translate-y-0");
                    entry.target.classList.add("opacity-0", "translate-y-8");
                }
            });
        }, { threshold: 0.3 });

        sections.forEach(sec => {
            sectionObserver.observe(sec);
        });

        // ✅ نمودار میله‌ای
        const chartContainer = document.getElementById('resultChart');
        let chartInstance = null;

        const drawChart = () => {
            const chartLabels = {!! json_encode(array_keys($results)) !!};
            const chartScores = {!! json_encode(array_map(fn($r) => $r['score'], $results)) !!};
            const ctx = chartContainer.getContext('2d');

            if (chartInstance) {
                chartInstance.destroy();
            }

            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'امتیاز',
                        data: chartScores,
                        backgroundColor: [
                            '#ff6b6b', '#feca57', '#1dd1a1', '#54a0ff', '#5f27cd',
                            '#00d2d3', '#ff9ff3', '#48dbfb', '#a29bfe', '#fd79a8'
                        ],
                        borderRadius: 12,
                        borderWidth: 2,
                        borderColor: '#fff',
                        barThickness: 32,
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 20,
                            ticks: {
                                stepSize: 5,
                                color: '#fff',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                    family: 'Vazirmatn'
                                }
                            }
                        },
                        x: {
                            ticks: {
                                color: '#fff',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                    family: 'Vazirmatn'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        };

        const chartObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    drawChart();
                    chartObserver.unobserve(entry.target);
                    setTimeout(() => chartObserver.observe(entry.target), 4000);
                }
            });
        }, { threshold: 0.5 });

        chartObserver.observe(chartContainer);
    });
</script>

</x-app-layout>
