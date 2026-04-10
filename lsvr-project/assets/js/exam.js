/* =========================
   EXAM TIMER + HANDLING
========================= */

// Set exam time (in seconds) → 10 min = 600 sec
let totalTime = 600;
let timerDisplay = document.getElementById("timer");
let examForm = document.getElementById("examForm");

// Start timer
function startTimer() {
  let time = totalTime;

  let interval = setInterval(() => {
    let minutes = Math.floor(time / 60);
    let seconds = time % 60;

    seconds = seconds < 10 ? "0" + seconds : seconds;

    if (timerDisplay) {
      timerDisplay.innerHTML = `Time Left: ${minutes}:${seconds}`;
    }

    time--;

    // Time up → auto submit
    if (time < 0) {
      clearInterval(interval);
      alert("Time is up! Submitting exam...");
      if (examForm) examForm.submit();
    }
  }, 1000);
}

/* =========================
   CHECK ANSWERS BEFORE SUBMIT
========================= */
function validateExam() {
  let totalQuestions = document.querySelectorAll(".question").length;
  let answered = document.querySelectorAll("input[type=radio]:checked").length;

  if (answered < totalQuestions) {
    let confirmSubmit = confirm(
      `You answered ${answered}/${totalQuestions} questions.\nDo you still want to submit?`,
    );
    return confirmSubmit;
  }

  return true;
}

/* =========================
   PREVENT PAGE REFRESH
========================= */
window.addEventListener("beforeunload", function (e) {
  e.preventDefault();
  e.returnValue = "Are you sure you want to leave? Your exam will be lost!";
});

/* =========================
   INIT
========================= */
window.onload = function () {
  startTimer();

  // Attach validation to form
  if (examForm) {
    examForm.onsubmit = function () {
      return validateExam();
    };
  }
};
