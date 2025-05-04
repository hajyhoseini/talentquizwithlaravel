<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>سامانه استعدادیابی</title>

  <link rel="shortcut icon" href="icons/favicon.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="css/style.css">

  <style>
    body {
      margin: 0;
      font-family: 'Vazirmatn', sans-serif;
      background: linear-gradient(135deg, #e0f8f7, #f5ffff);
      min-height: 100vh;
      color: #333;
    }

    .dashboard-cards,
    .dashboard-cards-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 28px;
      margin-top: 50px;
      padding: 0 5%;
    }

    .card,
    .skeleton-card {
      background: rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(0, 150, 150, 0.1);
      border-radius: 22px;
      padding: 24px 20px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 28px rgba(0, 128, 128, 0.07);
      text-align: center;
      overflow: hidden;
      text-decoration: none;
      transition: all 0.3s ease-in-out;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 30px rgba(0, 128, 128, 0.12);
    }

    .card-img {
      width: 100%;
      height: 160px;
      border-radius: 14px;
      object-fit: cover;
      margin-bottom: 18px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
      opacity: 0;
      transition: opacity 0.6s ease-in-out;
    }

    .card-img.lazy-img-loaded {
      opacity: 1;
    }

    .card-title {
      font-size: 20px;
      font-weight: 700;
      color: #007c86;
      margin: 0 auto;
      padding: 8px 14px;
      border-radius: 12px;
      background-color: rgba(255, 255, 255, 0.4);
      display: inline-block;
    }

    .card-text {
      font-size: 15px;
      color: #444;
      margin-top: 14px;
      line-height: 1.9;
      padding: 10px 14px;
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.35);
    }

    .footer {
      text-align: center;
      padding: 30px 0;
      font-size: 14px;
      color: #777;
    }

    .skeleton-card {
      position: relative;
      overflow: hidden;
    }

    .skeleton-shimmer {
      position: absolute;
      top: 0;
      left: -150px;
      width: 100px;
      height: 100%;
      background: linear-gradient(120deg, transparent, rgba(255,255,255,0.5), transparent);
      animation: shimmer 1.6s infinite;
    }

    @keyframes shimmer {
      100% {
        transform: translateX(400px);
      }
    }

    .skeleton-img,
    .skeleton-title,
    .skeleton-text {
      background-color: rgba(200, 200, 200, 0.3);
      border-radius: 10px;
      margin-bottom: 12px;
    }

    .skeleton-img {
      height: 160px;
      margin-bottom: 20px;
    }

    .skeleton-title {
      height: 24px;
      width: 60%;
      margin: 0 auto;
    }

    .skeleton-text {
      height: 18px;
      width: 80%;
      margin: 10px auto;
    }

    .real-cards .card {
      opacity: 0;
      transform: translateY(40px);
      transition: all 0.8s ease;
    }

    .real-cards .card.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .card {
  position: relative;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.6), rgba(240, 255, 255, 0.9));
  border: 1px solid rgba(0, 128, 128, 0.1);
  border-radius: 22px;
  padding: 26px 20px;
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 22px rgba(0, 150, 150, 0.08);
  text-align: center;
  text-decoration: none;
  transition: all 0.3s ease-in-out;
  overflow: hidden;
}

.card:hover {
  transform: translateY(-8px) scale(1.015);
  box-shadow: 0 12px 35px rgba(0, 150, 150, 0.15);
}

.card::before {
  content: '';
  position: absolute;
  top: -60px;
  right: -60px;
  width: 120px;
  height: 120px;
  background: radial-gradient(circle, rgba(0, 200, 200, 0.12), transparent 60%);
  transform: rotate(45deg);
}

.card-icon {
  font-size: 38px;
  margin-bottom: 12px;
  color: #008080;
  opacity: 0.8;
}

.card-title {
  font-size: 18px;
  font-weight: 700;
  color: #007c86;
  margin-bottom: 8px;
}

.card-text {
  font-size: 15px;
  color: #444;
  line-height: 1.8;
  background-color: rgba(255, 255, 255, 0.4);
  padding: 10px 14px;
  border-radius: 12px;
}

    @media (max-width: 768px) {
      .dashboard-cards,
      .dashboard-cards-section {
        grid-template-columns: 1fr;
      }
    }
    .dashboard-cards {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  padding: 16px;
}

.card {
  background-color: white;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  padding: 20px;
  text-align: center;
  transition: 0.3s ease;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
}

.card-icon {
  font-size: 24px;
  margin-bottom: 8px;
}

.card-title {
  font-weight: bold;
  margin-bottom: 6px;
}

.card-text {
  color: #666;
  font-size: 14px;
}

