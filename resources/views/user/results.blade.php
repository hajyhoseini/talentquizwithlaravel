<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl sm:text-2xl md:text-3xl text-center font-bold py-6 text-teal-900">
            📜 نتایج آزمون
        </h2>
    </x-slot>
<style>
       body {
      margin: 0;
      font-family: 'Vazirmatn', sans-serif;
      background: linear-gradient(135deg, #e0f8f7, #f5ffff);
      min-height: 100vh;
      color: #333;
    }
</style>
    <div class="flex">
       
           
            
  
                  <div class="flex-1  pt-10 px-6 w-full">
            <div class="text-center bg-gradient-to-br from-white/70 to-teal-50/60 backdrop-blur-xl border border-teal-300 rounded-3xl p-6 sm:p-7 shadow-xl relative overflow-hidden transition duration-300 hover:shadow-2xl text-sm sm:text-base">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-teal-800 mb-4 sm:mb-6">
                    📜 نتایج شما
                </h2>

                @foreach ($results as $section => $data)
                    <div class="mt-6">
                        <h3 class="font-bold text-lg text-teal-700">{{ $section }}</h3>
                        <p class="text-gray-600">امتیاز: {{ $data['score'] }}</p>
                        
                        <!-- نمایش سطح به فارسی -->
                        <p class="text-gray-600">سطح: 
                            @if ($data['level'] == 'high')
                                عالی
                            @elseif ($data['level'] == 'medium')
                                متوسط
                            @else
                                پایین
                            @endif
                        </p>
                        
                        <p class="text-gray-600">تفسیر: {{ $data['interpretation'] }}</p>

                        @if (!empty($data['suggestions']))
                            <h4 class="font-semibold mt-2">پیشنهادات:</h4>
                            <ul class="list-disc pl-6 text-gray-600">
                                @foreach ($data['suggestions'] as $suggestion)
                                    <li>{{ $suggestion }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
             <div class="w-full flex justify-center">
    <button id="downloadPdfBtn" class="mt-2 mb-4 px-4 py-3 bg-[#1dd1a1] text-white text-xs sm:text-sm rounded-lg hover:bg-[#54a0ff] focus:outline-none transition">
        دانلود PDF
    </button>
</div>
            </div>
           
        </div>

  
       

<script>
  document.getElementById('downloadPdfBtn').addEventListener('click', () => {
    window.print();
  });
</script>
</x-app-layout>
