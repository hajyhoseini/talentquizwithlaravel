<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base sm:text-lg md:text-xl text-center font-bold py-2 text-teal-900">
            📜 نتایج آزمون
        </h2>
    </x-slot>

@php
    $sectionCounter = 1;
    function convertToPersianNumber($number) {
        $farsiDigits = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return str_replace(range(0, 9), $farsiDigits, $number);
    }
@endphp

<style>
    @media print {
        .page-break {
            page-break-before: always;
            break-before: page;
        }
    }
    .page-break:first-child {
        page-break-before: auto;
        break-before: auto;
    }

    ol li {
        list-style-type: decimal !important;
    }

    body {
        margin: 0;
        font-family: 'Vazirmatn', sans-serif;
        min-height: 100vh;
        color: #333;
    }
    .no-padding {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .full-width-card {
        width: 100% !important;
        max-width: none !important;
        border-radius: 0 !important;
        padding: 0.75rem !important;
        box-sizing: border-box;
    }
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body {
            background: white !important;
            color: black !important;
        }
    }

    /* استایل درباره ما */
    .about-section {
        background: #969BA0;
        border-radius: 0.5rem;
        padding: 2rem 2.5rem;
        margin: 2rem auto;
        max-width: 900px;
        color: #1e293b;
        line-height: 1.6;
        font-size: 1rem;
        box-sizing: border-box;
    }
    .about-section > div.inner-white-box {
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem 2rem;
        box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }
    .about-section h2 {
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 1rem;
        color: black;
        text-align: center;
    }
    .about-section p {
        margin-bottom: 1rem;
        font-weight: 500;
        direction: rtl;
        color: #334155;
    }
</style>

<div class="flex">
    <div class="flex-1 pt-6 no-padding">

        <div class="text-center bg-[#969BA0] border border-teal-300 full-width-card shadow-lg relative overflow-hidden transition duration-300 hover:shadow-2xl text-xs sm:text-sm">

            @foreach ($results as $section => $data)
                {{-- صفحه جدید برای شروع هر استعداد جدید --}}
                <div class="page-break"></div>

                {{-- بخش خلاصه عملکرد استعداد --}}
                <div class="mt-4 bg-white/70 rounded-lg py-2 px-3">
                    <div class="bg-white w-7/8 mx-auto p-1/2 rounded-lg ">
                        <h2 class="text-lg font-bold bg-gray-400 my-1 text-white mb-4 rounded-lg mx-auto py-2 w-5/6">
                            📜 خلاصه‌ای از عملکرد شما در آزمون
                        </h2>
                    </div>

                    <div class="bg-white py-2 rounded-lg w-full lg:w-1/3 mx-auto">
                        <h3 class="font-bold mt-2 text-base p-3 mb-3 bg-gray-300 rounded-lg w-4/5 mx-auto text-center leading-relaxed">
                            <span class="text-white bg-gray-500 p-2 rounded-lg">بخش {{ convertToPersianNumber($sectionCounter) }}</span>
                            <span class="text-black font-bold">- {{ $section }}</span>
                        </h3>
                    </div>

                    @if (!empty($data['description']))
                        <p class="font-bold text-base bg-white rounded-lg p-3 w-full lg:w-2/3 mx-auto mt-3 leading-relaxed text-left">
                            <span class="text-white mb-1 text-lg bg-[#969BA0] p-1 rounded-lg font-semibold">توضیح استعداد:</span>
                            <span class="text-black px-1 font-bold text-center">{{ $data['description'] }}</span>
                        </p>
                    @endif

                    <div class="flex w-2/3 lg:w-1/5 mx-auto bg-white p-1 rounded-lg justify-center gap-4 ">
                        <p class="text-gray-700 font-bold bg-gray-300 rounded-lg p-3 text-sm leading-relaxed mt-2">
                            <span class="text-white bg-gray-500 p-1 rounded-lg font-semibold">امتیاز:</span>
                            <span class="text-black font-bold">{{ $data['score'] }}</span>
                        </p>

                        <p class="text-gray-700 font-bold bg-gray-300 rounded-lg p-3 text-sm leading-relaxed mt-2">
                            <span class="text-white bg-gray-500 p-1 rounded-lg font-semibold">سطح:</span>
                            <span class="text-black font-bold">
                                @if ($data['level'] == 'high')
                                    عالی
                                @elseif ($data['level'] == 'medium')
                                    متوسط
                                @else
                                    پایین
                                @endif
                            </span>
                        </p>
                    </div>

                    <p class="font-bold text-base bg-white rounded-lg p-3 w-full lg:w-2/3 mx-auto mt-3 leading-relaxed text-left">
                        <span class="text-white mb-1 text-lg bg-[#969BA0] px-2 py-1 rounded-lg font-semibold ">تفسیر:</span>
                        <span class="text-black font-bold">{{ $data['interpretation'] }}</span>
                    </p>
                </div>

                {{-- صفحه جدید برای پیشنهادات --}}
                @if (!empty($data['suggestions']))
                    <div class="page-break"></div>
                    <h4 class="mt-1 text-base font-semibold bg-gray-400 rounded-lg p-2 w-full text-white mx-auto">پیشنهادات</h4>
                    <div class="bg-gray-400 py-1 rounded-xl">
    <p class="text-center mt-3 bg-white text-sm text-black mb-4 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
        در این بخش، نکات و راهکارهایی ارائه شده که می‌تواند به بهبود و تقویت استعدادهای شما کمک کند. با توجه به ویژگی‌های خاص هر بخش، این پیشنهادات به‌صورت هدفمند طراحی شده‌اند تا مسیر رشد و پیشرفت را برایتان هموارتر کنند. امیدواریم با رعایت این نکات، بتوانید بهتر از توانایی‌های خود بهره‌مند شوید و به اهداف‌تان نزدیک‌تر شوید. همراهی و تلاش مستمر شما در این مسیر بسیار ارزشمند است.
    </p>