/* حالت 4 ستونه در دسکتاپ */
@media (min-width: 1024px) {
  .dashboard-cards {
    grid-template-columns: repeat(4, 1fr);
  }
}

  </style>
</head>

<body>

  <div class="header">
    <nav class="navbar"></nav>
  </div>

  <div id="main-wrapper">
    @include('layouts.components.imageHeader')
    @include('layouts.components.sidebar')
  </div>

  <div class="content-body">
    <div class="container-fluid">
    <div class="mx-auto max-w-4xl mt-10 mb-8 text-center bg-gradient-to-br from-white/70 to-teal-50/60 backdrop-blur-xl border border-teal-200 rounded-3xl p-6 sm:p-7 shadow-xl relative overflow-hidden transition duration-300 hover:shadow-2xl text-sm sm:text-base">
  <div class="absolute top-0 left-0 w-20 h-20 sm:w-24 sm:h-24 bg-teal-100/40 rounded-br-3xl blur-2xl -z-10"></div>
  <div class="absolute bottom-0 right-0 w-28 h-28 sm:w-32 sm:h-32 bg-teal-200/30 rounded-tl-3xl blur-2xl -z-10"></div>

  <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-teal-800 mb-3 sm:mb-4">
    🌟 سامانه استعدادیابی ملل
  </h2>

  <p class="text-sm sm:text-base md:text-lg text-gray-700 leading-relaxed sm:leading-loose font-medium">
    بنیاد ملل ، همراه شما در مسیر کشف و شکوفایی استعدادها. <br />
    با آزمون‌های دقیق، تحلیل‌های هوشمند و راهکارهای فردی‌سازی‌شده، <br />
    آینده‌ای روشن‌تر، فقط یک تصمیم با شما فاصله دارد. <br />
    امروز شروع کن، فردا بدرخش!
  </p>
</div>



<div class="dashboard-cards">
  <div class="card">
    <div class="card-icon">💰</div>
    <div class="card-title">اعتبار کیف پول</div>
    <div class="card-text">100,000 تومان</div>
  </div>

  <div class="card">
    <div class="card-icon">📝</div>
    <div class="card-title">آزمون‌های آماده انجام</div>
    <div class="card-text">{{ count($exams) }} آزمون</div>
  </div>

  <div class="card">
    <div class="card-icon">🛍️</div>
    <div class="card-title">محصولات خریداری شده</div>
    <div class="card-text">5 محصول</div>
  </div>

  <div class="card">
    <div class="card-icon">🎓</div>
    <div class="card-title">بسته‌های آموزشی شما</div>
    <div class="card-text">3 بسته فعال</div>
  </div>
</div>


      <!-- اسکلت بار -->
      <div class="dashboard-cards-section skeletons">
        @for ($i = 0; $i < 4; $i++)
          <div class="skeleton-card">
            <div class="skeleton-img"></div>
            <div class="skeleton-title"></div>
            <div class="skeleton-text"></div>
            <div class="skeleton-shimmer"></div>
          </div>
        @endfor
      </div>

      <!-- کارت‌های واقعی -->
   <!-- کارت‌های واقعی آزمون -->
   <div class="dashboard-cards-section real-cards" style="display: none;">
        @if ($exams->isEmpty())
          <p>هیچ آزمونی برای نمایش وجود ندارد.</p>
        @else
          @foreach ($exams as $exam)
            <a href="{{ route('exams.show', $exam->id) }}" class="card">
              <img 
                src="{{ asset($exam->image ?? 'images/default.jpg') }}" 
                alt="{{ $exam->title }}" 
                class="card-img lazy-img" 
                loading="lazy">
              <div class="card-title">{{ $exam->title }}</div>
              <div class="card-text">{{ Str::limit($exam->description, 120) }}</div>
            </a>
          @endforeach
        @endif
      </div>
      <section class="mt-16 text-center text-sm text-gray-600 px-4">
  🧠 آیا می‌دانستید؟  
  <span class="block mt-2 text-teal-800 font-semibold">یادگیری مستمر، تنها تفاوت پایدار میان افراد موفق و متوسط است.</span>
</section>

