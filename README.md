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
class DefaultController extends Controller {
```
On retrouve ici notre fonction **home** qui est utilisée dans notre définition de route.
En fait on peut créer autant de fichier qui vont servir de contrôleurs qu'on le souhaite tant qu'ils sont tous dans le dossier "**Controllers**".
Dans une classe **controller** on peut également créer autant de fonctions que nous le souhaitons. 
Si on reprend notre exemple de site avec une partie forum et une partie utilisateur, on aurait un contrôleur "**UserController**" avec les fonction "**profil**", "**modifierprofil** ... et un contrôleur "**ForumController**".
Chaque fonction d'un contrôleur qui va être appelée pour une route donnée doit renvoyer du texte.
On peut donc juste mettre un **return "toto";** ou bien utiliser le système de "templates".

### Le système de templates
Pour utiliser le système de templates fournit par **FramePhp**, il suffit de créer un fichier "**.php**" dans un des sous-dossier de "**Templates**". C'est ici que vous devez mettre votre code **html**. Sauf que l'intérêt d'avoir un fichier "**php**" c'est que vous allez pouvoir utiliser des variables.
Pour notre forum, par exemple, on voudrait pouvoir voir tous les posts qui sont dans notre base de données, on peut alors les récupérer dans le contrôleur puis les envoyer à notre template.

C'est bien beau tout ça mais on fait comment ?

Et bien c'est très simple dans votre contrôleur, il faut créer un objet **Template** comme ceci :
```
$view = $this->template("Global:home", array("users" => $users));
```
Le premier paramètre de la fonction **template** correspond au chemin du template. Par exemple, si on a créé un fichier **home.php** dans le dossier **Forum** lui-même dans le dossier **Templates**, il faut indiquer **"Forum:home"** si on a une architecture un peu plsu complexe, on peut tout à fait mettre **"Forum:Post/home"**. Comme vous l'avez remarqué, on ne précise pas le type de fichier. Vous devez donc absolument faire référence à des fichiers **php**.
Le deuxième paramètre de la fonction **template** est facultatif, c'est un tableau associatif qui va contenir toutes les données que l'on veut faire passer dans le template. Pour notre système de posts, on mettrait **array("posts" => $posts)** en supposant que l'on ai récupérer les différents posts dans la variable **$post**. Il ne faut pas oublier que c'est un tableau on peut donc mettre autant de données qu'on le souhaite (array("posts" => $posts, "page" => $page, "user" => $user)).
Finalement on obtiendrait : 
```
$view = $this->template("Forum:home", array("posts" => $posts));
```
On a dit plus haut qu'un contrôleur devait forcément retourner du texte. On va donc appeler la méthode **showTime** qui permet de faire le traitement du template. On peut alors retourner la valeur renvoyer.
```
return $view->showTime();
```

Ok, du coup maintenant on peut faire passer des variables depuis notre comtrôleur jusqu'à notre template mais comment on fait pour les récupérer ?

Et bien c'est très simple, dans le fichier template, on peut ouvrir des balises php et avoir accès à ce tableau que l'on a définit précédemment. Il suffit de mettre :
```
<?php 
$param["posts"];
?>
```
Ce code ne sert à rien mais il vous montre comment récupérer la variable contenant tous les posts.

#### Le gestionnaire de templates Twig
En fait, mettre des balises php de partout dans les template, c'est un peu long, on vous a donc donné la possibilité d'utiliser le moteur de template **Twig** qui permet d'avoir un code beaucoup plus beau. On ne va pas vous expliquer ici comment cela fonctionne, la documentation de twig est très bien faite : "https://twig.symfony.com/". On va juste vous montré comment l'utiliser.
Pour utiliser **twig** on va tout d'abord devoir l'importer :
```
composer require "twig/twig:^2.0"
```
Ensuite, on va se rendre dans le fichier **index.php** à la racine du projet pour y modifier une variable.
A la ligne :
```
define("USETWIG", false);
```
on va mettre **true** à la place de **false**.
C'est bon vous êtes prêt à utiliser Twig. Il suffit juste de remplacer dans vos contrôleurs la ligne :
```
$view = $this->template("Global:home", array("users" => $users));
```
Par : 
```
$view = $this->twigtemplate("Global:home", array("users" => $users));
```
