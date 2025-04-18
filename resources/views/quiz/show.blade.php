<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-center font-bold py-4">🎯 تست علاقه‌مندی‌های کودکان</h2>
    </x-slot>

    <div class="min-h-screen py-6 flex justify-center items-center bg-gray-100 bg-mobile"
         style="background-image: url('/images/rear-view-boy-standing-against-wall-home_1048944-14881820 (1).jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="w-full h-full max-w-2xl p-6 rounded-lg shadow" style="margin-top: -110px;">
        <div id="intro-screen" class="text-center">
    <h3 class="text-3xl bg-white/50 font-bold mb-4 text-black rounded-md py-2">سلام! آماده‌ای شروع کنیم؟</h3>

    <!-- 🔹 توضیحات آزمون -->
    <div class="text-right bg-white/40 rounded-lg p-4 text-gray-800 mb-6 leading-relaxed shadow text-xl xl:text-2xl">
        <p class="text-3xl font-bold text-indigo-800 mb-2">🧠 آزمون جامع استعدادیابی کودکان ۳ تا ۶ ساله</p>
        <p class="text-3xl">این آزمون شامل <span class="font-semibold">۱۰ بخش</span> و <span class="font-semibold">۵۰ سؤال</span> است (۵ سؤال در هر بخش)</p> </p>

        <p class="text-3xl" dir="rtl">آزمون به‌گونه‌ای طراحی شده که برای <span class="font-semibold">والدین و مربیان</span> قابل‌اجرا باشد و تمامی جنبه‌های استعداد کودک را بررسی کند.    </div>

    <button onclick="autoFillAnswers()" class="bg-blue-600 text-2xl text-white px-6 py-2 rounded hover:bg-blue-700 mt-4">
        تست خودکار (خیلی زیاد)
    </button>

    <button onclick="startQuiz()" class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800 text-2xl">
        شروع
    </button>
