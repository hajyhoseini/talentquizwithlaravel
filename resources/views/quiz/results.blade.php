<x-app-layout>
    {{-- 🎯 عنوان صفحه --}}
    <x-slot name="header">
        <h2 class="text-xl sm:text-2xl md:text-3xl text-center font-bold py-4">📊 کارنامه تست علاقه‌مندی‌ها</h2>
    </x-slot>

    @php
        $totalScore = collect($results)->sum('score');
        $percentage = round(($totalScore / 200) * 100);
    @endphp

    <div id="main-wrapper">
    </div>

    <div class="fixed inset-0 bg-cover bg-center"
         style="background-image: url('{{ asset('images/top-view-desk-with-apple-paper-clips.jpg') }}');">
    </div>

    {{-- 🔳 محتوای اصلی --}}
    <div class="relative flex flex-col items-center min-h-screen px-4 sm:px-6 lg:px-8 py-10">
        <div class="rounded-2xl p-6 sm:p-2 w-full max-w-7xl text-center">
            {{-- 🔸 بخش نتایج نهایی --}}
            <div id="final-results" class="w-full max-w-7xl mx-auto px-4 mt-16 opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold mb-6 text-white text-center p-4 rounded-2xl bg-gradient-to-r from-[#04CCCC] to-[#1dd1a1] shadow-lg">
                    📊 نتایج نهایی شما
                </h3>

                <div class="p-2 text-right rounded-3xl bg-yellow-50/80 backdrop-blur-xl shadow-2xl mb-12 text-gray-900 leading-relaxed space-y-6 border border-amber-200" style="direction: rtl;">
                    <p class="text-base sm:text-lg md:text-xl font-extrabold text-black">برای هر بخش (۵ سؤال)، حداکثر نمره ۲۰ و حداقل نمره ۵ است. جمع کل امتیازات آزمون ۲۰۰ خواهد بود.</p>
                    <p class="text-base sm:text-lg md:text-xl font-bold text-amber-700 flex items-center gap-2">
                        📌 <span>تفسیر نمرات:</span>
                    </p>
                    <ul class="bg-white/80 p-6 text-right rounded-xl text-base sm:text-lg md:text-xl font-semibold text-gray-800 space-y-4 border border-orange-100 shadow-inner">
                        <li class="hover:text-green-600">✅ ۱۷ تا ۲۰: استعداد بالا در این زمینه</li>
                        <li class="hover:text-yellow-600">⚠️ ۱۲ تا ۱۶: استعداد متوسط که با تقویت رشد می‌کند</li>
                        <li class="hover:text-red-600">🔻 ۵ تا ۱۱: نیاز به تمرین و توجه بیشتر</li>
                    </ul>
                </div>
            </div>

            {{-- 🔍 تحلیل بخش‌ها --}}
            <div class="mt-4 flex flex-col items-center" dir="rtl">
                <h4 class="text-lg sm:text-xl md:text-2xl font-bold text-white mb-8 bg-[#04CCCC] p-3 rounded-lg w-full text-center">🔍 تحلیل بخش‌ها</h4>
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-1 sm:gap-2 justify-items-center w-full ">
                    @forelse ($results as $section => $data)
                    <div class="bg-white/70 section-box pt-4 opacity-0 translate-y-8 transition-all duration-700 ease-out border border-orange-300 rounded-xl shadow-xl  flex flex-col items-center w-full max-w-[280px] min-h-[260px] hover:scale-105">
    <p class="text-xs sm:text-base md:text-base font-bold text-orange-800 mb-1">{{ $section }}</p>

    <div class="relative w-16 h-16 sm:w-20 sm:h-20">
        <svg width="70" height="70" viewBox="0 0 120 120" class="rotate-90 drop-shadow-md">
            <defs>
                <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#fbbf24" />
                    <stop offset="100%" stop-color="#f97316" />
                </linearGradient>
            </defs>
            <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
            <circle class="progress-ring" data-score="{{ $data['score'] }}" cx="60" cy="60" r="50" stroke="url(#progressGradient)" stroke-width="8" fill="none" stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
        </svg>
        <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-[10px] sm:text-sm md:text-base font-extrabold text-orange-700">
            {{ round(($data['score'] / 20) * 100) }}%
        </div>
    </div>

    <div class="text-xs sm:text-sm md:text-base font-medium text-gray-800 text-center space-y-1 mt-1">
        <p class="text-xs sm:text-sm md:text-base">امتیاز: <span class="font-bold text-orange-700">{{ $data['score'] }}</span></p>

        @if (!empty($data['interpretation']))
            <p class="font-semibold text-xs sm:text-sm md:text-base text-red-600">تفسیر:</p>
            <p class="text-xs sm:text-sm text-gray-700">{{ $data['interpretation'] }}</p>
        @endif
    </div>

    @php
        $modalId = 'solutionsModal_' . md5($section);
        $buttonId = 'showSolutionsButton_' . md5($section);
        $closeId = 'closeModalButton_' . md5($section);
    @endphp

    @if (!empty($data['suggestions']))
        <button id="{{ $buttonId }}" class="mt-4 px-4 py-  bg-orange-500 text-white text-xs sm:text-sm rounded-lg hover:bg-orange-600 focus:outline-none transition">
            💡 مشاهده راهکارها
        </button>

        <div id="{{ $modalId }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex z-[999999] items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
            <div class="bg-white rounded-lg w-11/12 sm:w-2/3 md:w-3/4 p-2 max-h-[70vh] overflow-y-auto">
                <h3 class="text-sm md:text-base font-semibold text-orange-600 mb-2">💡 راهکارها:</h3>
                <ul class="list-disc text-left space-y-1 text-xs sm:text-sm md:text-base leading-snug">
                    @foreach ($data['suggestions'] as $tip)
                        <li>{{ $tip }}</li>
                    @endforeach
                </ul>
                <button id="{{ $closeId }}" class="mt-3 px-3 py-1 text-sm bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    بستن
                </button>
            </div>
        </div>
    @endif
