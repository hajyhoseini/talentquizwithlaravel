<div class="nav-header">
  <div class="nav-control">
    <div class="hamburger">
      <span class="line"></span><span class="line"></span><span class="line"></span>
    </div>
  </div>
  <img src="/images/3.png" alt="لوگو" class="w-full h-2/3 lg:h-fit">
</div>

<div class="header">
  <div class="header-content">
    <nav class="nav-buttons">
      <a href="/" class="nav-button home">صفحه اصلی</a>
      <a href="exams.html" class="nav-button exams">صفحه آزمون‌ها</a>
      <a href="/completed-tests" class="nav-button report">کارنامه</a>
    </nav>
  </div>
</div>

<style>
  .header-content {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #eef4f8;
  }

  .nav-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: nowrap;           /* یک ردیف باشن همیشه */
    justify-content: center;
    max-width: 700px;            /* کمی بزرگتر برای لپ‌تاپ */
    margin: 0 auto;
    overflow-x: auto;            /* اسکرول افقی اگر فضا کم بود */
    padding: 0 10px;
  }

  .nav-button {
    flex: 0 0 180px;             /* عرض ثابت برای همه دکمه‌ها */
    padding: 12px 20px;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease;
    color: #2c3e50;
    background-color: white;
    border: 1px solid #ccc;
    text-align: center;
    box-sizing: border-box;
    white-space: nowrap;         /* جلوگیری از شکستن متن */
  }

  /* حالت هاور و فعال */
  .nav-button.home:hover,
  .nav-button.home.active {
    background-color: #1abc9c;
    color: white;
  }

  .nav-button.exams:hover,
  .nav-button.exams.active {
    background-color: #2980b9;
    color: white;
  }

  .nav-button.report:hover,
  .nav-button.report.active {
    background-color: #d35400;
    color: white;
  }

  /* حالت ریسپانسیو برای گوشی: دکمه‌ها کنار هم، کوچکتر و فونت کوچکتر */
  @media (max-width: 800px) {
    .nav-buttons {
      gap: 2px;
      margin-right:15px;
    }

    .nav-button {
      flex: 0 0 90px;            /* عرض کوچکتر */
      padding: 8px 10px;
      font-size: 12px;           /* فونت کوچکتر */
    }
  }
</style>

<script>
  // فعال کردن دکمه بر اساس URL
  const path = window.location.pathname;

  const buttons = document.querySelectorAll('.nav-button');

  buttons.forEach(button => {
    const href = button.getAttribute('href');
    if (href === '/' && path === '/') {
      button.classList.add('active');
    } else if (href !== '/' && path.includes(href)) {
      button.classList.add('active');
    }
  });
</script>
