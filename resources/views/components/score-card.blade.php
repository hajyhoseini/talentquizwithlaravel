@php
    $solutionsModalId = 'solutionsModal_' . md5($section);
    $solutionsButtonId = 'showSolutionsButton_' . md5($section);
    $solutionsCloseId = 'closeSolutionsButton_' . md5($section);

    $descriptionModalId = 'descriptionModal_' . md5($section);
    $descriptionButtonId = 'showDescriptionButton_' . md5($section);
    $descriptionCloseId = 'closeDescriptionButton_' . md5($section);

    $max = $maxScores[$section] ?? 20;
    $percent = round(($data['score'] / $max) * 100);
@endphp
@php
    $sectionPeople = $featuredPeople->filter(function($person) use ($section) {
        return strtolower($person->related_talent) === strtolower($section);
    })->values();
@endphp

<div x-data="{ loaded: false, percent: 0, showShimmer: true }" 
     x-init="
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !loaded) {
                    loaded = true;
                    showShimmer = false;
                    percent = {{ $percent }};
                    $nextTick(() => {
                        fillProgress('{{ md5($section) }}', percent);
                    });
                    observer.disconnect();
                }
            });
        }, { threshold: 0.5 });
        observer.observe($el);
        setTimeout(() => { showShimmer = false }, 2000);
     "
     class="bg-white/80 section-box pt-4 opacity-0 translate-y-8 transition-all duration-700 ease-out border border-orange-300 rounded-xl shadow-xl flex flex-col items-center w-full max-w-[230px] min-h-[250px] hover:scale-105">

    <p class="text-sm lg:text-lg font-bold text-[#1dd1a1] mb-1">{{ $section }}</p>

    {{-- شِیمر --}}
    <template x-if="showShimmer">
        <div class="relative w-16 h-16 sm:w-20 sm:h-20 shimmer">
            <svg width="70" height="70" viewBox="0 0 120 120" class="rotate-90 drop-shadow-md">
                <circle cx="60" cy="60" r="50" stroke="#f3f4f6" stroke-width="8" fill="none" />
                <circle cx="60" cy="60" r="50" stroke="#f97316" stroke-width="8" fill="none" stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
            </svg>
        </div>
    </template>

    {{-- نمودار درصد --}}
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
                <circle id="progressRing_{{ md5($section) }}" cx="60" cy="60" r="50" stroke="url(#progressGradient)" stroke-width="8" fill="none" stroke-dasharray="314.16" stroke-dashoffset="314.16" stroke-linecap="round" />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center text-sm sm:text-md font-extrabold text-[#54a0ff]">
                {{ $percent }}%
            </div>
        </div>
    </template>

    {{-- امتیاز و تفسیر --}}
    <div class="text-xs sm:text-sm font-medium text-gray-800 text-center mt-2">
        <p>امتیاز: <span class="font-bold text-[#1dd1a1]">{{ $data['score'] }}</span></p>

        @if (!empty($data['interpretation']))
            <p class="mt-2 font-semibold text-[#54a0ff]">تفسیر:</p>
            <p class="text-gray-700">{{ $data['interpretation'] }}</p>
        @endif
    </div>

    {{-- دکمه توضیح استعداد --}}
    @if (!empty($description))
        <button id="{{ $descriptionButtonId }}" class="mt-2 px-4 py-2 bg-[#54a0ff] text-white text-xs sm:text-sm rounded-lg hover:bg-[#1dd1a1] transition">
            📘 توضیح استعداد
        </button>
    @endif

    {{-- دکمه راهکارها --}}
    @if (!empty($data['suggestions']))
        <button id="{{ $solutionsButtonId }}" class="mt-2 mb-4 px-4 py-2 bg-[#1dd1a1] text-white text-xs sm:text-sm rounded-lg hover:bg-[#54a0ff] transition">
            💡 مشاهده راهکارها
        </button>
    @endif
</div>

{{-- مدال توضیح استعداد --}}
@if (!empty($description))
<div id="{{ $descriptionModalId }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-[999999] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white rounded-lg w-11/12 sm:w-2/3 md:w-3/4 p-4 max-h-[80vh] overflow-y-auto">
        <h3 class="text-sm md:text-base font-semibold text-[#54a0ff] mb-2">📘 توضیح استعداد:</h3>
        <p class="text-sm sm:text-lg md:text-xl text-gray-700 leading-relaxed mb-4">
           ✅ {{ $description }}
        </p>

@if ($sectionPeople->isNotEmpty())
   
<div 
    x-data="{
        current: 0,
        init() {
            setInterval(() => {
                this.current = (this.current + 1) % {{ $sectionPeople->count() }};
            }, 3000);
        }
    }" 
    class="relative w-full">
        <div class="flex items-center justify-between mb-2">
            <h4 class="text-sm font-semibold text-[#1dd1a1]">🧠 افراد شاخص با این استعداد:</h4>
           
        </div>

        <div class="overflow-hidden relative h-48 sm:h-56">
