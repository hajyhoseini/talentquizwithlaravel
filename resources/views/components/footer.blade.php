<footer id="footer" dir="rtl" class="bg-[#04CCCC] text-white py-16 mt-12 opacity-0 transform translate-y-20 transition-all duration-1000 font-vazir text-xl">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Newsletter (جدا شده از بخش فلکسی) -->
        <div class="w-full text-center flex flex-col justify-center items-center mb-20">
            <img src="/images/3.png" alt="Newsletter Image" class="mb-6 w-full h-auto max-w-xl mx-auto rounded-xl shadow-lg border-none" />
            <h3 class="text-4xl font-extrabold mb-6">خبرنامه بنیاد ملل</h3>
            <p class="text-2xl mb-8">با عضویت در خبرنامه از جدیدترین تست‌ها و تخفیف‌ها مطلع شوید.</p>

            <!-- Full Width Input & Button -->
            <div class="w-full">
                <form dir="rtl" class="flex flex-col gap-4 w-full px-4 sm:px-8 max-w-full">
                    <input type="email" placeholder="ایمیل خود را وارد کنید..."
                           class="px-6 py-5 rounded text-black w-full text-2xl focus:outline-none border-none" />
                    <button class="bg-gray-700 hover:bg-[#02aaaa] transition-colors text-white px-8 py-5 rounded text-2xl w-full">
                        ثبت
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Footer Content -->
        <div class="flex flex-col md:flex-row justify-between items-center md:items-start text-center md:text-right space-y-12 md:space-y-0">
            
            <!-- Social Buttons -->
            <div class="w-full md:w-1/3 flex flex-col items-center justify-center space-y-5">
                <a href="https://www.instagram.com/bonyad_melal_kids?igsh=MWgweDFwaWRtdmx2cw==" target="_blank"
                   class="bg-white text-[#E1306C] w-48 flex items-center justify-center gap-3 py-3 px-6 rounded-full shadow-lg transition-all duration-300 hover:scale-105 hover:bg-[#E1306C] hover:text-white">
                    <img src="/images/instagram.png" alt="Instagram" class="w-6 h-6" />
                    <span class="text-2xl font-semibold">اینستاگرام</span>
                </a>
                <a href="https://t.me/bonyad_melal_kids" target="_blank"
                   class="bg-white text-[#0088cc] w-48 flex items-center justify-center gap-3 py-3 px-6 rounded-full shadow-lg transition-all duration-300 hover:scale-105 hover:bg-[#0088cc] hover:text-white">
                    <img src="/images/telegram.png" alt="Telegram" class="w-6 h-6" />
                    <span class="px-2 text-3xl font-semibold">تلگرام</span>
                </a>
                <a href="https://wa.me" target="_blank"
                   class="bg-white text-[#25D366] w-48 flex items-center justify-center gap-3 py-3 px-6 rounded-full shadow-lg transition-all duration-300 hover:scale-105 hover:bg-[#25D366] hover:text-white">
                    <img src="/images/whatsapp.png" alt="WhatsApp" class="w-6 h-6" />
                    <span class="text-3xl font-semibold">واتساپ</span>
                </a>
            </div>

            <!-- Useful Links -->
            <div class="w-full md:w-1/3">
                <h3 class="text-3xl font-extrabold mb-4">لینک‌های مفید</h3>
                <ul class="space-y-4 text-xl">
                    <li><a href="/about" class="hover:underline">درباره ما</a></li>
                    <li><a href="/contact" class="hover:underline">تماس با ما</a></li>
                    <li><a href="/privacy" class="hover:underline">حریم خصوصی</a></li>
                    <li><a href="/terms" class="hover:underline">شرایط استفاده</a></li>
                </ul>
            </div>

        </div>

        <!-- Divider -->
        <div class="border-t border-white mt-12 pt-6 text-center text-lg">
            <p>© 2025 تمامی حقوق برای <span class="font-bold">بنیاد ملل</span> محفوظ است.</p>
            <p class="mt-3">
                توسعه داده شده توسط
                <a href="https://naslejavan.com" target="_blank" class="underline hover:text-gray-200">ابوالفضل حاجی حسینی</a>
            </p>
        </div>
    </div>
</footer>

<!-- Scroll Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const footer = document.getElementById('footer');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footer.classList.remove('opacity-0', 'translate-y-20');
                    footer.classList.add('opacity-100', 'translate-y-0');
                }
            });
        }, {
            threshold: 0.2
        });

        observer.observe(footer);
    });
</script>

<!-- Custom Style for Font -->
<style>
    .font-vazir {
        font-family: 'Vazir', sans-serif;
    }
</style>