</div>

                    @empty
                        <p class="col-span-full text-red-600 font-bold text-center text-base sm:text-lg md:text-xl">هیچ نتیجه‌ای یافت نشد.</p>
                    @endforelse
                </div>
            </div>

            {{-- 📈 نمودار میله‌ای --}}
            <div class="mt-12 w-full">
                <h4 class="text-lg sm:text-xl md:text-2xl font-extrabold text-white mb-8 p-3 rounded-lg bg-[#04CCCC] text-center">📈 نمایش گرافیکی امتیازات</h4>
                <canvas id="resultChart" height="100"></canvas>
            </div>

            {{-- ✅ امتیاز نهایی --}}
            <div class="mt-10 p-6 bg-white/50 border border-orange-300 rounded-lg text-right shadow-xl hover:scale-105 w-full max-w-7xl mx-auto">
                <p class="text-base sm:text-lg md:text-xl font-semibold text-orange-800">✅ جمع کل امتیازات شما:
                    <span class="text-orange-900">{{ $totalScore }}</span> از 200
                </p>
                <p class="text-base sm:text-lg md:text-xl mt-2 text-yellow-600">درصد موفقیت کلی: <span class="font-semibold text-orange-900">{{ $percentage }}%</span></p>

                <div class="relative mt-4 w-full h-6 bg-gray-300 rounded-full overflow-hidden shadow-inner">
                    <div id="progress-bar" class="h-full bg-gradient-to-r from-yellow-500 to-yellow-300 rounded-full text-white font-extrabold flex items-center justify-center transition-all duration-[1500ms] ease-in-out p-3" style="width: 0%;">
                        <span class="w-full text-center p-3 text-sm sm:text-base md:text-lg">{{ $percentage }}%</span>
                    </div>
                </div>

                <div class="w-full flex justify-center mt-8">
                    <a href="{{ route('home') }}"
                       class="text-sm sm:text-base md:text-lg px-6 py-4 bg-gray-500 text-white rounded-lg hover:bg-orange-600 transition transform hover:scale-105 shadow-xl">
                        بازگشت به تست
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 📦 اسکریپت‌ها و انیمیشن‌ها --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/global.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    {{-- 💫 انیمیشن‌ها و تعامل‌ها --}}
    <script>
 document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('[id^="showSolutionsButton_"]');
    const modals = document.querySelectorAll('[id^="solutionsModal_"]');

    buttons.forEach(button => {
        const idSuffix = button.id.replace("showSolutionsButton_", "");
        const modal = document.getElementById("solutionsModal_" + idSuffix);
        const close = document.getElementById("closeModalButton_" + idSuffix);

        // هندل کلیک روی دکمه
        button.addEventListener("click", (e) => {
            e.stopPropagation(); // جلوگیری از بستن فوری مدال

            // بستن همه مدال‌ها
            modals.forEach(m => {
                m.classList.add("opacity-0", "pointer-events-none");
                m.classList.remove("opacity-100", "pointer-events-auto");
            });

            // نمایش مدال مربوطه
            modal.classList.remove("opacity-0", "pointer-events-none");
            modal.classList.add("opacity-100", "pointer-events-auto");
        });

        // بستن با دکمه بستن
        close.addEventListener("click", () => {
            modal.classList.add("opacity-0", "pointer-events-none");
            modal.classList.remove("opacity-100", "pointer-events-auto");
        });

        // بستن با کلیک روی بک‌دراپ
        modal.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.classList.add("opacity-0", "pointer-events-none");
                modal.classList.remove("opacity-100", "pointer-events-auto");
            }
        });
    });

    // بستن همه مدال‌ها با کلیک روی بقیه‌ی صفحه
    document.addEventListener("click", (e) => {
        // اگر کلیک روی خود دکمه‌ها یا داخل مدال‌ها نبود
        const isClickInsideModal = [...modals].some(modal => modal.contains(e.target));
        const isClickOnButton = [...buttons].some(button => button.contains(e.target));

        if (!isClickInsideModal && !isClickOnButton) {
            modals.forEach(modal => {
                modal.classList.add("opacity-0", "pointer-events-none");
                modal.classList.remove("opacity-100", "pointer-events-auto");
            });
        }
    });
});

        document.addEventListener("DOMContentLoaded", function () {
            // ✅ نوار پیشرفت افقی
            const progressBar = document.getElementById('progress-bar');
            const finalPercentage = {{ $percentage }};
            setTimeout(() => {
                progressBar.style.transition = "width 1s ease-in-out";
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

            const ringCooldowns = new WeakMap();

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
                                        size: window.innerWidth < 640 ? 16 : window.innerWidth < 1024 ? 20 : 24,
                                        weight: 'bold',
                                        family: 'Vazirmatn'
                                    }
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#111',
                                    font: {
                                        size: window.innerWidth < 640 ? 16 : window.innerWidth < 1024 ? 20 : 24,
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

            // ✅ انیمیشن بخش نتایج نهایی
            const finalResults = document.getElementById('final-results');

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove("opacity-0", "translate-y-8");
                        entry.target.classList.add("opacity-100", "translate-y-0");
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(finalResults);
        });
    </script>
</x-app-layout>