</div>

                    <ol class="text-left text-black font-bold text-base bg-gray-400 rounded-lg px-4 py-3 w-full lg:w-2/3 mx-auto leading-relaxed space-y-2" style="list-style-position: inside; direction: rtl;">
                        @foreach ($data['suggestions'] as $suggestion)
                            <li class="bg-white p-1 list-decimal rounded-md">{{ $suggestion }}</li>
                        @endforeach
                    </ol>
                @endif

                {{-- صفحه جدید جدا برای شغل‌های پیشنهادی --}}
                @if (isset($featuredCareers[$section]) && $featuredCareers[$section]->count())
                    <div class="page-break"></div>
                    <h4 class="mt-1 text-base font-semibold bg-gray-400 rounded-lg p-2 w-full text-white mx-auto">
                        💼 شغل‌های پیشنهادی بر اساس استعداد شما
                    </h4>
                    <div class="bg-gray-400 py-1 rounded-xl">
                        <p class="text-center mt-3 bg-white text-sm text-black mb-4 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
                            این شغل‌ها بر اساس استعداد برجسته شما در این بخش انتخاب شده‌اند و می‌توانند مسیر مناسبی برای آینده‌ی شغلی شما باشند.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 py-3 rounded-md bg-gray-400 mt-4 md:grid-cols-2 lg:grid-cols-4 gap-4 px-2 max-w-6xl mx-auto mb-6">
                     @foreach ($featuredCareers[$section] ?? [] as $chunk)
    @foreach ($chunk as $career)
                            <div class="bg-gray-200 rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
                                <div class="w-full h-28 overflow-hidden rounded mb-1 flex items-center justify-center bg-gray-100">
                                    <img src="{{ $career->career_image_url }}" alt="{{ $career->career_title }}" class="max-w-full max-h-full object-contain">
                                </div>
                                <p class="font-bold py-2 rounded-md bg-gray-500 text-xs text-white mb-1">{{ $career->career_title }}</p>