@foreach ($sectionPeople as $index => $person)
                <div x-show="current === {{ $index }}" 
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 transform translate-x-10"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform -translate-x-10"
                     class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 space-y-2 bg-gray-50 rounded-lg shadow">
                    <img src="{{ $person->image_url }}" alt="{{ $person->name }}" class="w-20 h-20 rounded-full object-cover shadow-md mb-2">
                    <p class="font-bold text-[#54a0ff] text-sm sm:text-base">{{ $person->name }}</p>
                    <p class="text-xs text-gray-600">🎯 {{ $person->related_talent }}</p>
                    @if ($person->general_talent)
                        <p class="text-xs text-gray-500">🔍 {{ $person->general_talent }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif


        <button id="{{ $descriptionCloseId }}" class="mt-6 px-4 py-2 bg-gray-500 text-white text-sm rounded hover:bg-gray-600">
            بستن
        </button>
    </div>
</div>
@endif


{{-- مدال راهکارها --}}
@if (!empty($data['suggestions']))
<div id="{{ $solutionsModalId }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-[999999] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white rounded-lg w-11/12 sm:w-2/3 md:w-3/4 p-4 max-h-[70vh] overflow-y-auto">
        <h3 class="text-sm md:text-base font-semibold text-[#1dd1a1] mb-2">💡 راهکارها:</h3>
        <ul class="list-disc pl-5 space-y-1 text-sm sm:text-sm md:text-base text-gray-700">
            @foreach ($data['suggestions'] as $tip)
                <li>🚀 {{ $tip }}</li>
            @endforeach
        </ul>
        <button id="{{ $solutionsCloseId }}" class="mt-4 px-4 py-2 bg-gray-500 text-white text-sm rounded hover:bg-gray-600">
            بستن
        </button>
    </div>
</div>
@endif

{{-- شِیمر استایل --}}
@once
    @push('styles')
        <style>
            .shimmer {
                background: linear-gradient(to right, #f3f3f3 8%, #e0e0e0 18%, #f3f3f3 33%);
                background-size: 800px 104px;
                animation: shimmer 2s infinite linear;
            }

            @keyframes shimmer {
                0% { background-position: -468px 0; }
                100% { background-position: 468px 0; }
            }
        </style>
    @endpush
@endonce

{{-- اسکریپت مدال --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modals = [
            {
                buttonId: '{{ $descriptionButtonId }}',
                modalId: '{{ $descriptionModalId }}',
                closeId: '{{ $descriptionCloseId }}'
            },
            {
                buttonId: '{{ $solutionsButtonId }}',
                modalId: '{{ $solutionsModalId }}',
                closeId: '{{ $solutionsCloseId }}'
            }
        ];

        modals.forEach(({ buttonId, modalId, closeId }) => {
            const button = document.getElementById(buttonId);
            const modal = document.getElementById(modalId);
            const close = document.getElementById(closeId);

            if (button && modal && close) {
                button.addEventListener('click', () => {
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100');
                });

                close.addEventListener('click', () => {
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    modal.classList.remove('opacity-100');
                });
            }
        });
    });

    function fillProgress(id, percent) {
        const circle = document.getElementById('progressRing_' + id);
        const radius = 50;
        const circumference = 2 * Math.PI * radius;
        let currentOffset = circumference;
        const targetOffset = circumference - (percent / 100) * circumference;
        const duration = 800;
        const start = performance.now();

        function animate(time) {
            const progress = Math.min((time - start) / duration, 1);
            circle.style.strokeDashoffset = circumference - ((percent / 100) * circumference * progress);
            if (progress < 1) requestAnimationFrame(animate);
        }

        requestAnimationFrame(animate);
    }
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
