<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

PROJETO
-------------------

API para cadastro de produtos e listagem de categorias.


REQUERIDO 
------------

PHP 7.4 / MySQL

CONFIGURAÇÃO
-------------

### Database

Editar o arquivo `config/db.php` com o banco de dados:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```


EXECUÇÃO DO PROJETO
------------
~~~
composer update  
~~~
~~~
php yii migrate
~~~
~~~
php -S localhost:8080 -t web
~~~

