<!-- <x-app-layout>
    <div class="py-6 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">نتایج تفسیر آزمون</h1>

        @forelse($results as $section => $data)
            @php
                $sectionId = md5($section);
                $percent = round(($data['score'] / 20) * 100);
            @endphp

            <div 
                x-data="{ loaded: false, percent: {{ $percent }} }"
                x-init="
                    loaded = true;
                    $nextTick(() => fillProgress('{{ $sectionId }}', percent));
                "
                class="bg-white/90 section-box pt-4 border border-orange-300 rounded-xl shadow-xl flex flex-col items-center w-full max-w-xl mx-auto my-6 p-4"
            >
                {{-- عنوان بخش --}}
                <p class="text-lg font-bold text-[#1dd1a1] mb-2">{{ $section }}</p>

                {{-- دایره پیشرفت --}}
                <div class="relative w-24 h-24 mb-4">
                    <svg viewBox="0 0 120 120" class="absolute inset-0 w-full h-full rotate-90 drop-shadow-md">
                        <defs>
                            <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#1dd1a1" />
                                <stop offset="100%" stop-color="#54a0ff" />
                            </linearGradient>
                        </defs>
                        <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
                        <circle 
                            id="progressRing_{{ $sectionId }}" 
                            cx="60" cy="60" 
                            r="50"
                            stroke="url(#progressGradient)" 
                            stroke-width="8" 
                            fill="none"
                            stroke-dasharray="314.16" 
                            stroke-dashoffset="314.16" 
                            stroke-linecap="round"
                        />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center text-md font-extrabold text-[#54a0ff]">
                        {{ $percent }}%
                    </div>
                </div>

                {{-- امتیاز و تفسیر --}}
                <div class="text-sm font-medium text-gray-800 text-center space-y-2">
                    <p>امتیاز: <span class="font-bold text-[#1dd1a1]">{{ $data['score'] }}</span></p>
                    
                    @if (!empty($data['interpretation']))
                        <p class="font-semibold text-[#54a0ff]">تفسیر:</p>
                        <p class="text-gray-700 leading-relaxed">{{ $data['interpretation'] }}</p>
                    @endif
                </div>

                {{-- راهکارها --}}
                @if (!empty($data['suggestions']))
                    <div class="bg-white mt-4 w-full p-4 border border-gray-200 rounded-lg max-h-[300px] overflow-y-auto">
                        <h3 class="text-base font-semibold text-[#1dd1a1] mb-2">💡 راهکارها:</h3>
                        <ul class="list-disc pr-5 space-y-1 text-sm text-gray-700 leading-snug">
                            @foreach ($data['suggestions'] as $tip)
                                <li>{{ $tip }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-gray-600 mt-10">
                هنوز هیچ نتیجه‌ای برای نمایش وجود ندارد.
            </div>
        @endforelse
    </div>

    {{-- اسکریپت انیمیشن حلقه پیشرفت --}}
    <script>
        function fillProgress(id, percent) {
            const circle = document.getElementById('progressRing_' + id);
            const radius = 50;
            const circumference = 2 * Math.PI * radius;
            const duration = 800;
            const start = performance.now();

            function animate(time) {
                let progress = (time - start) / duration;
                if (progress > 1) progress = 1;
                let offset = circumference - ((percent / 100) * circumference * progress);
                circle.style.strokeDashoffset = offset;
                if (progress < 1) requestAnimationFrame(animate);
            }

            requestAnimationFrame(animate);
        }
    </script>
</x-app-layout> -->
