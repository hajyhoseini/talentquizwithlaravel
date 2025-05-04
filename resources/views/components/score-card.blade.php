@props(['section', 'data'])

@php
    $modalId = 'solutionsModal_' . md5($section);
    $buttonId = 'showSolutionsButton_' . md5($section);
    $closeId = 'closeModalButton_' . md5($section);
@endphp

<div x-data="{ loaded: false, percent: 0, showShimmer: true }" x-init="
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !loaded) {
                    loaded = true;
                    showShimmer = false; // Hide shimmer after 2 seconds
                    percent = {{ round(($data['score'] / 20) * 100) }};
                    $nextTick(() => {
                        fillProgress('{{ md5($section) }}', percent);
                    });
                    observer.disconnect();
                }
            });
        }, { threshold: 0.5 });
        observer.observe($el);
        setTimeout(() => { showShimmer = false }, 2000); // hide shimmer after 2 seconds
    " class="bg-white/80 section-box pt-4 opacity-0 translate-y-8 transition-all duration-700 ease-out border border-orange-300 rounded-xl shadow-xl flex flex-col items-center w-full max-w-[230px] min-h-[250px] hover:scale-105">

    <p class="text-sm lg:text-lg font-bold text-[#1dd1a1] mb-1">{{ $section }}</p>

    {{-- شِیور لیزی لودینگ (این قسمت قبل از بارگذاری داده‌ها نمایش داده می‌شود) --}}
    <template x-if="showShimmer">
        <div class="relative w-16 h-16 sm:w-20 sm:h-20 shimmer">
            <svg width="70" height="70" viewBox="0 0 120 120" class="rotate-90 drop-shadow-md">
                <defs>
                    <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#fbbf24" />
                        <stop offset="100%" stop-color="#f97316" />
                    </linearGradient>
                </defs>
                <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
                <circle cx="60" cy="60" r="50" stroke="url(#progressGradient)" stroke-width="8" fill="none" stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
            </svg>
        </div>
    </template>

    {{-- بعد از بارگذاری واقعی داده‌ها --}}
<template x-if="!showShimmer && loaded">
    <div class="relative w-20 h-20 sm:w-24 sm:h-24">
        <svg viewBox="0 0 120 120" class="absolute inset-0 w-full h-full rotate-90 drop-shadow-md">
            <defs>
                <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#1dd1a1" />
                    <stop offset="100%" stop-color="#54a0ff" />
                </linearGradient>
            </defs>
            <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
            <circle id="progressRing_{{ md5($section) }}" cx="60" cy="60" r="50"
                    stroke="url(#progressGradient)" stroke-width="8" fill="none"
                    stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
        </svg>

        <!-- درصد -->
        <div class="absolute inset-0 flex items-center justify-center text-[12px] sm:text-md md:text-lg font-extrabold text-[#54a0ff]">
            {{ round(($data['score'] / 20) * 100) }}%
        </div>
    </div>
</template>


    <div class="text-xs sm:text-sm md:text-base font-medium text-gray-800 text-center space-y-1 mt-1">
        <p class="mt-2">امتیاز: <span class="font-bold text-[#1dd1a1]">{{ $data['score'] }}</span></p>

        @if (!empty($data['interpretation']))
            <p class="font-semibold text-xs sm:text-sm md:text-base text-[#54a0ff]">تفسیر:</p>
            <p class="text-xs sm:text-sm text-gray-700">{{ $data['interpretation'] }}</p>
        @endif
    </div>

    @if (!empty($data['suggestions']))
        <button id="{{ $buttonId }}" class="mt-2 mb-4 px-4 py-3 bg-[#1dd1a1] text-white text-xs sm:text-sm rounded-lg hover:bg-[#54a0ff] focus:outline-none transition">
            💡 مشاهده راهکارها
        </button>

        <div id="{{ $modalId }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex z-[999999] items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
            <div class="bg-white rounded-lg w-11/12 sm:w-2/3 md:w-3/4 p-2 max-h-[70vh] overflow-y-auto">
                <h3 class="text-sm md:text-base text-left font-semibold text-[#1dd1a1] mb-2">💡 راهکارها:</h3>
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

{{-- استایل انیمیشن لیزی لودینگ --}}
@once
    @push('styles')
        <style>
            .shimmer {
                background: linear-gradient(to right, #f3f3f3 8%, #e0e0e0 18%, #f3f3f3 33%);
                background-size: 800px 104px;
                animation: shimmer 2s infinite linear; /* زمان انیمیشن به 2 ثانیه تغییر داده شد */
            }

            @keyframes shimmer {
                0% {
                    background-position: -468px 0;
                }
                100% {
                    background-position: 468px 0;
                }
            }
        </style>
    @endpush
@endonce

<script>
    function fillProgress(id, percent) {
        const circle = document.getElementById('progressRing_' + id);
        const radius = 50;
        const circumference = 2 * Math.PI * radius;
        let targetOffset = circumference - (percent / 100) * circumference;
        let currentOffset = circumference;
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
