<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-indigo-600" />
            </a>
        </x-slot>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="rtl text-right" id="multi-step-form">
            @csrf

            {{-- Step 1 --}}
            <div class="form-step" id="step-1">
                <div>
                    <x-label for="name" :value="'نام کامل'" />
                    <x-input id="name" name="name" type="text" class="block mt-1 w-full" required autofocus />
                    <p class="text-red-500 text-sm mt-1 hidden" id="name-error">نام را وارد کنید.</p>
                </div>
                <div class="mt-4">
                    <x-label for="email" :value="'ایمیل'" />
                    <x-input id="email" name="email" type="email" class="block mt-1 w-full" required />
                    <p class="text-red-500 text-sm mt-1 hidden" id="email-error">ایمیل معتبر وارد کنید.</p>
                </div>
                <div class="mt-4 text-left">
                    <button type="button" onclick="nextStep()" class="bg-indigo-600 text-white px-4 py-2 rounded">بعدی</button>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="form-step hidden" id="step-2">
                <div>
                    <x-label for="password" :value="'رمز عبور'" />
                    <x-input id="password" name="password" type="password" class="block mt-1 w-full" required />
                    <p class="text-red-500 text-sm mt-1 hidden" id="password-error">رمز عبور را وارد کنید.</p>
                </div>
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="'تکرار رمز عبور'" />
                    <x-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full" required />
                    <p class="text-red-500 text-sm mt-1 hidden" id="password-confirmation-error">رمز عبور با تکرار آن یکی نیست.</p>
                </div>
                <div class="mt-4 flex flex-row-reverse justify-between">
                    <button type="button" onclick="nextStep()" class="bg-indigo-600 text-white px-4 py-2 rounded">بعدی</button>
                    <button type="button" onclick="prevStep()" class="bg-gray-500 text-white px-4 py-2 rounded">قبلی</button>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="form-step hidden" id="step-3">
                
               
                <div class="mt-4 flex flex-row-reverse justify-between">
                    <button type="button" onclick="nextStep()" class="bg-indigo-600 text-white px-4 py-2 rounded">بعدی</button>
                    <button type="button" onclick="prevStep()" class="bg-gray-500 text-white px-4 py-2 rounded">قبلی</button>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="form-step hidden" id="step-4">
                <div>
                    <x-label :value="'سرویس ایمیل مورد استفاده'" />
                    <div class="mt-2 space-y-2">
                        <label><input type="radio" name="email_provider" value="gmail" required> جیمیل</label><br>
                        <label><input type="radio" name="email_provider" value="office"> آفیس</label><br>
                        <label><input type="radio" name="email_provider" value="drive"> درایو</label><br>
                        <label><input type="radio" name="email_provider" value="other"> دیگری</label>
                    </div>
                </div>
                <div class="mt-4 flex flex-row-reverse justify-between items-center">
                    <x-button class="bg-indigo-600 text-white px-4 py-2 rounded">ثبت‌نام</x-button>
                    <button type="button" onclick="prevStep()" class="bg-gray-500 text-white px-4 py-2 rounded">قبلی</button>
                </div>
            </div>
        </form>

        {{-- JavaScript --}}
        <script>
            let currentStep = 0;
            const steps = document.querySelectorAll('.form-step');

            function showStep(index) {
                steps.forEach((step, i) => {
                    step.classList.toggle('hidden', i !== index);
                });
            }

            function nextStep() {
                if (validateStep(currentStep)) {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                }
            }

            function prevStep() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            }

            function validateStep(step) {
                let valid = true;

                if (step === 0) {
                    const name = document.getElementById('name');
                    const email = document.getElementById('email');
                    const nameError = document.getElementById('name-error');
                    const emailError = document.getElementById('email-error');

                    nameError.classList.add('hidden');
                    emailError.classList.add('hidden');

                    if (!name.value.trim()) {
                        nameError.classList.remove('hidden');
                        valid = false;
                    }
                    if (!/^\S+@\S+\.\S+$/.test(email.value)) {
                        emailError.classList.remove('hidden');
                        valid = false;
                    }
                }

                if (step === 1) {
                    const password = document.getElementById('password');
                    const confirm = document.getElementById('password_confirmation');
                    const passError = document.getElementById('password-error');
                    const confirmError = document.getElementById('password-confirmation-error');

                    passError.classList.add('hidden');
                    confirmError.classList.add('hidden');

                    if (!password.value.trim()) {
                        passError.classList.remove('hidden');
                        valid = false;
                    }
                    if (password.value !== confirm.value) {
                        confirmError.classList.remove('hidden');
                        valid = false;
                    }
                }

                return valid;
            }

            showStep(currentStep);
        </script>

        {{-- Styles --}}
        <style>
            .hidden { display: none; }
            .rtl { direction: rtl; }
        </style>
    </x-auth-card>
</x-guest-layout>
