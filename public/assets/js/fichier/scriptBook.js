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
const firstname = document.querySelector("#book_form_firstname");
const firstnameError = document.querySelector("#firstnameError");
const nameUser = document.querySelector("#book_form_name");
const nameUserError = document.querySelector("#nameError");
const phone = document.querySelector("#book_form_phone");
const phoneError = document.querySelector("#phoneError");
const email = document.querySelector("#book_form_email");
const emailError = document.querySelector("#emailError");
const allergy = document.querySelector("#book_form_allergy");
const allergyError = document.querySelector("#allergyError");


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
    Dîner: ["19:00", "19:15", "19:30", "19:45", "20:00", "20:15", "20:30", "20:45", "21:00"],
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
  // Mettre à jour la date précédente
  previousDate = dateReservation.value;
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
      console.error("Error:", error)
      document.querySelector("#erreur").textContent =
        "Une erreur est survenue lors de la vérification de la disponibilité.";
    });
}
serviceType.addEventListener("change", updateAvailability);
numberPeople.addEventListener("change", updateAvailability);


// ----------------------------------
// function verif firstname
firstname.addEventListener("blur", function () {
  const firstnameValue = firstname.value.trim();
  if (
    firstnameValue !== "" &&
    (firstnameValue.length < 2 || firstnameValue.length > 80)
  ) {
    firstnameError.textContent =
      "Le prénom est optionnel mais il doit contenir entre 2 et 80 caractères.";
    firstnameError.classList.add("text-secondary");
    firstname.classList.add("is-invalid");
    submitBtn.disabled = true;
  } else {
    firstnameError.textContent = "";
    firstnameError.classList.remove("text-secondary");
    firstname.classList.remove("is-invalid");
    submitBtn.disabled = false;
  }
});


// ----------------------------------
// function verif name
nameUser.addEventListener("blur", function () {
  const nameUserValue = nameUser.value.trim();
  if (nameUserValue.length < 2 || nameUserValue.length > 80) {
    nameUserError.textContent =
      "Entrez votre nom qui doit contenir entre 2 et 80 caractères pour debloquer le formulaire";
    nameUserError.classList.add("text-danger");
    nameUser.classList.add("is-invalid");
    submitBtn.disabled = true;
  } else {
    nameUserError.textContent = "";
    nameUserError.classList.remove("text-danger");
    nameUser.classList.remove("is-invalid");
    submitBtn.disabled = false;
  }
});


// ----------------------------------
// function verif phone
phone.addEventListener("blur", function () {
  const phoneValue = phone.value.trim();
  if (
    phoneValue !== "" &&
    (phoneValue.length !== 10 || !phoneValue.match(/^\d{10}$/))
  ) {
    phoneError.textContent =
      "Le numéro de téléphone est optionnel mais il doit contenir 10 chiffres, 0601020304";
    phoneError.classList.add("text-secondary");
    phone.classList.add("is-invalid");
    submitBtn.disabled = true;
  } else {
    phoneError.textContent = "";
    phoneError.classList.remove("text-secondary");
    phone.classList.remove("is-invalid");
    submitBtn.disabled = false;
  }
});


// ----------------------------------
// function verif email
email.addEventListener("blur", function () {
  const emailValue = email.value.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // expression régulière qui vérifie si l'entrée est une adresse email valide
  if (emailValue.length > 200 || !emailRegex.test(emailValue)) {
    emailError.textContent =
      "Entrez une adresse e-mail valide pour debloquer le formulaire";
    emailError.classList.add("text-danger");
    email.classList.add("is-invalid");
    submitBtn.disabled = true;
  } else {
    emailError.textContent = "";
    emailError.classList.remove("text-danger");
    email.classList.remove("is-invalid");
    submitBtn.disabled = false;
  }
});


// ----------------------------------
// function verif allergy
allergy.addEventListener("blur", function () {
  const allergyValue = allergy.value.trim();
  if (
    allergyValue !== "" &&
    (allergyValue.length < 2 || allergyValue.length > 200)
  ) {
    allergyError.textContent =
      "Le champ allergie(s) est optionnel mais il doit contenir entre 2 et 200 caractères.";
    allergyError.classList.add("text-secondary");
    allergy.classList.add("is-invalid");
    submitBtn.disabled = true;
  } else {
    allergyError.textContent = "";
    allergyError.classList.remove("text-secondary");
    allergy.classList.remove("is-invalid");
    submitBtn.disabled = false;
  }
});


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

// Appel de la fonction resetWindow
resetWindow();


