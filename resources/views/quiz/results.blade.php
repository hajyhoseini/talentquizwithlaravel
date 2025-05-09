<x-app-layout>
    {{-- 🎯 عنوان صفحه --}}
    <x-slot name="header">
        <h2 class="text-xl sm:text-2xl md:text-3xl text-center font-bold py-4">📊 کارنامه تست علاقه‌مندی‌ها</h2>
    </x-slot>

    @php
        $totalScore = collect($results)->sum('score');
        $percentage = round(($totalScore / 200) * 100);
    @endphp

     <!-- Includes -->
  <div id="main-wrapper">
  </div>


    <div class="fixed inset-0 bg-cover bg-center"
         style="background-image: url('{{ asset('images/top-view-desk-with-apple-paper-clips.jpg') }}');">
         
    </div>

    {{-- 🔳 محتوای اصلی --}}
    <div class=" container-fluid relative flex flex-col items-center min-h-screen px-4 sm:px-6 lg:px-8 py-10">
        <div class="rounded-2xl p-6 sm:p-2 w-full max-w-7xl text-center">
            {{-- 🔸 بخش نتایج نهایی --}}
            <div id="pdf-content">
            {{-- 📈 نمودار میله‌ای --}}
        <x-chart-component :results="$results" />
            <div id="final-results" class="lg:w-3/5 mx-auto px-4 mt-16 opacity-0 translate-y-8 transition-all duration-1000 ease-out">
                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold mb-6 text-white text-center p-4 rounded-2xl bg-gradient-to-r from-[#04CCCC] to-[#1dd1a1] shadow-lg">
                    📊 نتایج نهایی شما
                </h3>

                <div class="p-2 text-left rounded-3xl bg-yellow-50/80 backdrop-blur-xl shadow-2xl mb-12 text-gray-900 leading-relaxed space-y-6 border border-amber-200" >
                    <p class="text-base sm:text-lg md:text-xl font-extrabold text-black">برای هر بخش (۵ سؤال)، حداکثر نمره ۲۰ و حداقل نمره ۵ است. جمع کل امتیازات آزمون ۲۰۰ خواهد بود.</p>
                    <p class="text-base sm:text-lg md:text-xl font-bold text-amber-700 flex items-center gap-2">
                        📌 <span>تفسیر نمرات:</span>
                    </p>
                    <ul class="bg-white/80 p-6 text-left rounded-xl text-base sm:text-lg md:text-xl font-semibold text-gray-800 space-y-4 border border-orange-100 shadow-inner">
                        <li class="hover:text-green-600">✅ ۱۷ تا ۲۰: استعداد بالا در این زمینه</li>
                        <li class="hover:text-yellow-600">⚠️ ۱۲ تا ۱۶: استعداد متوسط که با تقویت رشد می‌کند</li>
                        <li class="hover:text-red-600">🔻 ۵ تا ۱۱: نیاز به تمرین و توجه بیشتر</li>
                    </ul>
                </div>
            </div>

            {{-- 🔍 تحلیل بخش‌ها --}}
            <div class="mt-4 flex flex-col items-center" dir="rtl">
                <h4 class="text-lg sm:text-xl md:text-2xl font-bold text-white mb-8 bg-[#04CCCC] p-3 rounded-lg w-3/4 text-center">🔍 تحلیل بخش‌ها</h4>
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 justify-items-center w-6/7 gap-3 lg:gap-4" >
                @forelse ($results as $section => $data)
    <x-score-card :section="$section" :data="$data" />
@empty
    <p class="col-span-full text-red-600 font-bold text-center text-base sm:text-lg md:text-xl">هیچ نتیجه‌ای یافت نشد.</p>
@endforelse

                </div>
            </div>


            {{-- ✅ امتیاز نهایی --}}
<div class="mt-10 p-6 bg-white/60 border border-orange-400 rounded-2xl text-right shadow-2xl hover:scale-105 w-11/12 md:w-3/5 mx-auto transition-all duration-300">

  <!-- انیمیشن لوتی نتیجه -->
  <div class="flex justify-center ">
    <div id="success-lottie" class="w-1/3 h-1/3 "></div>
  </div>

  <!-- متن نتیجه -->
  <div class="text-center text-gray-800 text-lg sm:text-xl font-semibold leading-relaxed mb-6">
    <p>🎉 تبریک! آزمون شما با موفقیت به پایان رسید.</p>
    <p class="mt-2 text-gray-600">شما یک قدم به پیشرفت نزدیک‌تر شدید!</p>
    <p class="text-gray-600">برای ادامه مسیر یادگیری، به سراغ آزمون‌های بعدی بروید.</p>
  </div>
</div>
  <!-- دکمه بازگشت -->
  <div class="w-full flex justify-center mt-8">
    <a href="/"
       class="text-sm sm:text-base md:text-lg px-6 py-3 bg-[#1dd1a1] text-white rounded-xl hover:bg-[#54a0ff] transition transform hover:scale-105 shadow-lg font-medium">
       🚀 بازگشت به صفحه آزمون‌ها
    </a>
    <a href="{{ route('exams.interpretation', $quiz->id) }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded">
    تفسیر بیشتر نتایج
</a>

  </div>
</div>
<button id="downloadPdfBtn" class="mt-2 mb-4 px-4 py-3 bg-[#1dd1a1] text-white text-xs sm:text-sm rounded-lg hover:bg-[#54a0ff] focus:outline-none transition">
    دانلود PDF
</button>
<x-share-buttons :url="route('quiz.results')" :title="'📊 نتیجه آزمون من رو ببین!'" />


<script>
  document.getElementById('downloadPdfBtn').addEventListener('click', () => {
    window.print();
  });
</script>





    {{-- 📦 اسکریپت‌ها و انیمیشن‌ها --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/global.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    {{-- 💫 انیمیشن‌ها و تعامل‌ها --}}
    <script>
            document.getElementById("downloadPdfBtn").addEventListener("click", function() {
        // بارگذاری jsPDF
        const { jsPDF } = window.jspdf;

        // ایجاد یک شیء جدید jsPDF
        const doc = new jsPDF();

        // انتخاب محتوای کد که می‌خواهیم به PDF تبدیل شود
        const codeContent = document.getElementById("codeContent").innerText;

        // اضافه کردن کدها به PDF
        doc.text(codeContent, 10, 10); // 10,10 مختصات شروع متن

        // ذخیره کردن PDF
        doc.save("code_output.pdf");
    });
    
     document.addEventListener("DOMContentLoaded", function () {
    let hasPlayed = false;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !hasPlayed) {
          hasPlayed = true;

          lottie.loadAnimation({
            container: document.getElementById('success-lottie'),
            renderer: 'svg',
            loop: false,
            autoplay: true,
            path: 'https://assets5.lottiefiles.com/packages/lf20_jbrw3hcz.json'
          });

          observer.disconnect(); // دیگه نیازی به نظارت نیست
        }
      });
    }, { threshold: 0.6 });

    observer.observe(document.getElementById('success-lottie'));
  });
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
const sectionObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("opacity-100", "translate-y-0");
            entry.target.classList.remove("opacity-0", "translate-y-8");
            observer.unobserve(entry.target); // 🔥 فقط یه‌بار انیمیشن اجرا بشه
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
                            barThickness: 20,
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
                                        size: window.innerWidth < 640 ? 8 : window.innerWidth < 1024 ? 10 :12 ,
                                        weight: 'bold',
                                        family: 'Vazirmatn'
                                    }
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#111',
                                    font: {
                                        size: window.innerWidth < 640 ? 6 : window.innerWidth < 1024 ? 10 : 12,
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