# MenuElement
Este componente nos ayuda a crear elementos de un menú, agregándole una clase de CSS extra si estamos ubicados en la misma ruta a la que se está apuntando el link.

Esto ha sido creado a modo de ejercicio y por lo mismo es de uso público y se aceptan todo tipo de opiniones y comentarios.

La clase base utilizada por los íconos es `glyphicon`, la misma que utiliza [Bootstrap](http://getbootstrap.com/), pero que se puede cambiar al generar el archivo de configuración local
## Instalación
### Paso 1: Instalación a través de composer
```bash
composer require "catalejo/menuelement":"dev-master"
```
### Paso 2: Agregar el ServiceProvider
En el archivo `config/app.php` agregar:
```php
...
'providers' => [
    'Catalejo\MenuElement\MenuElementServiceProvider',
],
...
```
### Paso 3: Generar los archivos de configuración local
```bash
php artisan vendor:publish --force
```
Al hacer esto, se copia un archivo de configuración desde el paquete a la ruta `/config/menuelement.php`
## Ejemplos
En una vista o partials, en donde se tenga un menu de navegación, utilicen esto:
```html
<ul>
    {{ MenuElement::make('home_path','HOME', ['icon' => 'glyphicon-home']) }}
    {{ MenuElement::make('contact_path','Contacto', ['icon' => 'glyphicon-envelope']) }}
</ul>
```
Si tenemos definidas estas rutas:
```php
Route::get('home', [
    'as' => 'home_path',
    'uses' => 'HomeController@index'
]);
Route::get('contacto', [
    'as' => 'contact_path',
    'uses' => 'ContactController@index'
]);
``` 
Y si estamos ubicados en el `home`, ésto da como resultado:
```html
<ul>
    <li class="active"><a href="http://app.dev"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>HOME</a></li>
    <li class=""><a href="http://app.dev/contacto"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Contacto</a></li>
</ul>
```
