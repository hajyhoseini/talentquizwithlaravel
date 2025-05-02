<div class="header" style="background: linear-gradient(to right, #e0f7fa, #b2ebf2); color: #333;">
  <div class="header-content">
    <nav class="navbar navbar-expand">
      <div class="collapse navbar-collapse justify-content-between">
        <div class="header-left">
          <div class="nav-item">
            <div class="input-group search-area">
              <input type="text" class="form-control" placeholder="اینجا چیزی پیدا کن......" style="color: #333; background-color: #fff;">
              <span class="input-group-text" style="background-color: #fff; border-color: #ddd;">
                <a href="javascript:void(0)">
                  <i class="flaticon-381-search-2" style="color: #4dd0e1;"></i>
                </a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</div>

<div class="deznav z-10" style="background: linear-gradient(to right, #e0f7fa, #b2ebf2); color: #333;">
  <div class="deznav-scroll">
    <div class="dropdown header-profile">
      <a class="nav-link flex items-center p-3" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" style="color: #333;">
        <img src="images/avatar/1.png" width="32" class="rounded-full" alt="">
        <div class="header-info ms-3">
          <span class="font-w600" style="color: #333;">ابوالفضل <b>حاجی حسینی</b></span>
          <small class="text-center font-w400 block" style="color: #777;">hajy3843@gmail.com</small>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-end">
        <a href="./app-profile.html" class="dropdown-item ai-icon" style="color: #333;">
          <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <span class="ms-2">مشخصات</span>
        </a>
        <a href="./email-inbox.html" class="dropdown-item ai-icon" style="color: #333;">
          <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <span class="ms-2">صندوق ورودی</span>
        </a>
        <a href="./login.html" class="dropdown-item ai-icon" style="color: #333;">
          <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
          <span class="ms-2">خروج</span>
        </a>
      </div>
    </div>

    <ul class="metismenu hidden" id="menu">
      <li>
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false" style="color: #333;">
          <i class="flaticon-025-dashboard"></i>
          <span class="nav-text">داشبورد</span>
        </a>
        <ul aria-expanded="false">
          <li><a href="index.html" style="color: #777;">ورود کاربر</a></li>
          <li><a href="index-2.html" style="color: #777;">خروج</a></li>
        </ul>
      </li>

      <li>
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false" style="color: #333;">
          <i class="flaticon-050-info"></i>
          <span class="nav-text">آزمون ها</span>
        </a>
        <ul aria-expanded="false">
          <li><a href="./app-profile.html" style="color: #777;">آزمون‌های انجام شده</a></li>
          <li><a href="./post-details.html" style="color: #777;">آزمون‌های انجام نشده</a></li>
          <li><a href="{{ route('exams.index') }}" style="color: #777;">همه آزمون‌ها</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
