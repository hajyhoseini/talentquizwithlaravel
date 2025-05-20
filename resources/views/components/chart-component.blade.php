<div class="mt-12 w-4/5 lg:w-3/5 mx-auto">
    <h4 class="text-lg sm:text-xl md:text-2xl font-extrabold text-white mb-8 p-3 rounded-lg bg-[#04CCCC] text-center">
        📈 نمودار گرافیکی استعدادها
    </h4>
    <canvas id="resultChart" class=" h-3/6  w-full "></canvas>
</div>

<x-slot name="scripts">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chartContainer = document.getElementById('resultChart');
            const chartLabels = {!! json_encode(array_keys($results)) !!};
            const chartScores = {!! json_encode(array_map(fn($r) => $r['score'], $results)) !!};
            const ctx = chartContainer.getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'امتیاز',
                        data: chartScores,
                        backgroundColor: ['#ff6b6b', '#feca57', '#1dd1a1', '#54a0ff', '#5f27cd', '#00d2d3', '#ff9ff3', '#48dbfb', '#a29bfe', '#fd79a8'],
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
                                    size: 12,
                                    weight: 'bold',
                                    family: 'Vazirmatn'
                                }
                            }
                        },
                        x: {
                            ticks: {
                                color: '#111',
                                font: {
                                    size: 10,
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
        });
    </script>
</x-slot>
