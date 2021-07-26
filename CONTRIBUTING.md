# Contribuer au projet

Vous trouverez ici en **première partie** une liste non exhaustive de ce qu’il faudra absolument faire pour contribuer au projet todo-list.

Aussi, nous voulons simplifier l'apprentissage des nouveaux contributeurs au logiciel libre en vous enseignant à contribuer pour la première fois dans la **deuxième partie**.

___

## Concernant les branches

- Vous devez travailler dans une branche distante. Le nom de la branche doit être explicite sur ce qu’elle apporte au projet, et suivre au maximum un format comme ceci :
    - features/add-task-priority
    - fix/display-author-if-null
    - frontend/fix-navbar
- Gardez en tête qu’une branche doit avoir une certaine logique en relation avec son nom, si vous travaillez sur plusieurs modifications qui ne sont pas reliées, créez plusieurs branches

## Avant de faire une pull request

- Concernant le code déjà existant, pensez à bien vérifier les points suivants :
    - Tous les tests doivent passer, si vous avez modifié un comportement de manière légitime et que celui ci casse un test, vous devez corriger le test, vous ne devez pas le mettre en commentaire ou le supprimer (sauf cas légitime qui doit être justifié en commentaire de la pull request )

- Concernant le code que vous ajoutez :
    - Ce que vous apportez au projet doit être testé, de manière fonctionnelle et unitaire.
    - Vous devez respecter au maximum les best-practices (voir ci-dessous). Votre code doit être propre et compréhensible.
    - Vous pouvez ajouter des dossiers dans la whitelist de phpunit ( phpunit.xml.dist ) si nécéssaire. Actuellement, les dossiers dans la whitelist sont : Controller, Entity, Form, Manager, Repository et Twig.

## Best-practices

Il est important de respecter les différents standards [PHP](https://www.php-fig.org/psr/) et [Symfony](https://symfony.com/doc/current/index.html) pour que le code soit lisible et au norme du code existant.

### L’organisation

Il faut savoir qu' en tant que développeur et contrairement à ce que tout le monde croit, nous codons peu. En réalité, des études ont démontrées que nous passons en moyenne 3⁄4 de notre temps à lire du code, et très souvent c’est du code que nous avons écrit nous même.

En dehors du fait que cela simplifie la lecture de votre code par d’autres personnes, une bonne raison d’essayer de coder proprement, c’est qu’à long terme vous gagnerez un temps fou, vous éviterez les bugs incompréhensibles et vous y prendrez goût !

Quand on lis du code, on doit pouvoir faire abstraction de ce que contiennent certaines fonctions et variables pour aller plus vite à l’essentiel. C'est pourquoi il faut bien nommer les choses, être explicite dans les noms de sorte à savoir ce qu'une variable ou une fonction renvoie.

Par exemple, la fonction `getTaskAuthorRole()` est assez explicite sur ce qu’elle doit renvoyer, pas besoin d’aller regarder ce qu’elle fait pour comprendre qu’elle nous donne le rôle de l’auteur d’une tâche.

Cette règle devient simple quand on ne fait pas des fonctions trop longues, une fonction ne doit à priori faire qu'une seule chose et le faire bien.

### Le nettoyage

Il faut au maximum éviter les déchets dans le code, tels que les commentaires de debug, ou les commentaires d’explications. En règle générale, si vous devez commenter pour expliquer un bout de code, ça signifie que votre code peut être amélioré. Il ne faut pas compenser du mauvais code par un commentaire.

___

# Comment contribuer

## Faites un fork du répertoire

Cela va créer une copie du répertoire sur votre compte.

## Clonez ce répertoire

<img align="right" width="300" src="https://firstcontributions.github.io/assets/Readme/clone.png" alt="clonez ce répertoire" />

Maintenant, clonez le répertoire que vous venez de forker

Ouvrez un invite de commande et exécutez les commandes git suivantes :

```
git clone "l'url que vous venez de copier"
```

Par exemple :

```
git clone https://github.com/votre-nom-d-utilisateur/Todo-Co.git
```

## Créez une branche

Déplacez-vous dans le répertoire du projet nouvellement cloné (si vous n'y êtes pas encore) :

```
cd Todo-Co
```

Maintenant créez et basculez sur une branche avec le commande  :

```
git checkout -b <votre-branche>
```


## Effectuez les modifications nécessaires et engagez-les

Maintenant, vous pouvez commencez à coder. Ajoutez vos modifications à la branche que vous venez de créer avec la commande  `git add` .


Puis, vous pouvez engagez ces modifications avec la commande `git commit`:


## Poussez les modifications vers GitHub

Poussez vos modifications avec la commande `git push` :

```
git push origin <votre-branche>
```


## Soumettez vos changements pour révision

Si vous visitez votre répertoire sur Github, vous verrez un bouton  `Compare & pull request`. Cliquez sur ce bouton.


Maintenant soumettez la demande de pull request.


La branche master de votre embranchement ne subira pas de modification à cet instant. Pour que votre embranchement soit synchronisé avec celui du repo, suivez les étapes suivantes.

## Gardez votre embranchement synchronisé avec ce répertoire

D'abord, basculez sur la branche master

 ```
 git checkout master
 ```

Et ajouter l'url de mon répertoire comme  `upstream remote url` :

```
git remote add upstream https://github.com/Thierry-Kq/Todo-Co
```

Ceci est une manière de dire à git qu'une autre version de ce répertoire existe à l'adresse spécifiée et que nous l'appelons  `upstream`. Une fois les modifications fusionnées, cherchez la nouvelle version de mon répertoire :

```
git pull upstream
```

Ici nous cherchons toutes les modification dans mon embranchement  (upstream remote) et nous appliquons toutes les modifications que vous avez cherché à la branche master. Si vous poussez la branche master maintenant, votre embranchement aussi aura les modifications :

```
git push origin master
```

Avertissement: Cette fois, vous poussez au répertoire distant appelé origin.

Une fois que la pull request est validée, votre branche `<votre-branche>` n'est plus utile, donc vous pouvez la supprimer :

```
git branch -d <votre-branche>
```

et vous pouvez supprimer sa version dans le répertoire distant aussi :

```
git push origin --delete <votre-branche>
```

  
