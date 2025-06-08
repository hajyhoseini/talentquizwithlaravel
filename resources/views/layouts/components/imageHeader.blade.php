<div class="nav-header">
  <div class="nav-control">
    <div class="hamburger l-10">
      <span class="line"></span><span class="line"></span><span class="line"></span>
    </div>
  </div>

  <!-- لوگوی کامل (فقط در دسکتاپ و باز بودن سایدبار) -->
  <img src="/images/3.png" alt="لوگو کامل" class="logo-img full-logo ml-3 mt-2">

  <!-- لوگوی کوچک ملل (دایره‌ای) در موبایل و حالت بسته -->
  <img src="/images/melalLogo.jpg" alt="لوگو کوچک" class="logo-img collapsed-logo">
</div>
<div class="header bg-white">
  <div class="header-content ">
    <nav class="flex gap-4 p-4">
      <a href="/" class="w-11 h-11 bg-white text-gray-800 rounded-full flex items-center justify-center " title="صفحه اصلی">
        <i class="fas fa-home text-xl"></i>
      </a>
      <a href="exams.html" class="w-11 h-11 bg-white text-gray-800 rounded-full flex items-center justify-center " title="آزمون‌ها">
        <i class="fas fa-pen text-xl"></i>
      </a>
      <a href="/completed-tests" class="w-11 h-11 bg-white text-gray-800 rounded-full flex items-center justify-center " title="کارنامه">
        <i class="fas fa-chart-line text-xl"></i>
      </a>
    </nav>
  </div>
</div>


<style>
  .l-10{
    left:-10px;
  }
  .logo-img {
    max-height: 60px;
    object-fit: contain;
    transition: all 0.3s ease;
    margin: 10px auto;
    display: block;
  }

  .full-logo {
    display: block;
  }

  .collapsed-logo {
  display: none;
  width: 50px;
  height: 50px; object-fit: cover;
  margin-right: 18px;
}

  /* اگر کلاس collapsed باشه */
  .nav-header.collapsed .full-logo {
    display: none !important;
  }

  .nav-header.collapsed .collapsed-logo {
    display: block !important;
  }

  /* حالت موبایل */
  @media (max-width: 800px) {
    .full-logo {
      display: none !important;
    }

    .collapsed-logo {
      display: block !important;
    }
  }

    .header-content {
    display: flex;
    justify-content: flex-end; /* چپ‌چین کردن آیتم‌ها */
    align-items: center;
    padding: 20px;
  }

  .nav-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: nowrap;
    justify-content: center;
    max-width: 700px;
    margin: 0 auto;
    overflow-x: auto;
    padding: 0 10px;
  }

  .nav-button {
    flex: 0 0 180px;
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
    white-space: nowrap;
  }

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

  @media (max-width: 800px) {
    .nav-buttons {
      gap: 2px;
      margin-right: 15px;
    }

    .nav-button {
      flex: 0 0 90px;
      padding: 8px 10px;
      font-size: 12px;
    }
  }

</style>

<script>
  // فعال‌سازی دکمه‌های منو
  const path = window.location.pathname;
  document.querySelectorAll('.nav-button').forEach(button => {
    const href = button.getAttribute('href');
    if (href === '/' && path === '/') {
      button.classList.add('active');
    } else if (href !== '/' && path.includes(href)) {
      button.classList.add('active');
    }
  });

  // تغییر حالت سایدبار
  document.querySelector('.hamburger').addEventListener('click', () => {
    document.querySelector('.nav-header').classList.toggle('collapsed');
  });
</script>
