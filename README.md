# Application web Salle de sport - STUDI

## Description du projet

Evaluation en cours de formation pour l'école STUDI. Une grande salle de sport souhaite gérer des droits d'accès à une application web pour ses entreprises franchisées qui possèdent des salles de sport. Vous pouvez accéder au site web à cette [adresse][5], mais vous aurez besoin d'un identifiant et d'un mot de passe.

### Utilisateur non connecté :
* Accès à la page login

### Manager connecté :
* Voir ses informations personnelles
* Voir les permissions globales
* Voir les informations de sa structure et les permissions liées
* Recherchez un utilisateur ou une structure

### Partenaire connecté :
* Voir ses informations personnelles
* Voir les permissions globales
* Voir les informations de sa (ses) structure(s) et les permissions liées
* Recherchez un utilisateur ou une structure

### Equipe technique de la marque connecté (administrateur) :
* Création :
    * Utilisateur
        * Manager
        * Partenaire
        * Equipe technique
    * Structure
    * Permission
    * Ajout d'une permission à un utilisateur
    * Ajout d'une permission à une structure

* Gestion : 
    * Utilisateur
        * Modifier
        * Supprimer
        * Désactiver/activer
    * Structure
        * Modifier
        * Supprimer
        * Désactiver/activer
    * Permission
        * Modifier
        * Supprimer
        * Désactiver/activer

* Recherchez un utilisateur ou une structure
## Les langages utilisés
| BACK | FRONT |
|:-:|:-:|
| Symfony 6.1 | html5 |
| php 8.1 | css3 |
| twig | sass |
| MySql | javaScript |

## Installation du projet après récupération du dépôt

Si vous souhaitez installer le projet sur votre ordinateur pour le tester en local, il faudra :
* Récupérer le dépôt via gitgub
* [Installer Symfony][1] avec Composer (regardez les [exigences techniques][2]).
* Symfony suit strictement le [versionnement sémantique][3], publie des versions " Long Term Support " (LTS) et a un [processus de publication][4] qui est prévisible et convivial pour les entreprises.
* Vous aurez besoin d'installer une base de données (j'ai utilisé [mysql][6] dans ce projet)
* Vous aurez besoin de renseigner une variable d'environnnement DATABASE_URL afin que le projet puisse être lié à votre base de données (voir le fichier .env)
* Vous aurez besoin de renseigner une variable d'environnement MAILER_DSN pour l'envoi automatique des mails via l'application (voir le fichier .env). Vous pouvez utiliser [mailtrap][7] qui vous permettra de vérifier si l'envoi des mails se fait correctement (il existe d'autres services identiques si vous souhaitez en utiliser un autre) 

[1]: https://symfony.com/doc/current/setup.html
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://semver.org
[4]: https://symfony.com/doc/current/contributing/community/releases.html
[5]: https://lorange-bleue.herokuapp.com
[6]: https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/
[7]: https://mailtrap.io/