import lottie from 'lottie-web';
import Chart from 'chart.js/auto';

console.log("✅ test-results.js loaded");

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

    // ✅ نوار پیشرفت افقی
    const progressBar = document.getElementById('progress-bar');
    const finalPercentage = @json($percentage); // اصلاح این خط
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

    const finalObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove("opacity-0", "translate-y-8");
                entry.target.classList.add("opacity-100", "translate-y-0");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    finalObserver.observe(finalResults);
});
