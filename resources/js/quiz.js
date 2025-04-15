let currentSection = 0;
let currentQuestion = 0;
const sections = document.querySelectorAll(".section-slide");
const submitBtn = document.getElementById("submit-btn");
const prevBtn = document.getElementById("prev-btn");

function startQuiz() {
    // مخفی کردن صفحه خوش‌آمدگویی
    document.getElementById("intro-screen").classList.add("hidden");

    // نمایش فرم آزمون
    document.getElementById("quiz-form").classList.remove("hidden");
    updateButtons();
}


function updateButtons() {
    prevBtn.classList.toggle("hidden", currentQuestion === 0 && currentSection === 0);
    submitBtn.classList.toggle("hidden", currentSection < sections.length - 1 || currentQuestion < document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`).length - 1);
}

function nextStep() {
    let questionsInCurrentSection = document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`);
    questionsInCurrentSection[currentQuestion].classList.add("hidden");
    currentQuestion++;
    if (currentQuestion < questionsInCurrentSection.length) {
        questionsInCurrentSection[currentQuestion].classList.remove("hidden");
    } else {
        nextSection();
    }
    updateButtons();
}

function prevStep() {
    let questionsInCurrentSection = document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`);
    if (currentQuestion > 0) {
        questionsInCurrentSection[currentQuestion].classList.add("hidden");
        currentQuestion--;
        questionsInCurrentSection[currentQuestion].classList.remove("hidden");
    } else if (currentSection > 0) {
        prevSection();
    }
    updateButtons();
}

function nextSection() {
    sections[currentSection].classList.add("hidden");
    currentSection++;
    if (currentSection < sections.length) {
        sections[currentSection].classList.remove("hidden");
        currentQuestion = 0;
    } else {
        submitBtn.classList.remove("hidden");
    }
}

function prevSection() {
    sections[currentSection].classList.add("hidden");
    currentSection--;
    sections[currentSection].classList.remove("hidden");

    let questionsInCurrentSection = document.querySelectorAll(`.section-slide[data-section="${currentSection}"] .question-slide`);
    currentQuestion = questionsInCurrentSection.length - 1;
}

function updateProgress() {
    const totalQuestions = document.querySelectorAll(".question-slide").length;
    const answered = document.querySelectorAll(".answer-option:checked").length;
    const percent = Math.round((answered / totalQuestions) * 100);
    const circle = document.getElementById("progress-ring");
    const percentText = document.getElementById("progress-percent");

    const radius = 45;
    const circumference = 2 * Math.PI * radius;
    const offset = circumference - (percent / 100) * circumference;

    circle.style.strokeDashoffset = offset;
    percentText.textContent = `${percent}%`;
}

document.addEventListener('DOMContentLoaded', function () {
    updateButtons();
});
