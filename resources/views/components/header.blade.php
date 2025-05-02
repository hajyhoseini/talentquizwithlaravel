<!-- resources/views/components/header.blade.php -->

<header class="bg-[#04CCCC] shadow-md py-2 px-6 fixed top-0 left-0 w-full z-50">
    <div class=" mx-auto flex flex-row justify-between items-center text-center" dir="rtl">
        
        <!-- تصویر سمت راست -->
        <div class="flex-shrink-0">
            <img src="/images/3.png" alt="لوگوی سایت" class="h-20 w-auto">
        </div>

        <!-- منوی ناوبری سمت چپ -->
        <nav class="flex flex-wrap justify-end gap-6 text-lg font-semibold">
            <a href="/" class="bg-white text-black py-3 px-6 rounded-xl shadow-md hover:bg-blue-100 hover:text-blue-700 hover:scale-105 transform transition duration-300 ease-in-out">
                خانه
            </a>
            <a href="/dashboard" class="bg-white text-black py-3 px-6 rounded-xl shadow-md hover:bg-green-100 hover:text-green-700 hover:scale-105 transform transition duration-300 ease-in-out">
                داشبورد
            </a>
            <a href="/exams" class="bg-white text-black py-3 px-6 rounded-xl shadow-md hover:bg-purple-100 hover:text-purple-700 hover:scale-105 transform transition duration-300 ease-in-out">
                آزمون‌ها
            </a>
            <a href="/about" class="bg-white text-black py-3 px-6 rounded-xl shadow-md hover:bg-yellow-100 hover:text-yellow-700 hover:scale-105 transform transition duration-300 ease-in-out">
                درباره ما
            </a>
        </nav>
    </div>
</header>
