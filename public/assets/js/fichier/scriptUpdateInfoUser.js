// declaration des variables
const nameUser = document.querySelector("#update_user_form_name");
const firstname = document.querySelector("#update_user_form_firstname");
const phone = document.querySelector("#update_user_form_phone");
const allergy = document.querySelector("#update_user_form_allergy");
const nameUserError = document.querySelector("#nameUserError");
const firstnameError = document.querySelector("#firstnameError");
const phoneError = document.querySelector("#phoneError");
const allergyError = document.querySelector("#allergyError");
const submitBtn = document.quer;

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
