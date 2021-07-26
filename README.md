# ToDoList

### Projet pour le P8 du parcours Developpeur PHP/Symfony avec [Openclassrooms](https://openclassrooms.com/projects/ameliorer-un-projet-existant-1).

___

<div align="center">
  <img src="https://user.oc-static.com/upload/2016/11/18/14794830624591_shutterstock_318837722.jpg">
</div>

___


## Comment contribuer ?

* Pour commencer à contribuer, suivez [le guide de contribution](CONTRIBUTING.md).

___
## Comment installer le projet ?

```
git clone https://github.com/Thierry-Kq/Todo-Co.git
cd Todo-Co
composer install
symfony serve -d
```

Vous devrez configurer un accès à une database locale ou distante dans un fichier .env à la racine du projet (voir format du .env). Vous pouvez ensuite créer la database et lancer les fixtures avec les commande :

```
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
```

Pour essayer l'application, voici la liste des utilisateurs/password créés avec les fixtures :

``` 
$users = ['azerty', 'admin', 'kasskq', 'userWithoutTask', 'noob'];
$password = 'azerty';
```

___

### - Lancer les tests

Pour lancer les tests, vous devez au préalable créer une base de donnée de test avec le Makefile, vous pouvez créer un fichier .env.local.test avec seulement la valeur `DATABASE_URL` . Ensuite :

```
make fixtures_tests
bin/phpunit
```

___

### - Lien [Codacy](https://app.codacy.com/gh/Thierry-Kq/Todo-Co/dashboard?branch=master)







