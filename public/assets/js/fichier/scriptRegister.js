// message d'erreur qui indique comment regler le message
const mdp = document.querySelector("#registration_form_plainPassword");
const mdpinfo = document.querySelector("#mdpinfo");

// function qui envoi un message expliquant le mot de passe demandé
mdp.addEventListener("click", function () {
mdpinfo.textContent = "Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
mdpinfo.classList.add("text-secondary");
});


// Affichage d'une div animation sur la page d'inscription
const blurBackground = document.getElementById('blur-background');
const messageDiv = document.getElementById('inscription-message');

function afficherMessage() {
  blurBackground.style.display = 'block';
  messageDiv.style.display = 'block';
}

function cacherMessage() {
  blurBackground.style.display = 'none';
  messageDiv.classList.add('animation-sortie');
  setTimeout(function() {
    messageDiv.style.display = 'none';
    messageDiv.classList.remove('animation-sortie');
  });
}

window.onload = afficherMessage;

// Pour cacher le message lorsqu'on clique sur l'arrière-plan flou
blurBackground.addEventListener('click', cacherMessage);
messageDiv.addEventListener('click', cacherMessage);

