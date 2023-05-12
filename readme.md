Quai-antique
Application pour le restaurant Quai-Antique avec réservation en ligne.

Installation
Pour installer l'application en local, suivez les étapes suivantes :

Créez un nouveau dossier et ouvrez un terminal dans ce dossier.
Clonez le dépôt GitHub : 'git clone https://github.com/MelwynP/quai-antique.git'
À la racine du dépôt, créez un fichier .env en copiant le fichier de démonstration .env.demoLocal. , 
entrez la commande : 'cp .env.demoLocal .env'.
Ajoutez les informations nécessaires, les variables ainsi que les clefs JWT et APP.
Lancez la commande 'composer install'.
Créez la base de données avec la commande 'php bin/console doctrine:database:create'.
Appliquez la migration avec la commande 'php bin/console doctrine:migrations:migrate'.
Chargez les fixtures avec la commande 'php bin/console doctrine:fixtures:load --no-interaction'.
faire un cache clear : 'php bin/console cache:clear'
Lancez le serveur avec la commande 'symfony serve -d'.
Le site est maintenant lancé en local.

Cependant, pour que l'envoi de mails fonctionne, il faut configurer un serveur mail. Voici comment installer MailHog :

Téléchargez MailHog depuis GitHub : https://github.com/mailhog/MailHog/releases
Sélectionnez la version adaptée à votre système d'exploitation, puis téléchargez-la.
Placez l'exécutable dans le dossier de base que vous avez créé.
Dans le terminal, naviguez jusqu'au dossier de base en utilisant la commande cd.
Exécutez la commande './MailHog(ajouter_votre_version)'.
Dans un navigateur, accédez à l'adresse suivante : http://localhost:8025/
Ajoutez la variable d'environnement suivante au fichier .env : 'MAILER_DSN=smtp://localhost:1025'
Ajoutez également la variable d'environnement suivante au fichier .env : 'MESSENGER_TRANSPORT_DSN=doctrine://default?auto_setup=0'
L'envoi de mails est maintenant configuré.

Pour ajouter un administrateur, il suffit de s'enregistrer avec l'adresse e-mail : 'contact@quai-antique.tech'. Cela débloquera le compte administrateur.

Bonne installation !