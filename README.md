# FramePhp

## Commençons
Pour utiliser FramePhp, il suffit de cloner ce dépot dans votre projet :
```
git clone https://github.com/ElPolito/FramePhp.git
```
Voilà ! Vous pouvez maintenant voir votre site !

## Rentrons dans les détails
### Les bases de données
La première chose que vous voudrez sans doute faire c'est d'ajouter une base de donnée à votre site.
Pour ça on va se rendre dans un dossier sombre qui permet de faire fonctionner tout le framework, le dossier "**_config**".
Dans ce dossier il y a différents dossier et un seul fichier "**databases.php**" qui va nous intéresser. Onvrons le et voyons ce qu'il contient.
La partie importante de ce fichier est la ligne :
```
DB::addDB("first", "localhost", "root", "", "framephp", "mysql");
```
C'est avec cette ligne que nous allons pouvoir ajouter une base de données. On appel donc la méthode statique "**addDB**".
Cette fonction prend 6 paramètres. Tout d'abord le nom que vous voulez donnez à cette base de données, dans le cas où vous n'en utilisez qu'une seule, vous pouvez le laisser vide.
Ensuite on a l'adresse du serveur de base de données puis le nom d'utilisateur le mot de passe et le nom de la base de données. Enfin on spécifie quel type de base de données l'on souhaite utiliser.
Vous pouvez donc remplacer les valeurs avec celles de votre base de données.

Parfait on a maintenant une base de données.

#### Précision sur le nom de la base de données
Comme dit précédemment, le premier argument peut être laissé vide si l'on n'utilise qu'une seule base de données. Cependant comment faire si on en a besoin de plusieurs.
En fait on peut en ajouter autant qu'on le souhaite. Il suffit de dupliquer notre ligne magique et de changer les informations.
Et c'est à ce moment là qu'il va falloir spécifier un nom car c'est avec celui-ci que l'on va pouvoir choisir par la suite la base de données que l'on veut utiliser.

### Les routes
Nous allons maintenant voir comment créer des routes afin de pouvoir accéder à différentes pages.
Pour ce faire, il suffit de se rendre dans le dossier "**Routes**". On peut voir que par défaut il n'y a qu'un seul fichier nommé "**root.php**".
En fait on peut en créer autant qu'on veut, ça peut être utile si on a plusieurs parties dans notre site et qu'on veut pouvoir s'y retrouver.
Par exemple si on a un forum et une partie utilisateur, on va pouvoir créer un fichier "**root_forum.php**" pour le forum et fichier "**rooot_user.php**" pour la partie utilisateur.
Maintenant, ouvrons le fichier "**root.php**". On peut y trouver une ligne très importante :
```
$routes->add("/", "Default:home");
```
Cette ligne permet d'ajouter une route. Le premier paramètre de cette fonction **add** permet de spécifier le chemin que doit utiliser l'utilisateur.
Par exemple si on veut créer un page de connnexion on mettra "**/connexion**". On verra par la suite que l'on peut faire des choses un peut plus techniques.
Le deuxième paramètre de cette fonction permet de spécifier le contrôleur que l'on devra utiliser ainsi que la fonction a appeler.
En effet, "**Default:home**" signifie que l'on va utiliser le contrôleur "**DefaultController**" et que l'on va appeler sa fonction "**home**".

Maintenant que nous savons comment créer des routes voyons comment fonctionnent les contrôleurs.

### Les contrôleurs
Rendons nous maintenant dans le dossier "**Controllers**". On y retrouve deux fichiers : "**default.php**" et "**error.php**".
Ouvrons d'abord "**default.php**"
On peut voir les composantes essentielles d'un contrôleur :
```
namespace Project\Controllers;

use Project\_config\utilities\Controller;
```
Ces deux lignes sont essentielles pour tous les contrôleurs. 
On définit ensuite une classe nommée **DefaultController** qui étend **Controller**
```
class DefaultController extends Controller{
```
