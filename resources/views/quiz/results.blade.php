<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">📊 کارنامه تست علاقه‌مندی‌ها</h2>
    </x-slot>

    @php
        $totalScore = collect($results)->sum('score');
        $percentage = round(($totalScore / 200) * 100);
    @endphp


        <!-- 🔳 بک‌گراند ثابت -->
        <div class="fixed inset-0 -z-10 bg-cover bg-center"
         style="background-image: url('{{ asset('images/top-view-desk-with-apple-paper-clips.jpg') }}');">
    </div>

    <!-- 🔳 محتوای اصلی روی بک‌گراند -->
    <div class="relative z-10 flex flex-col items-center min-h-screen px-4 py-10">
        <div class="rounded-2xl p-8 w-full max-w-5xl text-center">

            <!-- 🔸 نتایج نهایی -->
            <div id="final-results" class="w-full max-w-5xl mx-auto px-4 mt-16 opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                <h3 class="text-4xl font-extrabold mb-6 text-white text-center p-4 rounded-2xl bg-gradient-to-r from-[#04CCCC] to-[#1dd1a1] shadow-lg">
                    📊 نتایج نهایی شما
                </h3>

                <div class="p-6 text-right rounded-3xl bg-yellow-50/80 backdrop-blur-xl shadow-2xl mb-12 text-gray-900 leading-relaxed space-y-6 border border-amber-200" style="direction: rtl;">
                    <p class="text-3xl font-extrabold text-black leading-loose tracking-tight">
                        برای هر بخش (۵ سؤال)، حداکثر نمره ۲۰ و حداقل نمره ۵ است. جمع کل امتیازات آزمون ۲۰۰ خواهد بود.
                    </p>
                    <p class="text-3xl font-bold text-amber-700 flex items-center gap-2">
                        📌 <span>تفسیر نمرات:</span>
                    </p>
                    <ul class="bg-white/80 p-6 rounded-xl text-xl font-semibold text-gray-800 space-y-4 border border-orange-100 shadow-inner">
                        <li class="hover:text-green-600 transition duration-300">✅ ۱۷ تا ۲۰: استعداد بالا در این زمینه</li>
                        <li class="hover:text-yellow-600 transition duration-300">⚠️ ۱۲ تا ۱۶: استعداد متوسط که با تقویت رشد می‌کند</li>
                        <li class="hover:text-red-600 transition duration-300">🔻 ۵ تا ۱۱: نیاز به تمرین و توجه بیشتر</li>
                    </ul>
                </div>
            </div>

            <!-- 🔍 تحلیل بخش‌ها -->
            <div class="mt-4 flex flex-col items-center" dir="rtl">
                <h4 class="text-3xl font-bold text-white mb-8 bg-[#04CCCC] p-3 rounded-lg w-full text-center">🔍 تحلیل بخش‌ها</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-items-center w-full px-4">
                    @forelse ($results as $section => $data)
                        <div class="bg-white/50 section-box opacity-0 translate-y-8 transition-all duration-700 ease-out border border-orange-300 rounded-xl shadow-xl p-5 flex flex-col items-center w-full max-w-[280px] min-h-[300px] hover:scale-105">
                            <p class="text-2xl font-bold text-orange-800 mb-2">{{ $section }}</p>
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
                                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-2xl font-extrabold text-orange-700">
                                    {{ round(($data['score'] / 20) * 100) }}%
                                </div>
                            </div>
                            <div class="text-sm font-medium text-gray-800 space-y-2 text-center">
                                <p class="text-2xl">امتیاز: <span class="text-2xl font-bold text-orange-700">{{ $data['score'] }}</span></p>
                                @if (!empty($data['interpretation']))
                                    <p class="font-semibold text-2xl text-red-600">تفسیر:</p>
                                    <p class="text-lg text-gray-700 leading-relaxed">{{ $data['interpretation'] }}</p>
                                @endif
                            </div>
                            @if (!empty($data['suggestions']))
                                <div class="mt-3 text-sm text-gray-700 text-right w-full">
                                    <p class="font-semibold text-orange-600 mb-1 text-2xl">💡 راهکارها:</p>
                                    <ul class="list-disc pr-4 space-y-1 text-xl leading-snug">
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
                <h4 class="text-2xl font-extrabold text-white mb-8 p-3 rounded-lg bg-[#04CCCC] text-center">📈 نمایش گرافیکی امتیازات</h4>
                <canvas id="resultChart" height="100"></canvas>
            </div>

            <!-- ✅ جمع نهایی -->
            <div class="mt-10 p-6 bg-white/50 border border-orange-300 rounded-lg text-right shadow-xl transition transform hover:scale-105 w-full max-w-xl mx-auto">
                <p class="text-2xl font-semibold text-orange-800">✅ جمع کل امتیازات شما:
                    <span class="text-orange-900">{{ $totalScore }}</span> از 200
                </p>
                <p class="text-2xl mt-2 text-yellow-600" dir="rtl">درصد موفقیت کلی: <span class="font-semibold text-orange-900">{{ $percentage }}%</span></p>

                <div class="relative mt-4 w-full h-6 bg-gray-300 rounded-full overflow-hidden shadow-inner">
                    <div id="progress-bar" class="h-full bg-gradient-to-r from-yellow-500 to-yellow-300 rounded-full text-white font-extrabold flex items-center justify-center transition-all duration-[1500ms] ease-in-out p-3" style="width: 0%;">
                        <span class="w-full text-center p-3 text-xl" dir="rtl">{{ $percentage }}%</span>
                    </div>
                </div>

                <div class="w-full flex justify-center align-center">
                    <a href="{{ route('quiz.show') }}"
                        class="text-center text-lg inline-block mt-8 px-6 py-4 bg-gray-500 text-white rounded-lg hover:bg-orange-600 transition transform hover:scale-105 shadow-xl">
                        بازگشت به تست
                    </a>
                </div>
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
        progressBar.style.transition = "width s ease-in-out";
        progressBar.style.width = finalPercentage + '%';
    }, 100);

    // ✅ حلقه‌های درصدی
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

    const ringCooldowns = new WeakMap(); // برای کنترل انیمیشن تکراری

    const ringObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const now = Date.now();
                const lastTime = ringCooldowns.get(entry.target) || 0;

                if (now - lastTime > 3000) {
                    animateRing(entry.target);
                    ringCooldowns.set(entry.target, now);
                }
            }
        });
    }, { threshold: 0.7 });

    rings.forEach(ring => ringObserver.observe(ring));

    // ✅ باکس‌های تحلیل (با ظاهر شدن انیمیشن)
    const sections = document.querySelectorAll(".section-box");
    const sectionCooldowns = new WeakMap();

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const now = Date.now();
            const lastTime = sectionCooldowns.get(entry.target) || 0;

            if (entry.isIntersecting) {
                if (now - lastTime > 3000) {
                    entry.target.classList.add("opacity-100", "translate-y-0");
                    entry.target.classList.remove("opacity-0", "translate-y-8");
                    sectionCooldowns.set(entry.target, now);
                }
            } else {
                entry.target.classList.remove("opacity-100", "translate-y-0");
                entry.target.classList.add("opacity-0", "translate-y-8");
            }
        });
    }, { threshold: 0.3 });

    sections.forEach(sec => sectionObserver.observe(sec));

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
                            color: '#111',
                            font: {
                                size: 24,
                                weight: 'bold',
                                family: 'Vazirmatn'
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: '#111',
                            font: {
                                size: 24,
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

    let chartLastDrawn = 0;
    const chartObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const now = Date.now();
                if (now - chartLastDrawn > 5000) {
                    drawChart();
                    chartLastDrawn = now;
                }
            }
        });
    }, { threshold: 0.5 });

    chartObserver.observe(chartContainer);
});

document.addEventListener("DOMContentLoaded", function () {
    const finalResults = document.getElementById('final-results');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove("opacity-0", "translate-y-8");
                entry.target.classList.add("opacity-100", "translate-y-0");
                observer.unobserve(entry.target); // فقط یک بار اجرا بشه
            }
        });
    }, {
        threshold: 0.5,
    });

    observer.observe(finalResults);
});

</script>


</x-app-layout>
