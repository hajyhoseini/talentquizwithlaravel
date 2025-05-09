<footer id="footer" dir="rtl"
  class="bg-white text-white py-10 mt-10 opacity-0 transform translate-y-20 transition-all duration-1000 font-vazir text-base md:mr-[250px]">
  <div class="max-w-6xl mx-auto px-4">

    <!-- Main Footer -->
    <div
      class="flex flex-col md:flex-row justify-between items-center md:items-start text-center md:text-right space-y-10 md:space-y-0">

 <!-- Social Buttons -->
<div class="w-full md:w-1/3 flex flex-col items-center space-y-10">
  <a href="https://www.instagram.com/bonyad_melal_kids" target="_blank"
    class="bg-white text-[#E1306C] w-40 flex items-center justify-center gap-2 py-2 px-4 rounded-full shadow-[0_10px_30px_rgba(225,48,108,0.3)] transition-all duration-300 hover:scale-105 hover:bg-[#E1306C] hover:text-black">
    <img src="/images/instagram.png" alt="Instagram" class="w-5 h-5" />
    <span class="text-lg font-semibold">اینستاگرام</span>
  </a>
  <a href="https://t.me/bonyad_melal_kids" target="_blank"
    class="bg-white text-[#0088cc] w-40 flex items-center justify-center gap-2 py-2 px-4 rounded-full shadow-[0_10px_30px_rgba(0,136,204,0.3)] transition-all duration-300 hover:scale-105 hover:bg-[#0088cc] hover:text-black">
    <img src="/images/telegram.png" alt="Telegram" class="w-5 h-5" />
    <span class="text-lg font-semibold">تلگرام</span>
  </a>
  <a href="https://wa.me" target="_blank"
    class="bg-white text-[#25D366] w-40 flex items-center justify-center gap-2 py-2 px-4 rounded-full shadow-[0_10px_30px_rgba(37,211,102,0.3)] transition-all duration-300 hover:scale-105 hover:bg-[#25D366] hover:text-black">
    <img src="/images/whatsapp.png" alt="WhatsApp" class="w-5 h-5" />
    <span class="text-lg font-semibold">واتساپ</span>
  </a>
</div>


      <!-- Newsletter Section -->
      <div class="w-full md:w-1/3 flex flex-col items-center text-center md:items-start md:text-right space-y-3">
        <img src="/images/3.png" alt="Newsletter Image"
          class="w-32 h-auto rounded-md shadow-sm border-none mx-auto" />
        <h3 class="text-xl font-bold mx-auto text-black">خبرنامه بنیاد ملل</h3>
        <p class="text-base mb-2 text-black">با عضویت در خبرنامه از جدیدترین تست‌ها و تخفیف‌ها مطلع شوید.</p>
        <form class="w-full max-w-xs flex flex-col sm:flex-row gap-2 items-center md:items-start">
          <input type="email" placeholder="ایمیل خود را وارد کنید..."
            class="w-full  l text-sm text-black rounded focus:outline-none border-2" />
          <button
            class="bg-gray-700  hover:bg-[#02aaaa] transition-colors text-white px-4 py-2 rounded text-sm">ثبت</button>
        </form>
      </div>

      <!-- Useful Links -->
      <div class="w-full md:w-1/3">
        <h3 class="text-xl font-bold mb-4">لینک‌های مفید</h3>
        <ul class="space-y-6 text-sm">
          <li><a href="/about" class="hover:underline text-black font-bold">درباره ما</a></li>
          <li><a href="/contact" class="hover:underline text-black font-bold">تماس با ما</a></li>
          <li><a href="/privacy" class="hover:underline text-black font-bold">حریم خصوصی</a></li>
          <li><a href="/terms" class="hover:underline text-black font-bold">شرایط استفاده</a></li>
        </ul>
      </div>

    </div>

    <!-- Footer Bottom -->
    <div class="border-t border-white mt-10 pt-4 text-center text-sm">
      <p class="text-black">© 2025 تمامی حقوق برای <span class="font-bold text-black">بنیاد ملل</span> محفوظ است.</p>
      <p class="mt-2 text-black">
        توسعه داده شده توسط
        <a href="https://naslejavan.com" target="_blank"
          class="underline text-black hover:text-gray-300">ابوالفضل حاجی حسینی</a>
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
    }, { threshold: 0.2 });

    observer.observe(footer);
  });
</script>

<style>
  .font-vazir {
    font-family: 'Vazir', sans-serif;
  }
</style>
