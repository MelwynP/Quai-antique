const lunchButton = document.getElementById("btn-lunch");
const dinnerButton = document.getElementById("btn-dinner");
const hourReservationField = document.getElementById("hourReservationField");

lunchButton.addEventListener("click", () => {
  hourReservationField.innerHTML = "";
  const lunchHours = lunchButton.getAttribute("data-hours").split(",");
  lunchHours.forEach((hour) => {
    const option = document.createElement("div");
    option.textContent = hour;
    hourReservationField.appendChild(option);
  });
});

dinnerButton.addEventListener("click", () => {
  hourReservationField.innerHTML = "";
  const dinnerHours = dinnerButton.getAttribute("data-hours").split(",");
  dinnerHours.forEach((hour) => {
    const option = document.createElement("div");
    option.textContent = hour;
    hourReservationField.appendChild(option);
  });
});
