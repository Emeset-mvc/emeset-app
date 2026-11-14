# Emeset
 
## El framework per estudiants de 2n DAW.

Versió amb frontcontroller del "Framework" Emeset. 

> Resumint Emeset implementa un FrontController que rep una petició HTTP, executa el controlador adequat i retorna una resposta HTTP.

## Instal·lació

Per crear un projecte amb Emeset cal tenir instal·lats PHP 8.4 o superior i el gestor de paquets [Composer](https://getcomposer.org/).

```bash
$ composer create-project emeset/emeset app
```
Ens crearà un nou projecte a la carpeta app amb totes les dependències instal·lades.

## Aplicació mínima

La mínima expressió d’una aplicació amb Emeset, seria el següent exemple.

```php

<?php

include "../vendor/autoload.php";

$contenidor = new \Emeset\Container([]);

$app = new \Emeset\Emeset($contenidor);

$app->route("", function(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response {
    $response->setBody("Hola món!");
    return $response;
});

$app->execute();

```

Aquesta “aplicació“ saludarà efusivament a qui faci una petició GET, però anem per passos.

```php
include "../vendor/autoload.php";
```
En el primer pas incloem l’autoload de composer. Composer no només ens permet instal·lar llibreries de tercers, també ens gestiona automàticament les dependències de la nostra aplicació, assegurant que podem utilitzar qualsevol classe de les llibreries que hem instal·lat sense haver de preocupar-nos d’afegir cap línia include ni require.

```php
$contenidor = new \Emeset\Container([]);
```
Creem un contenidor,  el contenidor és el responsable d’inicialitzar els diferents objectes que utilitza l’aplicació. El constructor rep com a paràmetre la configuració de l’aplicació, com aquesta és una aplicació mínima li passem un array buit.

```php
$app = new \Emeset\Emeset($contenidor);
```

Per inicialitzar l’aplicació creem un objecte Emeset, passem com paràmetre un contenidor, l’aplicació el necessitarà per obtenir els diferents objectes amb els que treballarà.

```php
$app->route("", function(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response {
    $response->setBody("Hola món!");
    return $response;
});
```

Un cop creat l’objecte Emeset ens permet definir les rutes i definir quins controladors s’executaran. Els controladors han de ser “callables”, o sigui, poden ser funcions anònimes, funcions o mètodes de classes.

En aquest exemple hem utilitzat una funció anònima, però tenim altres opcions.

```php
$app->route("validar-login", "ctrlValidarLogin"); // el controlador és una funció
$app->route("privat", "\Controladors\CtrlPrivat:privat"); // el controlador és un mètode d’una classe
```

Podem utilitzar funcions o mètodes de classes, de fet utilitzar classes és el més recomanable.

```php
$app->execute();
```

Finalment, un cop hem definit totes les rutes, podem executar l’aplicació. Així processarem la petició HTTP i acabarem executant el controlador que toqui per acabar generant una resposta HTTP.

## Arquitectura d’una aplicació

L’estructura mínima no és massa pràctica per desenvolupar aplicacions. Amb la instal·lació que fa el composer ens crea una estructura de directoris per organitzada per poder crear les nostres aplicacions.

Un cop instal·lada l’aplicació tenim la següent estructura de carpetes.

```
├── App
│   ├── Commands
│   ├── Container.php
│   ├── Controllers
│   ├── Middleware
│   ├── config.php
│   ├── css
│   ├── js
│   └── Views
├── public
└── vendor
```

La carpeta `App` conté el codi de l’aplicació: configuració, contenidor, controladors, middleware, vistes, CSS i JavaScript.
Els fitxers font de CSS i JavaScript es desen a `App/css` i `App/js`. Els canvis que hi fem es processen amb Vite: `App/js/index.js` és el punt d’entrada del JavaScript i importa el CSS de `App/css/main.css`. Vite genera els fitxers compilats `public/js/bundle.js` i `public/main.css`, que són els que carrega el navegador. Per regenerar-los manualment, executem `npm run build`; amb `npm run watch`, es regeneren quan canvien els fitxers font.
El fitxer `App/js/hola.js` mostra com importar Day.js per donar format a la data actual en català.
La carpeta `public` és l’arrel pública del servidor i conté el front controller `index.php` i els recursos compilats.


## Configuració

El contenidor rep la configuració en construir-lo. En aquest projecte, el punt d'entrada li passa `App/config.php`.

Així podem accedir als paràmetres de configuració amb `$contenidor->get("config")` o `$contenidor["config"]`.

```php
<?php

return [
    /* configuració de connexió a la base dades */
    /* Path on guardarem el fitxer sqlite */
    "sqlite" => [
        "path" => Emeset\Env::get("sqlite_path", "../"),
        "name" => Emeset\Env::get("sqlite_name", "db.sqlite")
    ],
    /* Nom de la cookie */
    "cookie" => [
        "name" => Emeset\Env::get("cookie_name", 'visites')
    ],
    "login" => [
        "usuari" => Emeset\Env::get("login_usuari", "dani"),
        "clau" => Emeset\Env::get("login_clau", "1234")
    ],
];
```

La funció Emeset\Env::get ens permet llegir els paràmetres de configuració de les variables d'entorn o dels paràmetres que trobi al fitxer .env de l'arrel del projecte.

El primer paràmetre és la variable que volem consultar i el segon el valor que utilitzarem per defecte en el cas que la variable no estigui definida.

Exemple de fixer .env.
```
sqlite_path = "../"
sqlite_name = "tasks.db"
login_clau = "Una altra clau"
```


## Router (Encaminador)

L’encaminador és el responsable de decidir quin controlador s’ha d’executar en funció de la petició rebuda. Emeset incorpora `RouterHttp` com a encaminador per defecte. També conserva `RouterParam` per compatibilitat amb EmesetLite.

### Encaminador HTTP (\Emeset\Routers\RouterHttp)

Aquest encaminador utilitza la llibreria d’encaminament [FastRoute](https://github.com/nikic/FastRoute#readme). Amb aquest encaminador farem servir el mètode HTTP i el path de la petició per determinar quin controlador s’ha d’executar.

Els mètodes per definir rutes accepten tres paràmetres.
$id: Cadena que identifica la ruta.
$callback: funció o mètode del controlador.
$middleware: funció o array de funcions de middleware. Aquest paràmetre és opcional.


```php
// Aquest mètode serveix per mantenir la compatibilitat amb el RouterParam, defineix la mateixa ruta per les peticions GET i POST. 
public function route(string|int $id, mixed $callback, mixed $middleware = false): void;
public function get(string|int $id, mixed $callback, mixed $middleware = false): void;
public function post(string|int $id, mixed $callback, mixed $middleware = false): void;
public function put(string|int $id, mixed $callback, mixed $middleware = false): void;
public function delete(string|int $id, mixed $callback, mixed $middleware = false): void;
public function head(string|int $id, mixed $callback, mixed $middleware = false): void;
```

#### Les rutes

Amb l’encaminador HTTP podem passar informació fent servir el path de la ruta.

Per exemple podem definir una ruta que saludi pel nom.

```php
$app->get("/hola/{id}", function (\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response {
    $id = $request->getParam("id");
    $response->setBody("Hola {$id}!");
    return $response;
});
```

Així si estem executant la nostra aplicació a localhost:8080 amb la següent url http://localhost:8080/hola/Dani

obtindrem:

“Hola Dani!”

Aquí pots trobar la documentació de com podem definir rutes amb paràmetres. (Defining routes)[https://github.com/nikic/FastRoute#defining-routes].

### Encaminador per paràmetre (\Emeset\Routers\RouterParam)

Aquest encaminador conserva el comportament d’EmesetLite: decideix quin controlador executar a partir del paràmetre `r` de `$_REQUEST`. El contenidor base instal·la `RouterHttp`; per utilitzar `RouterParam`, cal substituir el servei `router` en un contenidor propi:

```php
namespace App;

use Emeset\Container as EmesetContainer;
use Emeset\Routers\RouterParam;

class Container extends EmesetContainer
{
    public function __construct(array|string $config)
    {
        parent::__construct($config);

        $this["router"] = function (EmesetContainer $container): RouterParam {
            return new RouterParam($container, $container["config"]);
        };
    }
}
```

Les rutes es defineixen amb els mateixos arguments que amb `RouterHttp`:

```php
$app->get("", "ctrlPortada"); // el controlador és una funció
$app->get("login", "\App\Controllers\Login:index"); // el controlador és un mètode d’una classe
```

## Controladors

El controlador ha de ser un element “callable” que rep objectes que implementen `\Emeset\Contracts\Http\Request`, `\Emeset\Contracts\Http\Response` i `\Emeset\Contracts\Container`, i retorna una resposta que implementa `\Emeset\Contracts\Http\Response`.

Així els controladors reben tota la informació de la petició HTTP encapsulada en l'objecte petició, tracten aquesta informació, accedeixen a la informació que els cal utilitzant els diferents models i escriuen la informació de sortida a l'objecte resposta.

Els controladors no han d'accedir directament a la informació, d'això s'encarreguen els models, ni han de generar cap sortida, d'això s'encarrega la resposta. La seva responsabilitat és crear una resposta en funció de la informació d'entrada fent servir els models per accedir a les dades de l'aplicació.

```php
function ctrlIndex(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response {

    $response->setTemplate("index.php");

    return $response;
    
} 
```

### Definir controladors amb classes

Podem fer servir els mètodes d'una classe com a controladors, això ens permet agrupar en una mateixa classe controladors relacionats (un CRUD per exemple) i organitzar el codi millor definint mètodes que es puguin reutilitzar entre els diferents controladors relacionats.

```php
<?php

/**
 * Controlador de la zona privada de l'exemple del Framework Emeset
 * Framework d'exemple per a M07 Desenvolupament d'aplicacions web.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Carrega la zona privada de l'exemple.
 *
 **/

namespace App\Controllers;

use \Emeset\Contracts\Container;

class Privat
{

    public Container $contenidor;

    public function __construct(Container $contenidor)
    {
        $this->contenidor = $contenidor;
    }

    /**
     * ctrlPortada: Controlador que carrega  la zona privada de l'exemple.
     *
     * @param \Emeset\Http\Request $request contingut de la peticó http.
     * @param \Emeset\Http\Response $response contingut de la response http.
     * @param \Emeset\Container  $container contenidor de dependències.
     *
     **/
    public function privat(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response
    {
        $missatge = "Benvingut a la zona privada!";
        
        $response->set("missatge", $missatge);
        $response->SetTemplate("privat.php");

        return $response;
    }
}
```

Per definir una ruta amb un controlador que és un mètode d’una classe utilitzarem la següent sintaxi.

```php
$app->get("privat", "\App\Controllers\Privat:privat");
```

Utilitzant controladors definits amb classes ens permet aprofitar dues noves funcionalitats del framework, per una banda, l’autocarrega de classes i per l’altra controlar la injecció de dependències als nostres controladors.

### Autocarrega de classes (Autoload)

Amb PHP podem definir funcions que s'executaran si intentemt instanciar una classe que no tenim disponible i això permet realitzar les accions necessàries perquè la classe passi a estar disponible, es coneix com el mecanisme d’autocarrega (autoload en anglès), és molt útil per què ens evita haver de fer llistats interminables d’includes i haver de mantenir-los. [Autoloading classes](https://www.php.net/manual/en/language.oop5.autoload.php)

Però com estem fent servir composer,  tot plegat és encara més senzill. En el fitxer composer.json podem definir un esquema d’autocarrega i el mateix composer ens generarà un "autoloader" per el nostre projecte.

```json
{
  "autoload": {
        "psr-4": {"App\\": "App/"}
    }
}
```

Amb aquest bloc estem indicant a composer que volem fer servir un esquema d’autocarrega [PSR-4](https://www.php-fig.org/psr/psr-4/). Amb aquest esquema si tenim el següent codi:

```php
$privat = new \App\Controllers\Privat($contenidor);
```
Si la classe `\App\Controllers\Privat` no està definida, Composer la buscarà al fitxer `App/Controllers/Privat.php`.

Així que seguint la convenció de nomenclatura PSR-4 ens podem oblidar d’estar escrivint un include per cada controlador que fem servir, sempre que els definim com a classes seguint la nomenclatura establerta per la convenció PSR-4.

### Injecció de dependències.

Emprar el contenidor dins del controlador és una manera àgil d’accedir a les seves dependències, però fa que sigui molt complicat determinar quines dependències té un controlador en concret. Quan treballem amb classes podem injectar explícitament les dependències al controlador amb el seu constructor.

Per l’exemple anterior 

```php
$app->route("privat", "\App\Controllers\Privat:privat");
```

En el nostre projecte podem estendre el contenidor.

```php
namespace App;

use Emeset\Container as EmesetContainer;

class Container extends EmesetContainer {

    public function __construct(array|string $config){
        parent::__construct($config);
        
        $this["\App\Controllers\Privat"] = function (EmesetContainer $c): \App\Controllers\Privat {
            // Aqui podem inicialitzar totes les dependències del controlador i passar-les com a paràmetre.
            return new \App\Controllers\Privat($c);
        };
    }
}
```

El ruter quan detecta que el controlador està definit en el contenidor el recupera directament d’aquest, aquí podem inicialitar totes les depedències i injectar-les explicatament al controlador.

## Middleware
Les funcions middleware embolcallent els controladors, això ens permet executar codi abans o després del codi del controlador.

Les funcions middleware tenen quatre paràmetres.

```php
function auth(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container, mixed $next): \Emeset\Contracts\Http\Response
```
$request:  Objecte que implementa \Emeset\Contracts\Http\Request
$response: Objecte que implementa \Emeset\Contracts\Http\Response
$container: Objecte que implementa \Emeset\Contracts\Container
$next: següent controlador o llista de middleware/controladors que queden per executar.

Exemple de middleware
```php
function test(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container, mixed $next): \Emeset\Contracts\Http\Response
{

    // aquí podem executar codi abans de cridar el següent middleware o el controlador
    $response = \Emeset\Middleware::next($request, $response, $container, $next); // Aquí cridem al següent middleware o el controlador.
     // aquí podem executar codi després de cridar el següent middleware o el controlador	
    return $response;
}
```

El mètode `Emeset\Middleware::next` gestiona quin és el següent element en la llista d'execució de la ruta actual. Això permet encadenar diversos middleware en una ruta.

La funció global `nextMiddleware()` encara existeix per compatibilitat, però està marcada com a obsoleta i es retirarà a la versió 1.0; als exemples nous fem servir `Emeset\Middleware::next()`.

```php
public static function next(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container, mixed $next): \Emeset\Contracts\Http\Response
```

- $request:  Objecte que implementa \Emeset\Contracts\Http\Request
- $response: Objecte que implementa \Emeset\Contracts\Http\Response
- $container: Objecte que implementa \Emeset\Contracts\Container
- $next: següent controlador o llista de middleware/controladors que queden per executar.

### Com utilitzar el middleware?

El middleware el podem utilitzar en rutes concretes o  per tota l'aplicació.

### Middleware per rutes

Quan definim una ruta podem indicar que abans d'executar el controlador executi un o més middlewares.

Si el middleare és una funció

```php
$app->get("privat", [\App\Controllers\Privat::class, "privat"], ["auth"]);
```

Podem definir més d'un middleware per ruta. S'executaran d'esquerra a dreta.

```php
$app->get("privat", [\App\Controllers\Privat::class, "privat"], ["auth", "isAdmin"]);
```

Per aprofitar les funcions d'autoload podem utilitzar classes per definir middlewares


```php
$app->get("privat", [\App\Controllers\Privat::class, "privat"], [[\App\Middleware\App::class, "auth"]]);
$app->get("privat", [\App\Controllers\Privat::class, "privat/admin"], [[\App\Middleware\App::class, "auth"], [\App\Middleware\App::class, "isAdmin"]]);
```

### Middleware global de l'aplicació
Es pot definir middleware global de l'aplicació amb el mètode de la classe Emeset, middleware.

```php
$contenidor = new \App\Container(__DIR__ . "/../App/config.php");

$app = new \Emeset\Emeset($contenidor);
$app->middleware([\App\Middleware\App::class, "execute"]);
```

El middleware d'aplicació té la mateixa estructura que el middleware de qualsevol ruta. El FrontController és un controlador com els altres, l'única diferència és que és el controlador encarregat de decidir quin controlador ha de gestionar la petició actual. 

## La petició (\Emeset\Http\Request)

Un objecte de la classe \Emeset\Http\Request encapsula tota la petició HTTP.

```php

// Obtindrà el paràmetre r de GET i escaparà els caràcters especials.
$r = $request->get(INPUT_GET, "r");  

// Obtindrà el paràmetre r de POST i escaparà els caràcters especials.
$r = $request->get(INPUT_POST, "r"); 

// Obtindrà la cookie r sense filtrar.
$r = $request->getRaw(INPUT_COOKIE, "r");

// Obtindrà el valor de sessió r. Les dades de sessió no s'escapen automàticament.
$r = $request->get("SESSION", "r"); 

// Obtindrà el fitxer file de $_FILES.
$r = $request->get("FILES", "file"); 

// Obtindrà el paràmetre r de $_REQUEST.
$r = $request->get("INPUT_REQUEST", "r"); 

//Si no volem escapar els caràcters especials podem utilitzar el mètode getRaw();
$r = $request->getRaw(INPUT_GET, "r");  // obtindrà el paràmetre r de la petició GET.

// obtindrà el paràmetre id de la ruta. Només és vàlid amb l’encaminador HTTP.
$r = $request->getParam("id"); 
```

## La resposta (\Emeset\Http\Response)

Un objecte de la classe \Emeset\Http\Response encapsula tota la resposta HTTP.

La resposta encapsula la resposta HTTP, això inclou les cookies, redireccions, capçaleres i variables de sessió (encara que no formin part realment de la resposta HTTP).

El contenidor crea la resposta i la vista per defecte. La classe `\Emeset\Http\Response` rep un objecte `\Emeset\Contracts\Views\Views` al constructor. La vista PHP per defecte cerca plantilles a `../App/Views/`.

El mètode set ens permet injectar informació a la vista i el mètode setTemplate ens permet definir quina plantilla volem utilitzar per la vista.

### Plantilles

```php
$response->set("nom", $nom);
$response->setTemplate("fitxa.php");
```

Les plantilles de les vistes han de ser fitxers PHP, a les vistes només hi ha d'haver codi relacionat amb la visualització, és la seva única responsabilitat.

Amb l'exemple anterior la plantilla podria visualitzar el nom.

```html
<html>
<body>
<?=$nom;?>
</body>
</html>
```

### Capçaleres HTTP

Podem afegir informació a la capçalera de respota HTTP.

```php
$response->setHeader("HTTP/1.1 404 Not Found");
```

### Redireccions

La resposta en alguns casos pot ser una redirecció. Així podem indicar al navegador que carregui una altra pàgina.

```php
$response->redirect("location: index.php?r=login");
```

### Sessió

La resposta ens permet desar informació a la sessió, el PHP ens permet fer-ho directament, però amb el Framework Emeset està encapsulat a l'objecte resposta per unificar l'accés a la informació i així reforçar el concepte que un controlador rep informació d'entrada (la petició) i retorna la informació de sortida amb l’objecte resposta.

```php
// Quedarà desat a la sessió i podrem consultar en les pròximes consultes.
$response->setSession("error", "Missatge d'error");  
```

Si volem esborrar un valor de la sessió podem utilitzar el mètode `unsetSession($id)`.

```php
// Esborrarà l'entrade error de la sessió
$response->unsetSession("error");  
```


### Cookies

El métode setCookie()  mapeja la petició a la funció [setcookie](https://www.php.net/manual/es/function.setcookie.php) de PHP amb els mateixos paràmetres.

```php
public function setCookie(string $name, string $value = "", int $expire = 0, string $path = "", string $domain = "", bool $secure = false, bool $httponly = false): void
```

Per exemple:
```php
$response->setCookie("contador", $contador);
```

### Resposta en format JSON

Si volem generar una resposta en format JSON podem utilitzar el mètode `setJSON()`. Per defecte la resposta codifica tots els valors afegits amb `set()`.

```php
// Generarà la sortida en format JSON.
$response->set("result","ok" ); 
$response->setJSON();
```
La sortida seria
```json
{"result":"ok"}
```

### Resposta directa

L’objecte Resposta ens permet generar una resposta directament, amb el mètode setBody($body).

```php
$response->setBody("Hola món!");
```


# Contenidor (Container)
El contenidor gestiona les dependències del projecte. Emeset estén Pimple i hi registra els serveis bàsics que necessita l'aplicació.

Per defecte el contenidor ja té definit com instanciar els diferents objectes necessaris per fer funcionar l’aplicació mínima.

```php
$config = $contenidor->get("config"); // recuperem la configuració
$request = $contenidor->get("request"); // Retorna una instància de l’objecte request.
```

Si volem afegir o sobreescriure definicions en el contenidor el que hem de fer és definir una classe que extengui la classe \Emeset\Container.

```php

<?php


namespace App;

use Emeset\Container as EmesetContainer;

class Container extends EmesetContainer {

    public function __construct(array|string $config){
        parent::__construct($config);

        /* Podem definir com s’han d’instanciar els diferents models. */
        $this["user"] = function ($c) {
            return new \App\Model\User($c->get("db"));
        };

        /* Si definim una entrada per la classe d’un controlador s’utilitzarà aquest codi
           per instanciar-la, això ens permet gestionar les depedències específiques de
           cada controlador. */
        $this["\App\Controllers\Privat"] = function (EmesetContainer $c): \App\Controllers\Privat {
            // Aqui podem inicialitzar totes les dependències del controlador i passar-les com a paràmetre.
            return new \App\Controllers\Privat($c);
        };

        /* També podem sobreescriure definicions del contenidor base per així
            personalitzar el comportament de la nostra aplicació. */
        $this["request"] = function ($c) {
            return new \ElMeuRequest($c);
        };

    }
}
```

Un cop definit el contenidor,  el podem utilitzar en qualsevol controlador o middleware.

```php
$user = $contenidor->get("user");  // Retorna una instància de l’objecte user.
```

# Eines frontend (Tooling)

Emeset és agnòstic respecte a les eines de frontend. L’aplicació base utilitza CSS propi, Vite per empaquetar els recursos i Vitest per executar els tests.

Per poder utilitzar aquestes eines ens cal tenir instal·lat [node](https://nodejs.org/en/).

Per instal·lar totes les dependències necessaries:

```bash
$ npm install
```

Un cop tenim instal·lades les dependències, podem executar les diferents eines.

- npm run build -> genera `public/main.css` i `public/js/bundle.js` amb Vite.
- npm run watch -> regenera els fitxers quan canvien els recursos d'entrada.
- npm run start -> inicia el servidor PHP a localhost:8000 i observa els canvis amb Vite.
- npm run prod -> genera els fitxers optimitzats per a producció.
- npm run test -> executa amb Vitest els fitxers de prova `*.test.js`.
- npm run test:watch -> executa Vitest i torna a provar els fitxers quan detecta canvis.

Si els fitxers tenen l'extensió .ts seran transpilats de TypeScript a Javascript.




#FpInfor #DawMp07 #DawMp07Uf01 #DawMp07Uf02 #DawMp07Uf03 #DawMp07Uf04
