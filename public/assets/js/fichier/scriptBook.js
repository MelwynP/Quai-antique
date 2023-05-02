// ----------------------------------
// Déclaration des Constantes
const dateReservation = document.querySelector("#book_form_dateReservation");
const serviceType = document.querySelector("#book_form_serviceType");
const hour = document.querySelector("#book_form_hour");
const numberPeople = document.querySelector("#book_form_numberPeople");
const submitBtn = document.querySelector("#submitBtn");
const formElements = document.querySelectorAll(
  "input, select, textarea, button"
);

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
// fonction pour réinitialiser certain éléments du formulaire
function resetFormElements() {
  const formElements = [
    document.querySelector("#book_form_dateReservation"),
    document.querySelector("#book_form_serviceType"),
    document.querySelector("#book_form_hour"),
    document.querySelector("#book_form_numberPeople"),
  ];

  formElements.forEach((element) => {
    if (element.id !== "book_form_dateReservation") {
      element.disabled = true;
    }
  });

  // Activation du champ de saisie du service après sélection de la date
  dateReservation.addEventListener("change", () => {
    serviceType.disabled = false;
  });

  // Activation du champ de saisie de l'heure après sélection du service
  serviceType.addEventListener("change", () => {
    hour.disabled = false;
  });

  // Activation du champ de saisie du nombre de personnes après sélection de l'heure
  hour.addEventListener("change", () => {
    numberPeople.disabled = false;
  });

  // Activation de tous les champs après sélection du nombre de personnes
  numberPeople.addEventListener("change", () => {
    formElements.forEach((element) => {
      element.disabled = false;
    });
  });
}
// Appel de la fonction pour réinitialiser les éléments
resetFormElements();

// ----------------------------------
// Affichage des horaires pour Lunch ou Dinner
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

// ----------------------------------
// fonction pour réinitialiser le nombre de personnes si changement de service ou de date
function resetNumberPeople() {
  numberPeople.value = "";
  responseRequete.textContent = "";
}
// écouter les changements de service et de date
serviceType.addEventListener("change", () => {
  resetNumberPeople();
});
dateReservation.addEventListener("change", () => {
  resetNumberPeople();
});

// ----------------------------------
// fonction pour réinitialiser le service / l'heure / le nb de personnes si changement de date
function resetInfoBook() {
  serviceType.value = "";
  hour.value = "";
  numberPeople.value = "";
  responseRequete.textContent = "";
}
// écouter les changements de service et de date
dateReservation.addEventListener("change", () => {
  resetInfoBook();
});

// ----------------------------------
// Request API Fetch
const responseRequete = document.getElementById("responseRequete");
const erreur = document.querySelector("#erreur");

numberPeople.addEventListener("change", () => {
  fetch(
    `/reservation/check-availability/${serviceType.value}/${dateReservation.value}/${numberPeople.value}`
  )
    .then((res) => res.json())
    .then((ret) => {
      if (ret.isFull === true) {
        responseRequete.textContent =
          "Désolé, il ne reste plus de place pour cette date, choisissez une autre date et/ou un autre service.";
        submitBtn.disabled = true;
        // désactiver tous les champs sauf la date
        formElements.forEach((element) => {
          if (
            element.id !== "book_form_dateReservation" &&
            element.id !== "book_form_serviceType" &&
            element.id !== "book_form_hour" &&
            element.id !== "book_form_numberPeople"
          ) {
            element.disabled = true;
          }
        });
      } else {
        responseRequete.textContent =
          "Aprés vérification, il reste de la place pour cette date, vous pouvez réserver.";
        submitBtn.disabled = false;
        formElements.forEach((element) => {
          if (
            element.id !== "book_form_dateReservation" &&
            "book_form_serviceType" &&
            "book_form_hour" &&
            "book_form_numberPeople"
          ) {
            element.disabled = false;
          }
        });
      }
    })
    .catch((error) => {
      console.error(error);
      document.querySelector("#erreur").textContent =
        "Une erreur est survenue lors de la vérification de la disponibilité.";
    });
});

// ----------------------------------
// Réinitialisation du formulaire si la page est rechargée et/ou retournée via le retour du navigateur
window.addEventListener("pageshow", function (event) {
  resetFormElements();
  dateReservation.value = "";
  resetInfoBook();
  submitBtn.disabled = true;
});
