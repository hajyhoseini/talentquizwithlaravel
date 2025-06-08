import $ from 'jquery';
import dt from 'datatables.net-dt';

$(document).ready(function() {
  $('#quizUsersTable').DataTable({
    columnDefs: [
      { orderable: false, targets: 4 }  // ستون "نمایش" غیرقابل مرتب‌سازی
    ],
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fa.json'  // زبان فارسی دیتاتیبل
    }
  });
});
