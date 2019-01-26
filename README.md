# FramePhp

## Bien démarrer
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

En fait on peut créer des routes bien plus complexes. Imaginons que nous voulions créer un blog, si nous étions dans un projet php normal, il aurait fallu créer un fichier pour chaque articles ou utiliser des addresses du type : **monblog.fr/blog?article=monarticle** ce qui n'est pas très beau. Et bien avec framephp on va pouvoir transformer ces addresses en **monblog.fr/blog/monarticle**. 
En fait on va ajouter une variable dans notre route. C'est à dire que l'on va spécifier qu'une partie de la routes n'est pas fixe.
On fait ça en ajoutant des **{}** à la place d'un mot.
Pour notre exemple de blog on aurait :
```
$routes->add("/blog/{nomArticle}", "Blog:article");
```
Le nom que vous donnez entre les **{}** ne sert pas à grand chose, il est là uniquement pour vous pour que vous puissiez vous y retrouver. En réalité on peut créer des routes beaucoup plus complexes comme : 
```
$routes->add("/vip/{idVip}/request/{idRequest}/modify", "Vip:modifyRequest");
```

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

Si vous avez utiliser le système de routes complexes avec les **{}** deux cas se distinguent.
Si votre route ne contient qu'une seule variable, votre contrôleur doit prendre un paramètre qui contiendra cette variable.
Si votre route contient plusieurs variable, votre contrôleur doit prendre un paramètre qui contiendra un tableau contenant toutes les variables.

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
Encore un dernier effort, pour utiliser twig, vos templates doivent être des fichiers **.twig** et non **.php**.

### Mettre en forme votre site
Vous voulez sans doute avoir un site avec un minimum de graphismes et donc pouvoir utiliser du CSS, du Javascript et des images.
Pour cela rien de plus facile, on a mis à votre disposition un dossier **Assets** dans lequel vous allez pouvoir mettre ces différents éléments.
Ensuite, dans vos templates pour ajouter du css on ajoute :
```
<link rel="stylesheet" type="text/css" href="<?= ASSETS . 'CSS/home.css' ?>" />
```
Et c'est le même principe pour les fichiers Javascript ou les images.
Attention, il faut que la variable globale **ASSETS** soit bien initialisée dans le fichier **Defines/default.php**.

Vous pouvez aussi utiliser la variable **PATH** pour vos liens dans les balises **a**.

### Utiliser votre base de données
Ok du coup c'est cool, on peut envoyer des données depuis le contrôleur et les récupérer dans les templates maintenant il nous reste un problème, comment on fait pour récupérer les données qui sont dans la base de données ?

Et bien cette partie repose sur deux dossiers principalement : le dossier "**DatabaseLinks**" qui contient toutes les requètes en base de données et le dossier "**Classes/Entities**" qui contient toutes cos entitées.

#### Les entitées
Dans le dossier **Classes/Entities** on va mettre toutes nos entitées c'est à dire des classes représentant nos tables dans la base de données. 
C'est aussi simple que ça.

#### Les databaselinks
Maintenant qu'on a créé nos entitées pour accueillir nos données provenant de la base de données on va pouvoir commencer à s'en servir pour récupérer, insérer, modifier ou supprimer nos données.

