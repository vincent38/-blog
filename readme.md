[FR] Blog basique
=====================

A propos
--------------------
Ce blog est un petit projet personnel faisant suite à un TP (disponible sur openclassrooms).
Le code n'est pas optimisé, certaines fonctions sont en double, des mises à jour fréquentes sont prévues.
Il n'y a pas de POO, et il n'y en aura jamais. Je n'ai pas encore démarré le cours, et je ne préfére pas recoder
l'intégralité des fonctionnalités.

Enjoy :3

Technologies
--------------------

Blog utilisant des technologies telles que :

* HTML, PHP et SQL pour le backend
* Bootstrap pour le frontend
* Font Awesome pour ajouter des icones vectorielles
* reCAPTCHA pour la validation des commentaires et inscriptions
* Gravatar, pour une gestion simplifiée des avatars des membres
* Un BBCODE-Like pour le formattage des articles
* Google charts pour l'affichage de statistiques
* Un accés à l'API twitter, pour une intégration de réseaux sociaux
* Google analytics et adsense pour l'analyse et la publicité

A propos - Contributions
---------------

Ce blog est un projet personnel. Vous pouvez le forker, effectuer des pull requests, mais la décision finale me revient.

Si vous souhaitez vous en servir dans le cadre d'un projet NON-COMMERCIAL, merci de conserver les crédits et le lien vers dans le footer et de m'envoyer un lien vers votre version du blog :D

Installation
---------------
Pour installer la plateforme, il vous faudra approximativement 10 minutes.

1- Rendez-vous dans /modele/

2- Modifiez connexionsql.php.aModifierAvantRenommage avec vos identifiants de connexion à votre BDD, et supprimez .aModifierAvantRenommage

3- Selon votre installation :

--> Serveur basé dans un pays étranger : Gardez fonctionsdb.php et modifiez les intervalles pour adapter le décalage france/pays hébergeur.

--> Serveur basé en france : Supprimez fonctionsdb.php et enlevez le .old du second fichier.

4- Rendez-vous dans /controleur/

5- Ouvrez analytics.php.old et collez votre code analytics, puis supprimez .old

6- Ouvrez apivariables.php.old, et collez votre clé reCaptcha, un salt robuste pour le cryptage des mots de passe et votre nom d'utilisateur twitter (pour un partage de liens avec mention de votre compte), puis supprimez.old

7- Ouvrez adsense.php et collez votre code adsense, puis supprimez .old

8- Importez createBDD.sql dans votre base de données

9- Créez un compte sur l'interface web. Choisissez un mot de passe robuste, car vous allez transformer ce compte en compte administrateur.

10- Ouvrez la table membres sur votre BDD

11- Modifiez le rank de votre compte du 3 au 5.

12- Modifiez les titres des pages (via les variables $titre dans les contrôleurs), ainsi que le titre et le sous-titre de votre blog (dans la page /vue/includes/header.php)

13- Terminé ! Vous pouvez maintenent promouvoir des utilisateurs au rang de modérateur/rédacteur, et commencer à rédiger vos premiers billets ! (N'oubliez pas de supprimer createBDD.sql)