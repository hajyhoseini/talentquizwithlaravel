<x-guest-layout>
    <!-- بکگراند کامل -->
    <div class="min-h-screen bg-fixed bg-cover bg-center overflow-auto"
        style="background-image: url('{{ asset('images/foggy-scene-with-steam-coming-out-it_1122354-17706.avif') }}');"
    >

        <div class="flex items-center justify-center min-h-screen bg-white bg-opacity-80 backdrop-blur-sm p-4">
            <x-auth-card>
                <x-slot name="logo">
                    <a href="/">
                        <!-- آیکون جدید -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11.5l-7 7-7-7" />
                        </svg>
                    </a>
                </x-slot>

                <!-- نمایش خطاها -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6 text-right"  dir="rtl">
                    @csrf

                    <!-- فرم ورودی نام کاربری -->
                    <div class="relative">
                        <x-label for="name" :value="__('نام کاربری')" class="text-gray-700 font-medium" />
                        <div id="name-lottie" class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-2" style="max-width: 50px; display: none;">
                            <div class="lottie" style="width: 100%; height: 50px;"></div>
                        </div>
                        <x-input id="name" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                 type="text" name="name" :value="old('name', $user->name)" required />
                    </div>

                    <!-- فرم ورودی نام -->
                    <div class="relative">
                        <x-label for="first_name" :value="__('نام')" class="text-gray-700 font-medium" />
                        <div id="first-name-lottie" class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-2" style="max-width: 50px; display: none;">
                            <div class="lottie" style="width: 100%; height: 50px;"></div>
                        </div>
                        <x-input id="first_name" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                 type="text" name="first_name" :value="old('first_name', $user->first_name)" required />
                    </div>

                    <!-- فرم ورودی نام خانوادگی -->
                    <div class="relative">
                        <x-label for="last_name" :value="__('نام خانوادگی')" class="text-gray-700 font-medium" />
                        <div id="last-name-lottie" class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-2" style="max-width: 50px; display: none;">
                            <div class="lottie" style="width: 100%; height: 50px;"></div>
                        </div>
                        <x-input id="last_name" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                 type="text" name="last_name" :value="old('last_name', $user->last_name)" required />
                    </div>

                    <!-- فرم ورودی شماره تماس -->
                    <div class="relative">
                        <x-label for="phone" :value="__('شماره تماس')" class="text-gray-700 font-medium" />
                        <div id="phone-lottie" class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-2" style="max-width: 50px; display: none;">
                            <div class="lottie" style="width: 100%; height: 50px;"></div>
                        </div>
                        <x-input id="phone" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                 type="text" name="phone" :value="old('phone', $user->phone)" required />
                    </div>

                    <!-- فرم ورودی ایمیل -->
                    <div class="relative">
                        <x-label for="email" :value="__('ایمیل')" class="text-gray-700 font-medium" />
                        <div id="email-lottie" class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-2" style="max-width: 50px; display: none;">
                            <div class="lottie" style="width: 100%; height: 50px;"></div>
                        </div>
                        <x-input id="email" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                 type="email" name="email" :value="old('email', $user->email)" required />
                    </div>

                    <div class="text-center mt-6">
                        <x-button class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 px-6 py-3 rounded-md text-lg transition-all duration-300">
                            {{ __('💾 ذخیره تغییرات') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
        </div>
    </div>

    <!-- کتابخانه لوتی -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>

    <!-- اسکریپت مربوط به لوتی -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const inputs = document.querySelectorAll("input");  // تمام فیلدهای ورودی
            let typingTimer;

            // ایجاد انیمیشن لوتی برای هر ورودی
            const animations = {}; // ذخیره انیمیشن‌ها برای هر ورودی

            // ایجاد انیمیشن لوتی برای هر ورودی به صورت داینامیک
            function createLottieAnimation(elementId) {
                return lottie.loadAnimation({
                    container: document.querySelector(`#${elementId}`),  // قرار دادن انیمیشن در کنار هر فیلد
                    renderer: 'svg',
                    loop: true,
                    autoplay: false,
                    path: '/animations/login-loader.json'  // مسیر انیمیشن لوتی
                });
            }

            // برای هر فیلد ورودی یک انیمیشن لوتی ایجاد کنید
            inputs.forEach(input => {
                const inputId = input.id;
                animations[inputId] = createLottieAnimation(`${inputId}-lottie`);
            });

            // فعال کردن انیمیشن لوتی هنگام تایپ
            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    const inputId = input.id;
                    const lottieElement = animations[inputId];

                    if (lottieElement && !lottieElement.isPlaying) {
                        lottieElement.play();
                    }

                    // نمایش انیمیشن لوتی در کنار فیلد ورودی
                    document.querySelector(`#${inputId}-lottie`).style.display = 'block';

                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => {
                        hideLottie(inputId);
                    }, 1500); // توقف 1.5 ثانیه بعد از تایپ
                });
            });

            // مخفی کردن انیمیشن
            function hideLottie(inputId) {
                const lottieElement = animations[inputId];
                if (lottieElement) {
                    lottieElement.stop();
                }
                document.querySelector(`#${inputId}-lottie`).style.display = 'none';
            }
        });
    </script>

</x-guest-layout>
