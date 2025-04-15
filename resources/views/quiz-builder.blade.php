<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-center py-4 text-white drop-shadow">🎯 ساخت آزمون مرحله‌ای</h2>
    </x-slot>

    <div class="min-h-screen flex items-center justify-center bg-cover bg-center relative rtl text-right"
         style="background-image: url('/images/dried-leaves-gray-blank-background_53876-102451.avif'); 
                background-size: cover; 
                background-position: center center; 
                background-repeat: no-repeat; 
                background-attachment: fixed;">

        <div class="relative z-10 backdrop-blur-md rounded-lg shadow p-6 w-full max-w-xl dir-rtl text-right">
            <form method="POST" action="{{ route('quizzes.storeStepByStep') }}" id="quiz-builder-form">
                @csrf

                {{-- مرحله 1: وارد کردن رمز عبور --}}
                <div class="step" id="step-1">
                    <label class="block text-xl font-bold mb-2">:رمز عبور</label>
                    <input type="password" id="password" class="w-full border p-2 rounded text-right" required>
                    <p class="text-red-600 text-sm hidden mt-1" id="error-step-1">.لطفا رمز عبور را وارد کنید</p>
                    <p class="text-red-600 text-sm hidden mt-1" id="error-password">.رمز عبور اشتباه است</p>

                    <div class="text-left">
                        <button type="button" onclick="validatePassword()" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded">
                            ادامه
                        </button>
                    </div>
                </div>

                {{-- مرحله 2 --}}
                <div class="step hidden" id="step-2">
                    <label class="block text-xl font-bold mb-2">:نام سازنده آزمون</label>
                    <input type="text" name="creator_name" class="w-full border p-2 rounded text-right" required>
                    <p class="text-red-600 text-sm hidden mt-1" id="error-step-2">.لطفا نام سازنده را وارد کنید</p>

                    <div class="text-left">
                        <button type="button" onclick="nextStep(2)" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded">
                            ادامه
                        </button>
                    </div>
                </div>

                {{-- مرحله 3 --}}
                <div class="step hidden" id="step-3">
                    <label class="block text-xl font-bold mb-2">:عنوان آزمون</label>
                    <input type="text" name="quiz_title" class="w-full border p-2 rounded text-right" required>
                    <p class="text-red-600 text-sm hidden mt-1" id="error-step-3">.لطفاً عنوان آزمون را وارد کنید</p>

                    <div class="text-left">
                        <button type="button" onclick="nextStep(3)" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded">
                            ادامه
                        </button>
                    </div>
                </div>

                {{-- مرحله 4 --}}
                <div class="step hidden" id="step-4">
                    <label class="block text-xl font-bold mb-2">:تعداد سوالات </label>
                    <input type="number" name="question_count" id="question-count" min="1" class="w-full border p-2 rounded text-right" required>
                    <p class="text-red-600 text-sm hidden mt-1" id="error-step-4">.تعداد سوالات باید حداقل ۱ باشد</p>

                    <div class="text-left">
                        <button type="button" onclick="generateQuestionInputs()" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded">
                            ادامه
                        </button>
                    </div>
                </div>

                {{-- سوالات دینامیک --}}
                <div id="dynamic-steps" class="hidden mt-6 text-right"></div>

                {{-- مرحله نهایی --}}
                <div id="final-step" class="hidden mt-6 text-left">
                    <button type="submit" onclick="return validateFinalStep()" class="bg-green-600 text-white px-6 py-2 rounded">
                        ذخیره آزمون ✅
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
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

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .min-h-screen {
                background-attachment: scroll; /* Fixed background doesn't work well on mobile, so we switch to scroll */
            }
        }
    </style>

    <script>
        let currentStep = 1;

        function validatePassword() {
            const passwordInput = document.getElementById('password');
            const errorMsg = document.getElementById('error-password');
            const correctPassword = 'hajy'; // رمز عبور صحیح

            if (passwordInput.value.trim() !== correctPassword) {
                errorMsg.classList.remove('hidden');
                return;
            } else {
                errorMsg.classList.add('hidden');
                nextStep(1); // اگر رمز درست بود، مرحله بعد نمایش داده می‌شود.
            }
        }

        function nextStep(stepNum) {
            let valid = true;
            const currentInput = document.querySelector(`#step-${stepNum} input`);
            const errorMsg = document.getElementById(`error-step-${stepNum}`);

            if (!currentInput.value.trim()) {
                errorMsg.classList.remove('hidden');
                valid = false;
            } else {
                errorMsg.classList.add('hidden');
            }

            if (valid) {
                const current = document.getElementById(`step-${stepNum}`);
                const next = document.getElementById(`step-${stepNum + 1}`);
                current.classList.add("fade-out");

                setTimeout(() => {
                    current.classList.add("hidden");
                    current.classList.remove("fade-out");

                    next.classList.remove("hidden");
                    next.classList.add("fade-in");

                    setTimeout(() => next.classList.remove("fade-in"), 600);
                    currentStep++;
                }, 600);
            }
        }

        function generateQuestionInputs() {
            const countInput = document.getElementById('question-count');
            const count = parseInt(countInput.value);
            const errorMsg = document.getElementById('error-step-4');

            if (!count || count < 1) {
                errorMsg.classList.remove('hidden');
                return;
            }

            errorMsg.classList.add('hidden');
            const container = document.getElementById('dynamic-steps');
            container.innerHTML = '';

            for (let i = 1; i <= count; i++) {
                const questionDiv = document.createElement('div');
                questionDiv.classList.add('mb-6', 'fade-in');
                questionDiv.innerHTML = `
                    <label class="font-bold text-xl block mb-1">:سوال ${i}</label>
                    <input type="text" name="questions[${i}][text]" class="w-full border p-2 rounded mb-2 text-right" required>

                    <label class="block text-xl mb-1">:تعداد گزینه‌ها</label>
                    <input type="number" min="2" max="10"
                        class="border p-1 rounded mb-2 text-right"
                        oninput="showOptionButton(this, ${i})"
                        name="questions[${i}][option_count]" required>

                    <button type="button" id="add-options-btn-${i}" onclick="generateOptions(${i})"
                            class="bg-blue-600 text-white px-3 py-1 rounded mb-2 hidden">
                        افزودن گزینه‌ها ✅
                    </button>

                    <div id="options-${i}" class="text-right"></div>
                `;
                container.appendChild(questionDiv);
            }

            container.classList.remove('hidden');

            const step4 = document.getElementById('step-4');
            step4.classList.add('fade-out');
            setTimeout(() => {
                step4.classList.add('hidden');
                step4.classList.remove('fade-out');

                const finalStep = document.getElementById('final-step');
                finalStep.classList.remove('hidden');
                finalStep.classList.add('fade-in');
                setTimeout(() => finalStep.classList.remove('fade-in'), 600);
            }, 600);
        }

        function showOptionButton(input, questionIndex) {
            const value = parseInt(input.value);
            const btn = document.getElementById(`add-options-btn-${questionIndex}`);
            if (value >= 2 && value <= 10) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        }

        function generateOptions(questionIndex) {
            const optionInput = document.querySelector(`[name="questions[${questionIndex}][option_count]"]`);
            const optionCount = parseInt(optionInput.value);
            const optionsContainer = document.getElementById(`options-${questionIndex}`);
            optionsContainer.innerHTML = '';

            for (let j = 1; j <= optionCount; j++) {
                const opt = document.createElement('input');
                opt.type = 'text';
                opt.name = `questions[${questionIndex}][options][]`;
                opt.placeholder = `گزینه ${j}`;
                opt.classList.add('w-full', 'border', 'p-2', 'rounded', 'mb-1', 'text-right');
                optionsContainer.appendChild(opt);
            }
        }

        function validateFinalStep() {
            let valid = true;
            const inputs = document.querySelectorAll('#dynamic-steps input[type="text"]');

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('border-red-500');
                    valid = false;
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                alert('لطفاً همه سوالات و گزینه‌ها را کامل وارد کنید.');
            }

            return valid;
        }
    </script>
</x-app-layout>