C'est à ça que vont servir les classes dans le dossier **DatabaseLinks**. Chaque entité aura une classe correspondante dans ce dossier.
Ce sont des classes **DAO** (objet d'accès aux données). Dans ces classes on va ajouter autant de méthode qu'on le souhaite pour récupérer toutes les données d'une table ou seulement certaines, supprimer, modifier ou insérer des données.

Pour vous faciliter la tâche, on vous a créé un objet **DAO** qui possède deux méthodes statiques : **queryAll** pour récupérer plusieurs lignes d'une table et qui renvoie un tableau de tableaux de données et **queryRow** qui permet de modifier, supprimer ou insérer des données. La deuxième méthode **queryRow** permet aussi de récupérer une seule ligne et renvoie dans ce cas là un tableau simple de données.

Ces deux méthodes prennent en premier paramètre une chaîne de charactère représentant une requête sql qui peut contenir des "**?**" pour les données à insérer. Le deuxième paramètre (facultatif) permet de spécifier un tableau de données pour remplacer les "**?**".
Enfin le dernier paramètre ne concerne que ceux qui utilisent plusieurs bases de données et il permet de spécifier le nom de la base de données à utiliser.


***Ok, du coup on est pas mal là. On peut maintenant ajouter des routes qui vont appeler des fonctions dans nos classes contrôleurs qui elles-mêmes cont pouvoir contacter les DAO pour traiter les données et enfin pouvoir renvoyer un template à l'utilisateur.***

### Les variables globales
Le dossier "**Defines**" permet de définir des variables que vous allez pouvoir utiliser partout dans votre application.
Un premier fichier est déjà présent et il est très important. Il contient les différentes variables nécéssaires au bon fonctionnement de votre application.
On y retrouve une variable *PRODUCTION* qui spécifie l'état de l'application, des variables pour les chemins importants de l'application et des variables pour le debuggage.

Mais vous pouvez ajouter autant de fichier dans ce dossier que vous le souhaitez afin de définir vos propres variables.

### Traduire son application
Il y a deux manières de traduire votre application.
Tout d'abord il faut se rendre dans le fichier "**Defines/default.php**" pour changer la variable **DEFAULTLANG**, il faut mettre le code de la langue de votre site par défaut c'est à dire la langue utilisée dans vos templates.
Ensuite il suffit de mettre cette ligne :
```
<?= $translate->translate('Get started'); ?>
```
Il vous faut donc mettre cette ligne dans les templates à chaque fois que vous souhaitez traduire un mot ou une phrase.
Ensuite il suffit de se rendre dans le dossier "**Translations**" dans lequel vous allez trouver un dossier "**fr**" en fait ici il faut mettre autant de dossier que de langues supportées par votre site. Le nom des dossiers doit correspondre aux codes des différentes langues. Dans ces dossiers vous pouvez mettre autant de fichier "**.no**" que vous pouvez.
Dans ces fichiers il vous faut faire la correspondance entre les mots (ou phrases) dans la langue par défaut et ceux dans la langue d'arrivée.
```
Get Started : Commencer
Let's begin : Commençons
```
Faites bien attention à ne pas sauter une ligne en fin de fichier sinon vous obtiendrez une erreur.
Par défaut, le framework va récupérer la langue de l'utilisateur et essayera de traduire le texte dans cette langue si la langue n'est pas supportée ou que le mot n'a pas été traduit, il affichera le mot dans la langue par défaut.
Cependant, si vous voulez que l'utilisateur puisse changer lui-même la langue du site, vous pouvez appeler dans vos contrôleurs la fonction : 
```
$this->changeLang("en");
```
En spécifiant en paramètre le code de la langue dans laquelle vous voulez que votre site apparaisse.

La deuxième façon de traduire votre site repose sur les **defines**. La première chose est de modifier le fichier "**Defines/default.php**" en changeant au minimum la valeur de **USEDEFINETRANSLATE** en la mettant à **true**. Vous pouvez également passer la valeur de **USETRANSLATION** à **false** si vous ne souhaitez pas utiliser l'autre mode de traduction mais vous pouvez très bien laisser les deux à **true**.
Maintenant il va falloir ajouter un dossier **Translations** dans le dossier **Defines** qui contiendra un dossier pour chaque langue supprtés par votre site. Ces dossiers contiendront des fichiers **.php** qui définiront des variables globales à utiliser dans votre site.
Par exemple, dans le dossier **Defines/Translations/fr** on va mettre un fichier **home.php** qui contiendra :
```
<?php 
define("TXT_START", "Commencer");
define("TXT_CONNECT", "Connexion");
?>
```
Et dans le dossier **Defines/Translations/en** on va mettre un autre fichier **home.php** qui contiendra :
```
<?php 
define("TXT_START", "Get started");
define("TXT_CONNECT", "Connection"); 
?>
```
Maintenant, dans vos templates vous pouvez mettre : 
```
<h1><?= TXT_START ?></h1>
```
Le texte sera automatiquement traduit.
Comme pour la première méthode de traduction il est possible de changer la langue depuis le contrôleur avec la mêle fonction : 
```
$this->changeLang("en");
```

Vous êtes maintenant en mesure de rendre votre site visible à l'international !

### Les services
Dans une application web il y a souvent des opérations que vous répétez dans différents contrôleurs. Pour éviter de les réécrire à chaque fois on vous a mis en place un système de service. 
Si vous allez dans le dossier **Services** vous trouverez un fichier **redirect.php**. Ce fichier contient une classe permettant de rediriger l'utilisateur sur une page d'erreur 404 page not found.
Pour l'utiliser dans votre contrôleur il suffit d'ajouter en haut du fichier juste après le **namespace** la ligne :
```
use Project\Services\Redirect;
```
Ensuite dans votre fonction de contrôleur appelez juste :
```
Redirect::redirectToError();
```
C'est tout votre utilisateur vas être rediriger directement sur une page d'erreur.
Vous pouvez créer autant de services que vous le souhaitez afin de faciliter votre développement.
Un autre service vous est proposé permettant d'uploader un fichier dans le dossier **Assets/Uploads**.

### Les tests
