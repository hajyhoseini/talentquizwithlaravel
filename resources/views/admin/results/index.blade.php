<x-app-layout>
  <div class="container mx-auto px-5 py-8">
    <h2 class="text-xl font-extrabold text-teal-800 mb-6 text-center">لیست کاربران آزمون‌داده</h2>

    <div class="overflow-x-auto rounded-2xl bg-white/60 backdrop-blur-md border border-teal-200 shadow-lg">
      <table class="min-w-full rtl table-auto border-collapse border border-teal-300 text-sm">
        <thead class="bg-teal-100/50">
          <tr>
            <th class="px-3 py-2 text-teal-700 font-semibold border-b border-teal-300 text-left">نام</th>
            <th class="px-3 py-2 text-teal-700 font-semibold border-b border-teal-300 text-right">کد ملی</th>
            <th class="px-3 py-2 text-teal-700 font-semibold border-b border-teal-300 text-right">تاریخ آزمون</th>
            <th class="px-3 py-2 text-teal-700 font-semibold border-b border-teal-300 text-right">نمایش</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            @foreach ($user->answers->unique('quiz_id') as $answer)
              <tr class="border-b border-teal-200 hover:bg-teal-50 transition-colors duration-300">
                <td class="px-3 py-2 text-gray-800 font-medium text-left">{{ $user->name }}</td>
                <td class="px-3 py-2 text-gray-700 text-right">{{ $user->national_code }}</td>
       <td class="px-3 py-2 text-gray-700 text-right">
  {{ \Morilog\Jalali\Jalalian::fromDateTime($answer->created_at)->format('Y/m/d H:i') }}
</td>


                <td class="px-3 py-2 text-right">
                  <a href="{{ route('admin.results.show', [$user->id, $answer->quiz_id]) }}"
                     class="inline-block px-3 py-1.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-xs">
                    نمایش نتیجه
                  </a>
                </td>
              </tr>
            @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
