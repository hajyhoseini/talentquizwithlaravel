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

  .card {
    background: rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(0, 150, 150, 0.1);
    border-radius: 22px;
    padding: 24px 20px;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: 0 8px 28px rgba(0, 128, 128, 0.07);
    transition: all 0.3s ease-in-out;
    text-align: center;
    overflow: hidden;
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
  }

  .card-title {
    font-size: 20px;
    font-weight: 700;
    color: #007c86;
    margin: 0 auto;
    padding: 8px 14px;
    border: 1px solid rgba(0, 128, 128, 0.15);
    border-radius: 12px;
    background-color: rgba(255, 255, 255, 0.4);
    display: inline-block;
    transition: 0.3s;
  }

  .card-title:hover {
    background-color: rgba(0, 128, 128, 0.05);
    border-color: rgba(0, 128, 128, 0.25);
  }

  .card-text {
    font-size: 15px;
    color: #444;
    margin-top: 14px;
    line-height: 1.9;
    padding: 10px 14px;
    border: 1px dashed rgba(0, 128, 128, 0.15);
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.35);
    transition: 0.3s;
  }

  .card-text:hover {
    background-color: rgba(0, 128, 128, 0.03);
    border-color: rgba(0, 128, 128, 0.25);
  }

  .footer {
    text-align: center;
    padding: 30px 0;
    font-size: 14px;
    color: #777;
  }

  @media (max-width: 768px) {
    .dashboard-cards,
    .dashboard-cards-section {
      grid-template-columns: 1fr;
    }
  }
</style>


</head>

<body>

  <!-- Header -->
  <div class="header">
    <nav class="navbar"></nav>
  </div>

  <!-- Includes -->
  <div id="main-wrapper">
    @include('layouts.components.imageHeader')
    @include('layouts.components.sidebar')
  </div>

  <!-- Content Body -->
  <div class="content-body">
    <div class="container-fluid">

      <!-- کارت‌های اصلی -->
      <div class="dashboard-cards">
        <div class="card">
          <div class="card-title">اعتبار کیف پول</div>
          <div class="card-text">100,000 تومان</div>
        </div>
        <div class="card">
          <div class="card-title">آزمون‌های آماده انجام</div>
          <div class="card-text">2 آزمون</div>
        </div>
        <div class="card">
          <div class="card-title">محصولات خریداری شده</div>
          <div class="card-text">5 محصول</div>
        </div>
        <div class="card">
          <div class="card-title">بسته‌های آموزشی شما</div>
          <div class="card-text">3 بسته فعال</div>
        </div>
      </div>

      <!-- کارت‌های آزمون -->
      <div class="dashboard-cards-section">
      <a href="your-link-here.html" class="card" style="text-decoration: none;">
  <img src="images/image32.jpg" alt="آزمون 1" class="card-img">
  <div class="card-title">آزمون استعدادیابی کودکان</div>
  <div class="card-text">
    این آزمون برای شناسایی علایق، توانایی‌ها و استعدادهای طبیعی کودکان طراحی شده است.
  </div>
</a>


        <div class="card">
          <img src="images/image (1).jpg" alt="آزمون MBTI" class="card-img">
          <div class="card-title">آزمون MBTI</div>
          <div class="card-text">با این آزمون شخصیت‌شناسی، نوع شخصیت خود را بر اساس مدل معروف مایرز–بریگز بشناسید.</div>
        </div>

        <div class="card">
          <img src="images/image (3).jpg" alt="آزمون هوش گاردنر" class="card-img">
          <div class="card-title">آزمون هوش چندگانه گاردنر</div>
          <div class="card-text">این آزمون به شما کمک می‌کند تا انواع مختلف هوش خود مانند موسیقایی، بدنی، منطقی و... را کشف کنید.</div>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    تمامی حقوق محفوظ است © سامانه استعدادیابی
  </div>

  <!-- Scripts -->
  <script src="js/global.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/deznav-init.js"></script>

</body>
</html>
