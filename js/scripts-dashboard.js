const monthYearElement = document.getElementById("month-year");
const daysElement = document.querySelector(".days");
const prevMonthButton = document.getElementById("prev-month");
const nextMonthButton = document.getElementById("next-month");
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

// Function to generate calendar
function generateCalendar(month, year) {
  const monthName = new Date(year, month).toLocaleString("default", { month: "long" });

  monthYearElement.textContent = `${monthName} ${year}`;

  const today = new Date();
  const firstDayOfMonth = new Date(year, month, 1);
  const lastDayOfMonth = new Date(year, month + 1, 0);
  const firstDayOfWeek = firstDayOfMonth.getDay();

  daysElement.innerHTML = "";

  // Add empty cells for days before the first day of the month
  for (let i = 0; i < firstDayOfWeek; i++) {
    const emptyCell = document.createElement("div");
    daysElement.appendChild(emptyCell);
  }

  // Add cells for each day of the month
  for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
    const dayCell = document.createElement("div");
    dayCell.textContent = i;
    if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
      dayCell.classList.add("current-date");
    }
    daysElement.appendChild(dayCell);
  }
}

// Event listeners for navigation buttons
prevMonthButton.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  generateCalendar(currentMonth, currentYear);
});

nextMonthButton.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  generateCalendar(currentMonth, currentYear);
});

// Initial generation of calendar
generateCalendar(currentMonth, currentYear);



