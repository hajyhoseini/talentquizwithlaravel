<!-- resources/views/components/questions.blade.php -->
@foreach ($questions->groupBy('section') as $section => $sectionQuestions)
    <div class="section-slide {{ $loop->first ? 'active' : 'hidden' }}" data-section="{{ $loop->index }}">
        <div class="question-container">
            @foreach ($sectionQuestions as $index => $question)
                <div class="question-slide {{ $loop->first ? 'active' : 'hidden' }}" data-question="{{ $index }}">
                    <p class="text-base sm:text-lg mb-4 text-gray-800 bg-yellow-100 rounded-lg p-4 shadow-md">
                        ❓ {{ $question->question }}
                    </p>

                    <div class="flex flex-wrap justify-center gap-4 bg-gradient-to-r from-yellow-50 to-pink-50 p-4 rounded-lg">
                        @foreach ([4 => 'خیلی زیاد', 3 => 'خوب', 2 => 'گاهی', 1 => 'به ندرت'] as $value => $label)
                            <label class="flex items-center cursor-pointer space-x-2 bg-white rounded-full px-4 py-2 shadow-sm hover:shadow-md transition transform hover:scale-105">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $value }}" class="form-radio text-pink-500 answer-option" onclick="nextStep(); updateProgress();">
                                <span class="text-sm text-purple-600">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
