@props([
    'url' => request()->fullUrl(),
    'title' => 'نتیجه آزمون من رو ببین!',
])

<!-- کادر تشویقی -->
<div class="flex justify-center mb-6">
    <div class="bg-white border-l-4 border-black text-black p-4 rounded-lg shadow-md w-full sm:w-2/3 md:w-1/2">
        <p class="text-lg font-semibold">🎉 شما می‌توانید نتایج استعدادیابی خود را با دوستانتان به اشتراک بگذارید و از دیدگاه‌ها و حمایت‌های آنها بهره‌مند شوید!</p>
        <p>هم‌اکنون از طریق دکمه‌های زیر، به راحتی نتایج خود را در شبکه‌های اجتماعی مختلف به اشتراک بگذارید و دیگران را در مسیر کشف استعدادهای خود همراه کنید.</p>
    </div>
</div>

<!-- دکمه‌های اشتراک گذاری -->
<div class="flex justify-center gap-3 mt-6">
    {{-- واتساپ --}}
    <a href="https://wa.me/?text={{ urlencode($title . ' ' . $url) }}"
       target="_blank"
       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md flex items-center gap-2 transition">
        <x-heroicon-o-phone class="w-5 h-5" fill="currentColor"/>
        اشتراک در واتساپ
    </a>

    {{-- تلگرام --}}
    <a href="https://t.me/share/url?url={{ urlencode($url) }}&text={{ urlencode($title) }}"
       target="_blank"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md flex items-center gap-2 transition">
        <x-heroicon-o-chat-alt class="w-5 h-5" fill="currentColor"/>
        اشتراک در تلگرام
    </a>

    {{-- اینستاگرام --}}
    <a href="https://www.instagram.com/?url={{ urlencode($url) }}"
       target="_blank"
       class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow-md flex items-center gap-2 transition">
        <x-heroicon-o-camera class="w-5 h-5" fill="currentColor"/>
        اشتراک در اینستاگرام
    </a>

    {{-- کپی لینک --}}
    <button onclick="copyToClipboard('{{ $url }}')"
        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-md flex items-center gap-2 transition">
        <x-heroicon-o-clipboard class="w-5 h-5" fill="currentColor"/>
        کپی لینک
    </button>
</div>



{{-- 📎 اسکریپت کپی کلیپ‌بورد --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // استفاده از SweetAlert2 برای پیام موفقیت
            Swal.fire({
                icon: 'success',
                title: 'کپی شد!',
                text: 'لینک با موفقیت کپی شد.',
                showConfirmButton: false,
                timer: 1500
            });
        }).catch(() => {
            // استفاده از SweetAlert2 برای پیام خطا
            Swal.fire({
                icon: 'error',
                title: 'خطا!',
                text: 'کپی لینک انجام نشد.',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }
</script>