</div>


            <form method="POST" action="{{ route('quiz.submit') }}" id="quiz-form" class="hidden pt-10">
                @csrf
                <div class="text-center pb-5 pr-8 space-y-6 text-2xl text-black">
                    @foreach ($questions->groupBy('section') as $section => $sectionQuestions)
                        <div class="pb-5 section {{ $loop->first ? '' : 'hidden' }}" data-section="{{ $loop->index }}">
                            <!-- نمایش عنوان بخش -->
                            <h3 class="text-3xl font-bold py-4 bg-black/50 rounded-md text-white">{{ $section }}</h3>

                            @foreach ($sectionQuestions as $index => $question)
                                <div class="question {{ $loop->first ? '' : 'hidden' }}" data-question="{{ $index }}">
                                    <p class="font-semibold mt-4 rounded-md text-3xl bg-white/50">{{ $question->question }}</p>
                                    <div class="mt-10 text-3xl">
                                        @foreach ([4 => 'خیلی زیاد', 3 => 'خوب', 2 => 'گاهی', 1 => 'کم'] as $value => $label)
                                            <label class="font-bold mt-6 block answer-option text-3xl text-black ">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $value }}"
                                                       class="answer" onclick="handlePulse(this)">
                                                {{ $label }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <!-- دکمه‌ها و پیشرفت در یک ردیف -->
                <div class="flex justify-between items-center mt-8">
                    <button type="button" onclick="prevStep()" id="prev-btn"
                            class="hidden text-2xl bg-yellow-200 px-6 py-2 rounded font-bold">
                        قبلی
                    </button>

                    <span class=" p-2 rounded-md text-2xl  font-bold bg-white/50 text-black">
                        پیشرفت: <span class="text-xl" id="progress-percent">0%</span>
                    </span>
                </div>

                <!-- دکمه ارسال -->
                <div class="flex justify-center mt-4">
                    <button type="submit" id="submit-btn"
                            class="hidden text-2xl bg-green-500 text-white px-8 py-3 rounded-md">
                        ارسال
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- 🎨 استایل‌ها -->
    <style>
        @keyframes white-border-blink {
            0%, 100% { border: 2px solid transparent; }
            25%, 75% { border: 2px solid white; }
            50% { border: 2px solid transparent; }
        }

        .white-border-animate {
            animation: white-border-blink 0.5s ease;
            border-radius: 8px;
        }

        .answer-option {
            cursor: pointer;
            padding: 4px;
            border-radius: 8px;
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        .fade-out {
            animation: fadeOut 0.6s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }

        @media (max-width: 768px) {
            .bg-mobile {
                background-size: contain !important;
                background-repeat: no-repeat !important;
                background-position: right center !important;
            }
        }
    </style>

    <!-- ⚙️ اسکریپت‌ها -->
    <script>
        function autoFillAnswers() {
            // انتخاب همه inputهای radio با مقدار 4 (خیلی زیاد)
            const allQuestions = document.querySelectorAll('.question');
            
            allQuestions.forEach(question => {
                const input = question.querySelector('input[value="4"]');
                if (input) {
                    input.checked = true;
                }
            });

            updateButtons();
            updateProgress();
            alert("همه پاسخ‌ها با «خیلی زیاد» پر شد ✅");
        }

        let currentSection = 0;
        let currentQuestion = 0;
        const sections = document.querySelectorAll(".section");
        const submitBtn = document.getElementById("submit-btn");
        const prevBtn = document.getElementById("prev-btn");

        function startQuiz() {
            const intro = document.getElementById("intro-screen");
            const form = document.getElementById("quiz-form");

            // شروع انیمیشن محو شدن intro
            intro.classList.add("fade-out");

            setTimeout(() => {
                intro.classList.add("hidden");
                intro.classList.remove("fade-out");

                // نمایش فرم سوالات با افکت ظاهر شدن
                form.classList.remove("hidden");
                form.classList.add("fade-in");

                setTimeout(() => form.classList.remove("fade-in"), 300);

                updateButtons();
            }, 300);
        }

        function nextStep() {
            const questions = sections[currentSection].querySelectorAll(".question");
            const current = questions[currentQuestion];
            current.classList.add("fade-out");

            setTimeout(() => {
                current.classList.add("hidden");
                current.classList.remove("fade-out");
                currentQuestion++;

                if (currentQuestion < questions.length) {
                    const next = questions[currentQuestion];
                    next.classList.remove("hidden");
                    next.classList.add("fade-in");
                    setTimeout(() => next.classList.remove("fade-in"), 300);
                } else {
                    nextSection();
                }

                updateButtons();
                updateProgress();
            }, 300);
        }

        function prevStep() {
            const questions = sections[currentSection].querySelectorAll(".question");
            const current = questions[currentQuestion];
            current.classList.add("fade-out");

            setTimeout(() => {
                current.classList.add("hidden");
                current.classList.remove("fade-out");

                if (currentQuestion > 0) {
                    currentQuestion--;
                    const prev = questions[currentQuestion];
                    prev.classList.remove("hidden");
                    prev.classList.add("fade-in");
                    setTimeout(() => prev.classList.remove("fade-in"), 600);
                } else if (currentSection > 0) {
                    sections[currentSection].classList.add("hidden");
                    currentSection--;
                    sections[currentSection].classList.remove("hidden");
                    const prevList = sections[currentSection].querySelectorAll(".question");
                    currentQuestion = prevList.length - 1;
                    const last = prevList[currentQuestion];
                    last.classList.remove("hidden");
                    last.classList.add("fade-in");
                    setTimeout(() => last.classList.remove("fade-in"), 300);
                }

                updateButtons();
                updateProgress();
            }, 300);
        }

        function nextSection() {
            sections[currentSection].classList.add("hidden");
            currentSection++;
            if (currentSection < sections.length) {
                sections[currentSection].classList.remove("hidden");
                currentQuestion = 0;
                const first = sections[currentSection].querySelector(".question");
                first.classList.remove("hidden");
                first.classList.add("fade-in");
                setTimeout(() => first.classList.remove("fade-in"), 300);
            }
        }

        function updateButtons() {
            prevBtn.classList.toggle("hidden", currentSection === 0 && currentQuestion === 0);
            let totalQuestions = document.querySelectorAll(".question").length;
            let answered = document.querySelectorAll(".answer:checked").length;
            submitBtn.classList.toggle("hidden", answered < totalQuestions);
        }

        function updateProgress() {
            let total = document.querySelectorAll(".question").length;
            let answered = document.querySelectorAll(".answer:checked").length;
            let percent = Math.round((answered / total) * 100);
            document.getElementById("progress-percent").textContent = percent + "%";
        }

        function handlePulse(input) {
            const parent = input.closest('.answer-option');
            parent.classList.add('white-border-animate');
            setTimeout(() => {
                parent.classList.remove('white-border-animate');
                nextStep();
            }, 600);
        }
    </script>
</x-app-layout>
