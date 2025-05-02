<x-app-layout> 
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">
            🧪 {{ __('آزمون‌های موجود') }}
        </h2>
    </x-slot>

    {{-- استایل انیمیشن‌ها --}}
    <style>
        @keyframes rocketIn {
            0% {
                transform: translateY(100px) scale(0.8) rotate(-10deg);
                opacity: 0;
            }
            100% {
                transform: translateY(0) scale(1) rotate(0);
                opacity: 1;
            }
        }

        .rocket-anim {
            animation: rocketIn 0.8s ease-out forwards;
        }

        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.2);
            border-top: 3px solid white;
            border-radius: 50%;
            width: 1.5rem;
            height: 1.5rem;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <div id="main-wrapper">
    @include('layouts.components.imageHeader')

    @include('layouts.components.sidebar')
    </div>
    <div class="py-8 flex justify-center items-center min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/top-view-keyboard-desk-with-succulent-plant-sticky-notes.jpg');" dir="rtl">
        <div class="w-full max-w-4xl mx-auto bg-opacity-90 p-6 rounded-xl border text-center">
            <h3 class="font-bold text-gray-800 mb-6 bg-white/70 py-5 rounded-md text-2xl">📋 لیست آزمون‌ها</h3>
            @include('test')


            @foreach ($exams as $index => $exam)
                <div 
                    class="border rounded-lg p-3  mb-6 text-left bg-white/70 opacity-0 rocket-anim"
                    style="animation-delay: {{ $index * 0.3 }}"
                >
                    <h4 class="text-xl xl:text-3xl font-bold  text-gray-900 mb-2">{{ $exam->title }}</h4>
                    <p class="text-gray-700 text-lg xl:text-3xl font-bold mb-4 leading-relaxed">
                        {{ $exam->description }}
                    </p>
                    <div class="text-right w-full">
                        <form action="{{ route('exams.show', $exam->id) }}" method="GET" class="inline-block" onsubmit="return handleLoading(this)">
                            <button type="submit" class="start-btn inline-flex items-center gap-2 text-sm bg-gray-800 hover:bg-gray-900 text-white p-2 rounded-md font-semibold transition relative">
                                <span class="btn-text">🚀 شروع آزمون</span>
                                <span class="spinner hidden"></span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- اسکریپت فعال‌سازی لودینگ --}}
    <script>
        function handleLoading(form) {
            const button = form.querySelector('.start-btn');
            const text = button.querySelector('.btn-text');
            const spinner = button.querySelector('.spinner');

            text.classList.add('hidden');
            spinner.classList.remove('hidden');

            // بستن چندباره کلیک
            button.disabled = true;

            return true; // اجازه ارسال فرم
        }
    </script>
</x-app-layout>
