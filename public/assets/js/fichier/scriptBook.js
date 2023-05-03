// ----------------------------------
// Déclaration des variables
const dateReservation = document.querySelector("#book_form_dateReservation");
const serviceType = document.querySelector("#book_form_serviceType");
const hour = document.querySelector("#book_form_hour");
const numberPeople = document.querySelector("#book_form_numberPeople");
const submitBtn = document.querySelector("#submitBtn");
const radioConsent = document.querySelector("#book_form_RGPDConsent");
const responseRequete = document.querySelector("#responseRequete");
const erreur = document.querySelector("#erreur");
const form = document.querySelector("#monFormulaire");

// ----------------------------------
// Calendrier flatpickr
flatpickr(dateReservation, {
  locale: "fr",
  dateFormat: "d-m-Y",
  minDate: "today",
  disable: [
    function (date) {
      return date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3;
    },
  ],
});

// ----------------------------------
// Gestion des heures de réservation placeholder et options
function changePlaceholder() {
  const hoursByService = {
    Déjeuner: ["12:00", "12:15", "12:30", "12:45", "13:00"],
    Dîner: [
      "19:00",
      "19:15",
      "19:30",
      "19:45",
      "20:00",
      "20:15",
      "20:30",
      "20:45",
      "21:00",
    ],
  };

  // Ajouter un événement d'écoute sur le champ de saisie du service
  serviceType.addEventListener("change", (event) => {
    // Récupérer les horaires correspondant au service sélectionné
    const selectedService = event.target.value;
    const hours = hoursByService[selectedService];

    // Vider les options actuelles du champ de saisie de l'heure
    hour.innerHTML = "";

    // Ajouter un placeholder pour le champ de saisie de l'heure
    const placeholderOption = document.createElement("option");
    placeholderOption.disabled = true;
    placeholderOption.selected = true;
    placeholderOption.textContent = "Choisissez une heure";
    hour.appendChild(placeholderOption);

    // Générer les options pour chaque heure disponible
    hours.forEach((time) => {
      const option = document.createElement("option");
      option.value = time;
      option.textContent = time;
      hour.appendChild(option);
    });
  });
}
// Appel de la fonction changePlaceholder
changePlaceholder();

// ----------------------------------
// Fonction de désactivation des champs de saisie, donne un sens au formulaire
function senseForm() {
  // Désactivation des champs de saisie du service, de l'heure du nombre de personnes et du consentement
  let previousDate = "";
  let previousService = "";
  serviceType.disabled = true;
  hour.disabled = true;
  numberPeople.disabled = true;
  radioConsent.disabled = true;
  submitBtn.disabled = true;

  dateReservation.addEventListener("change", () => {
    // Vérifier si la date a été modifiée
    if (dateReservation.value !== previousDate) {
      serviceType.value = "";
      hour.value = "";
      responseRequete.textContent = "";
      erreur.textContent = "";
      serviceType.disabled = true;
      hour.disabled = true;
      numberPeople.disabled = true;
      radioConsent.disabled = true;
      submitBtn.disabled = true;
    }
    previousDate = dateReservation.value;
    serviceType.disabled = false;
  });

  // Activation du champ de saisie de l'heure après sélection du service
  serviceType.addEventListener("change", () => {
    // Vérifier si le service a été modifié
    if (serviceType.value !== previousService) {
      hour.value = "";
      responseRequete.textContent = "";
      erreur.textContent = "";
      hour.disabled = true;
      numberPeople.disabled = true;
      radioConsent.disabled = true;
      submitBtn.disabled = true;
    }
    previousService = serviceType.value;
    hour.disabled = false;
  });

  hour.addEventListener("change", () => {
    numberPeople.disabled = false;
    radioConsent.disabled = false;
  });

  // // Mettre à jour la date précédente
  // previousDate = dateReservation.value;
}

// Appel de la fonction senseForm
senseForm();

//----------------------------------
// Requête Fetch
function updateAvailability() {
  fetch(
    `/reservation/check-availability/${serviceType.value}/${dateReservation.value}/${numberPeople.value}`
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.isFull) {
        console.log(data);
        submitBtn.disabled = true;
        document.querySelector("#responseRequete").textContent =
          "Désolé, il n'y a plus de place disponible pour cette date et ce service.";
      } else {
        document.querySelector("#responseRequete").textContent =
          "Il reste des places disponibles pour cette date et ce service.";
        submitBtn.disabled = data.isFull;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      document.querySelector("#erreur").textContent =
        "Une erreur est survenue lors de la vérification de la disponibilité.";
    });
}
serviceType.addEventListener("change", updateAvailability);
numberPeople.addEventListener("change", updateAvailability);

// ----------------------------------
// Réinitialiser le formulaire lors du chargement de la page
function resetWindow() {
  // Réinitialiser le formulaire lors du chargement de la page
  window.addEventListener("pageshow", function (event) {
    // Vérifier si la page est chargée à partir du cache
    if (event.persisted) {
      // Réinitialiser les champs de formulaire
      document.querySelector("#monFormulaire").reset();
      senseForm();
    }
  });
}
resetWindow();
