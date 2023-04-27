fetch("/reservation/requete").then((res) => {
  console.log(res);
  // On peut console.log afin de voir ce que l'on récupère true ou false. ok est un boolean
  if (res.ok) {
    //verifie si c'est true
    res.json().then((html) => {
      console.log(html);
      responseRequete.innerHTML = html;
    });
  } else {
    console.log("erreur");
    document.getElementById("erreur").innerHTML =
      "Erreur de chargement de l'image";
  }
});