<p class="font-bold text-xs mt-1 py-1 rounded-md bg-white text-gray-600 leading-relaxed line-clamp-3">
    {{ $career->career_description }}
</p>
                            </div>
                                @endforeach
                        @endforeach
                    </div>
                @endif

                {{-- صفحه جدید جدا برای کتاب‌های پیشنهادی والدین --}}
                @if (isset($featuredBooks[$section]) && $featuredBooks[$section]->count())
                    <div class="page-break"></div>
                    <h4 class="mt-1 text-base font-semibold bg-gray-400 rounded-lg p-2 w-full text-white mx-auto">
                        📚 کتاب‌های پیشنهادی والدین
                    </h4>
                    <div class="bg-gray-400 py-1 rounded-xl">
                        <p class="text-center mt-1 bg-white text-sm text-black mb-4 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
                            والدین گرامی، مطالعه این کتاب‌ها می‌تواند در درک بهتر استعدادها و حمایت از فرزندان در مسیر رشد و شکوفایی استعدادهایشان بسیار مفید باشد.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 py-3 rounded-md bg-gray-400 mt-4 md:grid-cols-2 lg:grid-cols-4 gap-4 px-2 max-w-6xl mx-auto mb-6">
                        @foreach ($featuredBooks[$section] ?? [] as $chunk)
                            @foreach ($chunk as $book)
                                <div class="bg-gray-200 rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
                                    <div class="w-full h-28 overflow-hidden rounded mb-1 flex items-center justify-center bg-gray-100">
                                        <img src="{{ $book->image_url }}" alt="{{ $book->name }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <p class="font-bold py-2 mt-2 rounded-md bg-gray-500 text-xs text-white mb-1">{{ $book->name }}</p>
                                    <p class="font-bold text-xs mt-1 py-2 rounded-md bg-white text-gray-600 leading-relaxed">{{ $book->general_talent }}</p>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @endif

                {{-- صفحه جدید برای چهره‌های برجسته --}}
                @if (isset($featuredPeople[$section]) && $featuredPeople[$section]->count())
                    <div class="page-break"></div>
                    <h4 class="mt-1 text-base font-semibold bg-gray-400 rounded-lg p-2 w-full text-white mx-auto">
                        🌟 چهره‌های برجسته در این حوزه استعدادی
                    </h4>
                    <div class="bg-gray-400 py-1 rounded-xl">
                        <p class="text-center mt-3 bg-white text-sm text-black mb-4 w-5/6 mx-auto px-4 rounded-md p-2 font-semibold">
با تعدادی از افراد شاخص و الهام‌بخش در این حوزه آشنا می‌شوید؛ مسیر موفقیت آن‌ها می‌تواند انگیزه‌ای برای شکوفایی استعدادهای شما باشد.                        </p>
                    </div>
                    <div class="grid grid-cols-2 py-2 rounded-md bg-gray-400 mt-4 md:grid-cols-2 lg:grid-cols-4 gap-4 px-2 max-w-6xl mx-auto mb-6">
                        @foreach ($featuredPeople[$section] as $chunk)
                            @foreach ($chunk as $person)
                                <div class="bg-gray-200 rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
                                    <div class="w-full h-28 overflow-hidden rounded mb-1 flex items-center justify-center bg-gray-100">
                                        <img src="{{ $person->image_url }}" alt="{{ $person->name }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <p class="font-bold py-2 mt-1 rounded-md bg-gray-500 text-xs text-white mb-1">{{ $person->name }}</p>
                                    <p class="font-bold text-xs mt-1 py-2 rounded-md bg-white text-gray-600 leading-relaxed">{{ $person->general_talent }}</p>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @endif

                @php $sectionCounter++; @endphp
            @endforeach
        </div>

        <div class="w-full flex justify-center">
            <button id="downloadPdfBtn" class="mt-2 mb-3 px-3 py-2 bg-gray-500 text-white text-xs rounded-md hover:bg-gray-400 focus:outline-none transition">
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
