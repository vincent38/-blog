[FR] Blog basique
=====================

A propos
--------------------
Ce blog est un petit projet personnel faisant suite à un TP (disponible sur openclassrooms).
Le code n'est pas optimisé, certaines fonctions sont en double, des mises à jour fréquentes sont prévues.
Il n'y a pas de POO, et il n'y en aura jamais. Je n'ai pas encore démarré le cours, et je ne préfére pas recoder
l'intégralité des fonctionnalités.

ATTENTION : La technologie de cryptage utilisée pour les mots de passe est le sha1. Cette technologie de cryptage sera changée dans une version future. Nous vous recommendons de ne pas stocher des données sensibles, et d'informer vos utilisateurs du fait qu'ils devront changer leurs mots de passe après installation d'une technlogie plus avancée.

Enjoy :3

Technologies
--------------------

Blog utilisant des technologies telles que :

* HTML, PHP, SQL et Javascript pour le backend
* Bootstrap pour le frontend
* AJAX pour le live reloading des articles
* Font Awesome pour ajouter des icones vectorielles
* reCAPTCHA pour la validation des commentaires et inscriptions
* Gravatar, pour une gestion simplifiée des avatars des membres
* Un BBCODE-Like pour le formattage des articles
* Google charts pour l'affichage de statistiques
* Un accés à l'API twitter, pour une intégration de réseaux sociaux
* Google analytics et adsense pour l'analyse et la publicité
* Imageshack, pour l'hébergement d'images et la génération de balises prêtes à coller dans vos articles

A propos - Contributions
---------------

Ce blog est un projet personnel. Vous pouvez le forker, effectuer des pull requests, mais la décision finale me revient.

Si vous souhaitez vous en servir dans le cadre d'un projet NON-COMMERCIAL, merci de conserver les crédits et le lien vers dans le footer et de m'envoyer un lien vers votre version du blog :D

Dernière MàJ
---------------
Très grande mise à jour depuis le dernier commit d'octobre 2015 !
Plusieurs fonctionnalités ont fait leur apparition à l'occasion de cette public release v2,
notamment (liste non exhaustive) :

* L'éditeur d'articles a été remanié, avec l'ajout de boutons de balises, d'un système de live reloading, et l'intégration d'Imageshack sur l'éditeur (connectez-vous avant de rédiger votre article !)

* Ajout de fonctions de maintenance, d'un tag cloud et d'un carousel qérés depuis la page d'administration.

* Live reloading des articles en AJAX

* Amélioration du moteur interne, ajout de fonctions et de code d'utilité majeure

* Préparation d'un chat interne (non accessible pour le moment)

* Autres changements mineurs

Installation
---------------
Pour installer la plateforme, il vous faudra approximativement 10 minutes.

1- Rendez-vous dans /modele/

2- Modifiez connexionsql.php avec vos identifiants de connexion à votre BDD

3- Selon votre installation :

--> Serveur basé dans un pays étranger : Gardez fonctionsdb.php et modifiez les intervalles pour adapter le décalage france/pays hébergeur.

--> Serveur basé en france : Supprimez fonctionsdb.php et enlevez le .old du second fichier.

4- Rendez-vous dans /controleur/

5- Ouvrez analytics.php et collez votre code analytics

6- Ouvrez apivariables.php, et collez votre clé reCaptcha, un salt robuste pour le cryptage des mots de passe, votre nom d'utilisateur twitter (pour un partage de liens avec mention de votre compte), ainsi que votre clé d'API Imageshack

7- Ouvrez adsense.php et collez votre code adsense

8- Importez createBDD.sql dans votre base de données

9- Créez un compte sur l'interface web. Choisissez un mot de passe robuste, car vous allez transformer ce compte en compte administrateur.

10- Ouvrez la table membres sur votre BDD via phpmyadmin, par exemple

11- Modifiez le rank de votre compte du 3 au 5.

12- Modifiez les titres des pages (via les variables $titre dans les contrôleurs), ainsi que le titre et le sous-titre de votre blog (dans la page /vue/includes/header.php)

13- Terminé ! Vous pouvez maintenent promouvoir des utilisateurs au rang de modérateur/rédacteur, et commencer à rédiger vos premiers billets ! (N'oubliez pas de supprimer createBDD.sql de la racine du site !)