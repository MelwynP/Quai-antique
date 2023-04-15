/* code ok
const lunchButton = document.getElementById("btn-lunch");
const dinnerButton = document.getElementById("btn-dinner");
const hourReservationField = document.getElementById("hourReservationField");
const hourReservationSelect = document.getElementById("book_hourReservation");

lunchButton.addEventListener("click", () => {
  const lunchHours = lunchButton.getAttribute("data-hours").split(",");
  let options = "";
  lunchHours.forEach((hour) => {
    options += `<option value="${hour}">${hour}</option>`;
  });
  hourReservationSelect.innerHTML = options;
  hourReservationSelect.disabled = false; // On active le select
});

dinnerButton.addEventListener("click", () => {
  const dinnerHours = dinnerButton.getAttribute("data-hours").split(",");
  let options = "";
  dinnerHours.forEach((hour) => {
    options += `<option value="${hour}">${hour}</option>`;
  });
  hourReservationSelect.innerHTML = options;
  hourReservationSelect.disabled = false; // On active le select
});

*/

const lunchButton = document.getElementById("btn-lunch");
const dinnerButton = document.getElementById("btn-dinner");
const hourReservationSelect = document.getElementById("book_hourReservation");

function generateOptions(hours) {
  let options = "<option value=''>Choisir un horaire</option>";
  hours.forEach((hour) => {
    options += `<option value="${hour}">${hour}</option>`;
  });
  return options;
}

lunchButton.addEventListener("click", () => {
  const lunchHours = lunchButton.getAttribute("data-hours").split(",");
  hourReservationSelect.innerHTML = generateOptions(lunchHours);
  hourReservationSelect.disabled = false;
});

dinnerButton.addEventListener("click", () => {
  const dinnerHours = dinnerButton.getAttribute("data-hours").split(",");
  hourReservationSelect.innerHTML = generateOptions(dinnerHours);
  hourReservationSelect.disabled = false;
});
