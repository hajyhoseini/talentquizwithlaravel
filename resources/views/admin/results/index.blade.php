<x-app-layout>
<style>
  .bg-purple-600 {
    --tw-bg-opacity: 1;
    background-color: #969BA0;
  }
  .sort-select {
    font-size: 0.55rem;
    padding: 2px 20px 2px 6px;
    border: 1px solid #aaa;
    border-radius: 3px;
    background-color: white;
    background-image: none;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    position: relative;
    user-select: none;
    width: 45px;
    height: 22px;
  }
  .sort-select:focus {
    outline: none;
    box-shadow: none;
  }
  .sort-select::after {
    content: "▼";
    font-size: 0.5rem;
    color: #555;
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    user-select: none;
    transition: transform 0.3s ease;
    display: inline-block;
    z-index: 1;
  }
  .sort-select.asc::after {
    content: "▲";
  }
  .sort-select option {
    display: none;
  }
</style>

<div id="main-wrapper">
  @include('layouts.components.imageHeader')
  @include('layouts.components.sidebar')

  <div class="content-body">
    <div class="container-fluid bg-gray-200">
      <div class="w-full px-2 pb-10 text-right">
        <h2 class="text-base sm:text-lg md:text-2xl font-extrabold text-gray-600 my-6 sm:my-10 text-center tracking-tight leading-relaxed bg-white rounded-lg py-2">
          👥 کاربران شرکت‌کننده در آزمون‌ها
        </h2>

        {{-- فرم جستجو و انتخاب تعداد ردیف --}}
        <div class="mb-6 w-full flex flex-col sm:flex-row justify-between gap-2">
          <input type="text" id="searchInput" placeholder="نام یا کد ملی یا نام آزمون را وارد کنید..."
            class="w-full sm:w-2/3 py-2 px-2 border border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 text-xs sm:text-sm" />
            <select id="rowsPerPageSelect"
            class="border border-purple-300 rounded-lg py-2   focus:outline-none focus:ring-2 focus:ring-purple-400 text-xs sm:text-sm bg-white appearance-none relative">
            <option value="5">۵ نفر</option>
            <option value="10" selected>۱۰ نفر</option>
            <option value="20">۲۰ نفر</option>
          </select>
        </div>

        {{-- جدول داده‌ها --}}
        <div class="card overflow-x-auto rounded-lg">
          <div class="card-body p-0">
            <div class="w-full min-w-[600px] sm:min-w-full">
              <table id="quizUsersTable" class="w-full table-auto text-xs sm:text-sm text-center border border-gray-200">
                <thead class="bg-gray-100">
                  <tr>
                    <th class="px-1 py-2 text-center text-gray-500" style="width: 120px;">نام</th>
                    <th class="px-1 py-2 text-center text-gray-500" style="width: 120px;">کد ملی</th>
                    <th class="px-1 py-2 text-center text-gray-500" style="width: 150px;">نام آزمون</th>
                    <th class="px-1 py-2 text-center text-gray-500" style="width: 140px;">تاریخ آزمون</th>
                    <th class="px-1 py-2 text-center text-gray-500" style="width: 90px;">نمایش</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    @foreach ($user->answers->unique('quiz_id') as $answer)
                      <tr class="even:bg-gray-200 odd:bg-white hover:bg-gray-200 transition">
                        <td class="px-1 py-2 text-black">{{ $user->name ?: 'کاربر مهمان' }}</td>
                        <td class="px-1 py-2 text-black">{{ $user->national_code }}</td>
                        <td class="px-1 py-2 text-black">{{ $answer->quiz->title ?? 'نامشخص' }}</td>
                        <td class="px-1 py-2 text-black">
                          {{ \Morilog\Jalali\Jalalian::fromDateTime($answer->created_at)->format('Y/m/d H:i') }}
                        </td>
                        <td class="px-1 py-2">
                          <a href="{{ route('quiz.results', ['userId' => $user->id, 'quizId' => $answer->quiz_id]) }}"
                            class="btn btn-sm text-white px-2 py-1 text-xs" style="background-color:#969BA0;">
                            نتیجه
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const table = document.getElementById('quizUsersTable');
  const searchInput = document.getElementById('searchInput');
  const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');

  let allRows = Array.from(table.querySelectorAll('tbody tr'));
  let filteredRows = [...allRows];
  let currentPage = 1;
  let rowsPerPage = parseInt(rowsPerPageSelect.value);

  // وضعیت مرتب‌سازی
  let sortConfig = {
    columnIndex: null,
    direction: 'asc' // یا 'desc'
  };

  // رندر جدول بر اساس صفحه و ردیف‌ها
  function renderTable() {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    currentPage = Math.min(currentPage, totalPages || 1);

    allRows.forEach(row => row.style.display = 'none');

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    filteredRows.slice(start, end).forEach(row => {
      row.style.display = '';
    });

    renderPagination(totalPages);
    renderSortIndicators();
  }

  // رندر صفحه‌بندی
  function renderPagination(totalPages) {
    let paginationContainer = document.getElementById('customPagination');
    if (!paginationContainer) {
      paginationContainer = document.createElement('div');
      paginationContainer.id = 'customPagination';
      paginationContainer.className = 'flex justify-center mt-4 gap-2';
      table.parentElement.appendChild(paginationContainer);
    }

    paginationContainer.innerHTML = '';
    for (let i = 1; i <= totalPages; i++) {
      const btn = document.createElement('button');
      btn.innerText = i;
      btn.className = `px-3 py-1 border rounded ${i === currentPage ? 'bg-purple-600 text-white' : 'bg-white text-purple-700'}`;
      btn.addEventListener('click', () => {
        currentPage = i;
        renderTable();
      });
      paginationContainer.appendChild(btn);
    }
  }

  // مرتب‌سازی داده‌ها
  function compareRows(a, b, columnIndex, direction) {
    const getCellValue = row => row.children[columnIndex].innerText.trim();

    let valA = getCellValue(a);
    let valB = getCellValue(b);

    // فارسی‌سازی مقایسه با localeCompare
    if (direction === 'asc') {
      return valA.localeCompare(valB, 'fa');
    } else {
      return valB.localeCompare(valA, 'fa');
    }
  }

  function sortRows(columnIndex, direction) {
    filteredRows.sort((a, b) => compareRows(a, b, columnIndex, direction));
    const tbody = table.querySelector('tbody');
    tbody.innerHTML = '';
    filteredRows.forEach(row => tbody.appendChild(row));
  }

  // نمایش فلش مرتب‌سازی در هدر
  function renderSortIndicators() {
    const headers = table.querySelectorAll('thead th');
    headers.forEach((th, idx) => {
      // حذف فلش قبلی
      let arrow = th.querySelector('.sort-arrow');
      if (arrow) arrow.remove();

      if (idx === sortConfig.columnIndex) {
        arrow = document.createElement('span');
        arrow.className = 'sort-arrow mr-1';
        arrow.style.fontSize = '0.75rem';
        arrow.style.userSelect = 'none';
        arrow.textContent = sortConfig.direction === 'asc' ? '▲' : '▼';
        th.prepend(arrow);
      }
    });
  }

  // فیلتر جستجو
  searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.toLowerCase();
    filteredRows = allRows.filter(row =>
      row.innerText.toLowerCase().includes(searchTerm)
    );

    // اگر مرتب‌سازی فعال است، دوباره مرتب کن
    if (sortConfig.columnIndex !== null) {
      sortRows(sortConfig.columnIndex, sortConfig.direction);
    }

    currentPage = 1;
    renderTable();
  });

  // تغییر تعداد ردیف در صفحه
  rowsPerPageSelect.addEventListener('change', () => {
    rowsPerPage = parseInt(rowsPerPageSelect.value);
    currentPage = 1;
    renderTable();
  });

  // فعال کردن کلیک روی هدرهای "نام" (ستون 0) و "نام آزمون" (ستون 2)
  const sortableColumns = [0, 2];
  sortableColumns.forEach(colIndex => {
    const th = table.querySelectorAll('thead th')[colIndex];
    th.style.cursor = 'pointer';

    th.addEventListener('click', () => {
      if (sortConfig.columnIndex === colIndex) {
        // اگر روی همان ستون کلیک شد، جهت را برعکس کن
        sortConfig.direction = sortConfig.direction === 'asc' ? 'desc' : 'asc';
      } else {
        sortConfig.columnIndex = colIndex;
        sortConfig.direction = 'asc';
      }
      sortRows(sortConfig.columnIndex, sortConfig.direction);
      currentPage = 1;
      renderTable();
    });
  });

  // شروع رندر اولیه
  renderTable();
});</script>
</x-app-layout>
