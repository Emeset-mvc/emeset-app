# Emeset
 
## El framework per estudiants de 2n DAW.

Versió amb frontcontroller del "Framework" Emeset. 

> Resumint Emeset implementa un FrontController que rep una petició HTTP, executa el controlador adequat i retorna una resposta HTTP.

## Instal·lació

Per crear un projecte amb Emeset ens cal tenir instal·lat el gestor de paquets [composer](https://getcomposer.org/). 

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

$app->route("", function($request, $response, $container){
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
$app->route("", function($request, $response, $container){
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
│   ├── Controllers
│   ├── css
│   ├── Middleware
│   ├── Models
│   └── Views
├── cli
├── public
└── vendor
```

La carpeta App té la major part del codi de l’aplicació. 
La carpeta Controllers és on desem tots els controladors.
La carpeta css és on desem els fitxers css abans de processar, cal instal·lar el PostCSS.
La carpeta js és on desem els fitxers js abans de processar, cal instal·lar el Webpack per poder-ho fer.
La carpeta Middleware és on desem les diferents funcions Middleware.
La carpeta Views és on desem les vistes del projecte.

La carpeta cli la utilitzem per desar els scripts relacionats amb la inicialització i manteniment del projecte.

La carpeta public té tots els continguts públics del projecte, entre ells el fitxer index.php o  definim totes les rutes.

## Configuració

Quan inicialitzem el framework carrega el fitxer de configuració /App/config.php dins del contenidor.

Així podem accedir als paràmetres de configuració amb $contenidor["config"] en qualsevol punt de l'aplicació.

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

L’encaminador és el responsable de decidir quin controlador s’ha d’executar en funció de la petició rebuda. El framework incorpora dos encaminadors diferents:

\Emeset\Router\RouterParam
\Emeset\Router\RouterHttp

El RouterParam funciona fent servir el paràmetre r, que pot rebre per GET o POST. En funció del valor que tingui r escollirà quin controlador s’ha d’executar.

El RouterHTTP fa servir el mètode HTTP i l’URL de la petició per determinar quin controlador s’executa. En el servidor cal tenir activat el mod_rewrite.

### Encaminador per paràmetre (\Emeset\Router\RouterParam)
L’encaminador determina quin controlador s’ha d’executar a partir del paràmetre r. 

Els mètodes per definir rutes accepten tres paràmetres.
$id: Cadena que identifica la ruta.
$callback: funció o mètode del controlador.
$middleware: funció o array de funcions de middleware. Aquest paràmetre és opcional.

```php
// Aquest mètode permet definir una ruta i vincular-hi un controlador i el middleware que li pertoqui. 
public function route($id, $callback, $middleware = false);
```

Alguns exemples de rutes definides amb l’encaminador.

```php
$app->route("", "ctrlPortada"); // el controlador és una funció
$app->route("login", "\App\Controllers\Login:index"); // el controlador és un mètode d’una classe.
```

### Encaminador HTTP (\Emeset\Router\RouterHTTP)

Aquest encaminador utilitza la llibreria d’encaminament [FastRoute](https://github.com/nikic/FastRoute#readme). Amb aquest encaminador farem servir el mètode HTTP i el path de la petició per determinar quin controlador s’ha d’executar.

Els mètodes per definir rutes accepten tres paràmetres.
$id: Cadena que identifica la ruta.
$callback: funció o mètode del controlador.
$middleware: funció o array de funcions de middleware. Aquest paràmetre és opcional.


```php
// Aquest mètode serveix per mantenir la compatibilitat amb el RouterParam, defineix la mateixa ruta per les peticions GET i POST. 
public function route($id, $callback, $middleware = false);
public function get($id, $callback, $middleware = false);
public function post($id, $callback, $middleware = false);
public function put($id, $callback, $middleware = false);
public function delete($id, $callback, $middleware = false);
public function head($id, $callback, $middleware = false);
```

#### Les rutes

Amb l’encaminador HTTP podem passar informació fent servir el path de la ruta.

Per exemple podem definir una ruta que saludi pel nom.

```php
$app->get("/hola/{id}", function ($request, $response) {
    $id = $request->getParam("id");
    $response->setBody("Hola {$id}!");
    return $response;
});
```

Així si estem executant la nostra aplicació a localhost:8080 amb la següent url http://localhost:8080/hola/Dani

obtindrem:

“Hola Dani!”

Aquí pots trobar la documentació de com podem definir rutes amb paràmetres. (Defining routes)[https://github.com/nikic/FastRoute#defining-routes].

## Controladors

El controlador ha de ser un element “callable” que ha de tenir com a paràmetres d’entrada un objecte \Emeset\Request, un objecte \Emeset\Response i un objecte \Emeset\Container i ha de retornar com a resultat un objecte \Emeset\Response.

Així els controladors reben tota la informació de la petició HTTP encapsulada en l'objecte petició, tracten aquesta informació, accedeixen a la informació que els cal utilitzant els diferents models i escriuen la informació de sortida a l'objecte resposta.

Els controladors no han d'accedir directament a la informació, d'això s'encarreguen els models, ni han de generar cap sortida, d'això s'encarrega la resposta. La seva responsabilitat és crear una resposta en funció de la informació d'entrada fent servir els models per accedir a les dades de l'aplicació.

```php
function ctrlIndex($request, $response, $container){

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

class Privat
{

    public $contenidor;

    public function __construct($contenidor)
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
    public function privat($request, $response, $container)
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
$app->route("privat", "\App\Controllers\Privat:privat");
```

Utilitzant controladors definits amb classes ens permet aprofitar dues noves funcionalitats del framework, per una banda, l’autocarrega de classes i per l’altra controlar la injecció de dependències als nostres controladors.

### Autocarrega de classes (Autoload)

Amb PHP podem definir funcions que s'executaran si intentemt instanciar una classe que no tenim disponible i això permet realitzar les accions necessàries perquè la classe passi a estar disponible, es coneix com el mecanisme d’autocarrega (autoload en anglès), és molt útil per què ens evita haver de fer llistats interminables d’includes i haver de mantenir-los. [Autoloading classes](https://www.php.net/manual/en/language.oop5.autoload.php)

Però com estem fent servir composer,  tot plegat és encara més senzill. En el fitxer composer.json podem definir un esquema d’autocarrega i el mateix composer ens generarà un "autoloader" per el nostre projecte.

```json
   "autoload": {
        "psr-4": {"App\\": "App/"}
    }
```

Amb aquest bloc estem indicant a composer que volem fer servir un esquema d’autocarrega [PSR-4](https://www.php-fig.org/psr/psr-4/). Amb aquest esquema si tenim el següent codi:

```php
$privat = new \App\Controller\Privat($container);
```
Si la classe \App\Controller\Privat no està definida el mecanisme d’autocarrega del Composer la buscarà al fitxer Privat.php de la carpeta ./App/Controller/.

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

    public function __construct($config){
        parent::__construct($config);
        
        $this["\App\Controllers\Privat"] = function ($c) {
            // Aqui podem inicialitzar totes les dependències del controlador i passar-les com a paràmetre.
	        $usuaris = $c->get("usuaris");
            return new \App\Controllers\Privat($usuaris);
        };
    }
}
```

El ruter quan detecta que el controlador està definit en el contenidor el recupera directament d’aquest, aquí podem inicialitar totes les depedències i injectar-les explicatament al controlador.

## Middleware
Les funcions middleware embolcallent els controladors, això ens permet executar codi abans o després del codi del controlador.

Les funcions middleware tenen quatre paràmetres.

```php
function auth($request, $response, $container, $next)
```
$request:  Objecte de tipus \Emeset\Http\Request
$response: Objecte de tipus \Emeset\Http\Response
$container: Objecte de tipus \Emeset\Container
$next: Callable del següent middleware o controlador.

Exemple de middleware
```php
function test($request, $response, $config, $next)
{

    // aquí podem executar codi abans de cridar el següent middleware o el controlador
    $response = nextMiddleware($request, $response, $config, $next); // Aquí cridem al següent middleware o el controlador.
     // aquí podem executar codi després de cridar el següent middleware o el controlador	
    return $response;
}
```

La funció nexMiddleware gestiona quin és el següent element en la llista d'execució de la ruta actual, és el que ens permet afegir més d'una middleware en una ruta.

```php
function nextMiddleware($request, $response, $container, $next)
```

- $request:  Objecte de tipus \Emeset\Http\Request
- $response: Objecte de tipus \Emeset\Http\Response
- $container: Objecte de tipus \Emeset\Container
- $next: Callable del següent middleware o controlador.

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

// obtindrà el paràmetre r de la petició GET i escaparà els caràcters especials.
$r = $request->get(INPUT_GET, "r");  

// obtindrà el paràmetre r de la petició POST i escaparà els caràcters especials.
$r = $request->get(INPUT_POST, "r"); 

// obtindrà el paràmetre r de la petició GET.
$r = $request->getRaw(INPUT_COOKIES, "r");  

// obtindrà el paràmetre r de la sessió i escaparà els caràcters especials.
$r = $request->get("SESSION", "r"); 

// obtindrà el paràmetre file de la petició $_FILES.
$r = $request->get("FILES", "file"); 

// obtindrà el paràmetre r de la sessió i escaparà els caràcters especials.
$r = $request->get("INPUT_REQUEST", "r"); 

//Si no volem escapar els caràcters especials podem utilitzar el mètode getRaw();
$r = $request->getRaw(INPUT_GET, "r");  // obtindrà el paràmetre r de la petició GET.

// obtindrà el paràmetre id de la ruta. Només és vàlid amb l’encaminador HTTP.
$r = $request->getParam("id"); 
```

## La resposta (\Emeset\Http\Response)

Un objecte de la classe \Emeset\Http\Response encapsula tota la resposta HTTP.

La resposta encapsula la resposta HTTP, això inclou les cookies, redireccions, capçaleres i variables de sessió (encara que no formin part realment de la resposta HTTP).

```php
// Quan instanciem la classe resposta podem definir en quina carpeta 
// estan les plantilles, per defecte busca a ../src/views/
$response = new \Emeset\Response("../src/vistes");
```

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

### Cookies

El métode setCookie()  mapeja la petició a la funció [setcookie](https://www.php.net/manual/es/function.setcookie.php) de PHP amb els mateixos paràmetres.

```php
public function setCookie($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false)
```

Per exemple:
```php
$response->setCookie("contador", $contador);
```

### Resposta en format JSON

Si volem generar una resposta en format JSON podem utilitzar el mètode setJson() així la resposta codificarà a format JSON tota la informació que hem afegit.

```php
// Generarà la sortida en format JSON.
$response->set("result","ok" ); 
$response->setJson();  
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
El contenidor gestiona les dependències del projecte. Per implementar-lo utilitzem el contenidor Pimple del projecte Symfony. El que fem és estendre el contenidor i definir les dependències de base d’un projecte Emeset.

Per defecte el contenidor ja té definit com instanciar els diferents objectes necessaris per fer funcionar l’aplicació mínima.

```php
$contenidor->config  // recuperem la configuració
$request = $contenidor->get("request"); // Retorna una instància de l’objecte request.
```

Si volem afegir o sobreescriure definicions en el contenidor el que hem de fer és definir una classe que extengui la classe \Emeset\Container.

```php

<?php


namespace App;

use Emeset\Container as EmesetContainer;

class Container extends EmesetContainer {

    public function __construct($config){
        parent::__construct($config);

        /* Podem definir com s’han d’instanciar els diferents models. */
        $this["user"] = function ($c) {
            return new \App\Model\User($c->get("db"));
        };
        
        /* Si definim una entrada per la classe d’un controlador s’utilitzarà aquest codi
           per instanciar-la, això ens permet gestionar les depedències específiques de
           cada controlador. */
        $this["\App\Controllers\Privat"] = function ($c) {
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

Emeset és agnòstic respecte a les eines de frontend, però l’aplicació base ve preconfigurada amb TailwindCSS com a framework CSS  i amb Webpack per empaquetar el Javascript i TypeScript.

Per poder utilitzar aquestes eines ens cal tenir instal·lat [node](https://nodejs.org/en/).

Per instal·lar totes les dependències necessaries:

```bash
$ npm install
```

Un cop tenim instal·lades les dependències, podem executar les diferents eines.

- npm run build  -> generarà un nous fitxers css i js  pel nostre projecte processant els fitxers /App/css/main.css i /App/js/index.js.
- npm run watch -> generarà un nous fitxers css i js  pel nostre projecte cada cop que hi hagi un canvi en els fitxers /App/css/main.css i /App/js/index.js.
- npm run start -> inicia el servidor web a localhost:8080 i executa npm run watch.
- npm run prod -> com npm run build, però preparà els fitxers per un entorn de producció.
- npm run test -> executar els testos que trobi, fitxers *.test.js

Si els fitxers tenen l'extensió .ts seran transpilats de TypeScript a Javascript.




#FpInfor #DawMp07 #DawMp07Uf01 #DawMp07Uf02 #DawMp07Uf03 #DawMp07Uf04
