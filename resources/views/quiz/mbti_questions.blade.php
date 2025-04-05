<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            🧠 {{ __('آزمون MBTI') }} 🧠
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-4xl w-full bg-white shadow-xl rounded-2xl p-8 text-center">
            <h2 class="text-3xl font-bold mb-8 text-purple-600">آزمون MBTI</h2>

            <form method="POST" action="{{ route('mbti.submit') }}" id="quiz-form">
                @csrf

                <div class="section-container">
                    @foreach ($questions->groupBy('section') as $section => $sectionQuestions)
                        <div class="section-slide {{ $loop->first ? 'active' : 'hidden' }}" data-section="{{ $loop->index }}">
                            <h3 class="text-2xl font-semibold mb-6 text-right text-white bg-gradient-to-r from-pink-500 to-teal-500 p-4 rounded-xl shadow-lg">{{ $section }}</h3>

                            <div class="question-container">
                                @foreach ($sectionQuestions as $index => $question)
                                    <div class="question-slide {{ $loop->first ? 'active' : 'hidden' }}" data-question="{{ $index }}">
                                        <p class="text-xl mb-4 font-medium text-gray-800">{{ $question->question }}</p>

                                        <div class="flex flex-wrap justify-center gap-6 bg-gradient-to-r from-yellow-200 to-pink-200 p-4 rounded-xl shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                                            @foreach (['yes' => '✅ بله', 'no' => '❌ خیر'] as $value => $label)
                                                <label class="inline-flex items-center mt-2">
                                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $value }}" class="form-radio text-pink-500 answer-option" onclick="nextStep()">
                                                    <span class="ml-2 text-lg text-purple-600">{{ $label }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center mt-6 gap-4">
                    <button type="button" class="bg-pink-500 text-white py-2 px-6 rounded-lg hidden text-lg font-semibold hover:bg-pink-600 transition transform hover:scale-110 hover:shadow-xl" id="prev-btn" onclick="prevStep()">قبلی</button>
                    <button type="submit" class="bg-teal-500 text-white py-2 px-6 rounded-lg text-lg font-bold hidden text-lg font-semibold hover:bg-teal-600 transition transform hover:scale-110 hover:shadow-xl" id="submit-btn">ارسال پاسخ‌ها</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentSection = 0;
        let currentQuestion = 0;
        const sections = document.querySelectorAll(".section-slide");
        const submitBtn = document.getElementById("submit-btn");
        const prevBtn = document.getElementById("prev-btn");

        function updateButtons() {
            prevBtn.classList.toggle("hidden", currentQuestion === 0 && currentSection === 0);
            submitBtn.classList.toggle("hidden", currentSection < sections.length - 1 || currentQuestion < document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`).length - 1);
        }

        function nextStep() {
            let questionsInCurrentSection = document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`);

            questionsInCurrentSection[currentQuestion].classList.add("hidden");
            currentQuestion++;

            if (currentQuestion < questionsInCurrentSection.length) {
                questionsInCurrentSection[currentQuestion].classList.remove("hidden");
            } else {
                nextSection();
            }
            updateButtons();
        }

        function prevStep() {
            let questionsInCurrentSection = document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`);

            if (currentQuestion > 0) {
                questionsInCurrentSection[currentQuestion].classList.add("hidden");
                currentQuestion--;
                questionsInCurrentSection[currentQuestion].classList.remove("hidden");
            } else if (currentSection > 0) {
                prevSection();
            }
            updateButtons();
        }

        function nextSection() {
            sections[currentSection].classList.add("hidden");
            currentSection++;
            if (currentSection < sections.length) {
                sections[currentSection].classList.remove("hidden");
                currentQuestion = 0;
            } else {
                submitBtn.classList.remove("hidden");
            }
        }

        function prevSection() {
            sections[currentSection].classList.add("hidden");
            currentSection--;
            sections[currentSection].classList.remove("hidden");

            let questionsInCurrentSection = document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`);
            currentQuestion = questionsInCurrentSection.length - 1;
        }

        updateButtons();
    </script>
</x-app-layout>
