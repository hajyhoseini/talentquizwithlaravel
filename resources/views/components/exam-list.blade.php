<!-- resources/views/components/exam-list.blade.php -->

<div class="py-8 flex justify-center items-center min-h-screen bg-cover bg-center bg-no-repeat" 
     style="background-image: url('/images/top-view-keyboard-desk-with-succulent-plant-sticky-notes.jpg');">
    <div class="w-full max-w-4xl mx-auto bg-opacity-90 p-6 rounded-xl border text-center">
        <h3 class="font-bold text-gray-800 mb-6 bg-white/70 py-5 rounded-md text-4xl">📋 لیست آزمون‌ها</h3>

        @foreach ($exams as $index => $exam)
            <div 
                class="border rounded-lg p-4 mb-6 text-right bg-white/70 opacity-0 rocket-anim"
                style="animation-delay: {{ $index * 0.3 }}s"
            >
                <h4 class="text-3xl font-semibold text-gray-900 mb-2">{{ $exam->title }}</h4>
                <p class="text-gray-700 text-3xl mb-4 leading-relaxed">
                    {{ $exam->description }}
                </p>
                <div class="text-left w-full">
                    <form action="{{ route('exams.show', $exam->id) }}" method="GET" class="inline-block" onsubmit="return handleLoading(this)">
                        <button type="submit" class="start-btn inline-flex items-center gap-2 text-xl bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-md font-semibold transition relative">
                            <span class="btn-text">🚀 شروع آزمون</span>
                            <span class="spinner hidden"></span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
