<!-- resources/views/components/progress.blade.php -->
<div id="progress-ring-container" class="flex justify-end">
    <div class="relative w-14 h-14">
        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="45" stroke="#e5e7eb" stroke-width="10" fill="none" />
            <circle id="progress-ring" cx="50" cy="50" r="45" stroke="url(#grad)" stroke-width="10" fill="none" stroke-linecap="round" stroke-dasharray="282.6" stroke-dashoffset="282.6" />
            <defs>
                <linearGradient id="grad" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#ec4899" />
                    <stop offset="100%" stop-color="#14b8a6" />
                </linearGradient>
            </defs>
        </svg>
        <div class="absolute inset-0 flex items-center justify-center">
            <span id="progress-percent" class="text-xs font-bold text-gray-800">۰%</span>
        </div>
    </div>
</div>