<section class="mt-16 max-w-3xl mx-auto bg-white/60 backdrop-blur-md p-6 rounded-2xl shadow-md text-left">
  <h3 class="text-xl font-bold text-teal-800 mb-4">📞 تماس با پشتیبانی یا گفت‌وگو با مشاور</h3>
  <div class="contact-support">
    <div class="contact-item">
      <button class="contact-button text-teal-800 w-full text-left py-3 px-4 border-b-2 border-teal-200 focus:outline-none hover:bg-teal-50 transition-all">
        راه‌های ارتباطی با پشتیبانی
      </button>
      <div class="contact-answer px-4 py-2 text-gray-700 hidden">
        شما می‌توانید از طریق ایمیل یا شماره تماس زیر با تیم پشتیبانی ما در ارتباط باشید:
        <ul class="mt-2 list-disc list-inside">
          <li>ایمیل: hajy3843@gmail.com</li>
          <li>تلفن: 09388780198</li>
        </ul>
      </div>
    </div>

    <div class="contact-item">
      <button class="contact-button text-teal-800 w-full text-left py-3 px-4 border-b-2 border-teal-200 focus:outline-none hover:bg-teal-50 transition-all">
        گفت‌وگو با مشاور
      </button>
      <div class="contact-answer px-4 py-2 text-gray-700 hidden">
        برای مشاوره و راهنمایی، می‌توانید از طریق دکمه زیر به بخش گفت‌وگو آنلاین با مشاور ما دسترسی پیدا کنید.
        <br>
        <a href="https://example.com/chat" class="text-teal-700 font-semibold hover:text-teal-900 mt-3 inline-block">
          گفت‌وگو آنلاین با مشاور
        </a>
      </div>
    </div>
  </div>
</section>
<section class="mt-16 max-w-3xl mx-auto bg-white/60 backdrop-blur-md p-6 rounded-2xl shadow-md text-left">
  <h3 class="text-xl font-bold text-teal-800 mb-4">❓ سوالات متداول</h3>
  <div class="faq">
    <div class="faq-item">
      <button class="faq-question text-teal-800 w-full text-left py-3 px-4 border-b-2 border-teal-200 focus:outline-none hover:bg-teal-50 transition-all">
        چگونه می‌توانم یک آزمون جدید شروع کنم؟
      </button>
      <div class="faq-answer px-4 py-2 text-gray-700 hidden">
        شما می‌توانید از صفحه اصلی به لیست آزمون‌های موجود دسترسی پیدا کرده و با انتخاب یکی از آن‌ها، آزمون را شروع کنید.
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question text-teal-800 w-full text-left py-3 px-4 border-b-2 border-teal-200 focus:outline-none hover:bg-teal-50 transition-all">
        آیا امکان مشاهده نتایج آزمون‌ها وجود دارد؟
      </button>
      <div class="faq-answer px-4 py-2 text-gray-700 hidden">
        بله، شما می‌توانید بعد از انجام هر آزمون، نتایج آن را در قسمت "نتایج آزمون‌ها" مشاهده کنید.
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question text-teal-800 w-full text-left py-3 px-4 border-b-2 border-teal-200 focus:outline-none hover:bg-teal-50 transition-all">
        چگونه می‌توانم بسته‌های آموزشی خود را مدیریت کنم؟
      </button>
      <div class="faq-answer px-4 py-2 text-gray-700 hidden">
        شما می‌توانید بسته‌های آموزشی خود را از بخش "بسته‌های آموزشی" در داشبورد خود مدیریت کنید.
      </div>
    </div>
  </div>
</section>

    </div>
  </div>
 
  <div class="footer">
    A.H.H@81 تمامی حقوق محفوظ است © سامانه استعدادیابی
  </div>

  <script src="js/global.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/deznav-init.js"></script>

  <!-- Lazy Load + Skeleton + Intersection Observer -->
  <script>
     // باز و بسته کردن تماس و سوالات
     document.querySelectorAll('.contact-button').forEach((button) => {
      button.addEventListener('click', () => {
        const answer = button.nextElementSibling;
        answer.classList.toggle('hidden');
      });
    });

    document.querySelectorAll('.faq-question').forEach((question) => {
      question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        answer.classList.toggle('hidden');
      });
    });

    // بارگذاری کارت‌ها بعد از ۲ ثانیه بدون نیاز به اسکرول
    document.addEventListener("DOMContentLoaded", function () {
      const skeletons = document.querySelector('.skeletons');
      const realCards = document.querySelector('.real-cards');
      const cards = realCards.querySelectorAll('.card');

      setTimeout(() => {
        // مخفی‌سازی اسکلت‌ها
        skeletons.style.display = 'none';
        // نمایش کارت‌ها
        realCards.style.display = 'grid';

        cards.forEach((card, index) => {
          setTimeout(() => {
            card.classList.add('visible');
            const img = card.querySelector('.lazy-img');
            if (img && !img.classList.contains('lazy-img-loaded')) {
              img.onload = () => img.classList.add('lazy-img-loaded');
              if (img.complete) img.classList.add('lazy-img-loaded');
            }
          }, index * 100);
        });
      }, 2000); // ۲ ثانیه صبر
    });
</script>

</body>
</html>
