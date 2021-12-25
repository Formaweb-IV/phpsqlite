README

- Para realizar esta titoría pode s empregar calquer entorno servidor para o teu SO.
    - Laragon, Xampp, Mamp, EasyPHP,...

Este é unha titoría de programación PHP para a base de datos SQLite versión 3. Abarca os conceptos básicos da programación SQLite coa linguaxe PHP.

Para traballar con esta titoría, debes ter PHP CLI instalado no sistema.

Para traballar con bases de datos SQLite, podes tamén instalar a extensión de liña de comandos sqlite3 ou unha GUI SQLite no navegador.
 

 ---
 # PHP SQLite 3

Este é unha titoría de programación PHP para a base de datos SQLite versión 3. Abarca os conceptos básicos da programación SQLite coa linguaxe PHP.

Para traballar con esta titoría, debes ter PHP CLI instalado no sistema.

Para traballar con bases de datos SQLite, podes tamén instalar a extensión de liña de comandos `sqlite3` ou unha [GUI SQLite no navegador](https://chrome.google.com/webstore/detail/sqlite-manager/njognipnngillknkhikjecpnbkefclfe).

Nesta titoría, se emprega PHP 7.4.19.

Comproba a túa versión de PHP. Aínda que non coincida é posible que poidas realizala práctica se alo menos tes a versión PHP 7.2.11

```bash
$ php -v
PHP 7.4.19 (cli) (built: May  4 2021 14:24:38) ( ZTS Visual C++ 2017 x64 )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
    with Zend OPcache v7.4.19, Copyright (c), by Zend Technologies
```

SQLite ven xa con PHP; non necesitas instalalo. Só debes activar a extensión sqlite3 no arquivo`php.ini`.

```php
...
;extension=sockets
extension=sqlite3 
;extension=tidy
...
```

## SQLite

**SQLite é un motor de base de datos relacional integrado**. A documentación chámao un *motor de base de datos SQL transaccional e autónomo, sen servidor, de configuración cero e transaccional*. É moi popular con centos de millóns de copias en todo o mundo en uso. Varias linguaxes de programación teñen soporte incorporado para SQLite, incluíndo PHP e Python.

## Crear unha base de datos SQLite

Usamos a ferramenta de liña de comandos `sqlite3` para interactuar cunha base de datos SQLite.

Para crear unha base de datos proporcionamoslle o nome da nova base de datos á ferramenta `sqlite3`. Unha base de datos SQLite é un arquivo máis no teu disco. Co seguinte comando invocamos unha base de datos. Se xa existe, ábrese. Se non existe este comando a creará.

```sqlite
$ sqlite3 test.db
SQLite version 3.27.2 2019-02-25 16:06:06
Enter ".help" for usage hints.
sqlite>
```

Algúns comando:

- `.tables` proporciona unha lista de táboas na base de datos `test.db`. Actualmente non hai táboas.
- `.exit` finaliza a sesión interactiva da ferramenta de liña de comandos `sqlite3`. 
- `ls` mostra o contido do directorio de traballo actual. 
- Dende a consola, dentro de `sqlite>` , podemos ver o arquivo `test.db`. Todos os teus datos se almacenarán neste único arquivo.

## Coñecer a versión SQLite3 con PHP

Nos seguintes exemplos, empregarase PHP para intractuar coa base de datos SQLite.

-  obter a versión SQLite en uso:

  - Crea o arquivo `version.php`

    ```php
    <?php 
    
    $ver = SQLite3::version(); 
    
    echo $ver['versionString'] . "\n"; 
    echo $ver['versionNumber'] . "\n"; 
    
    var_dump($ver);
    ```

     `SQLite3::version()` devolve a versión da base de datos SQLite

    Podes ver a páxina no navegador ou empregando o comando `php` dende a consola:

    ```bash
    $ php version.php 
    3.20.1 
    3020001 
    array(2) { 
        ["versionString"]=> 
        string(6) "3.20.1" 
        ["versionNumber"]=> 
        int(3020001) 
    }
    ```

    Esta é a saída.

- Outro xeito de facer o mesmo::

  - Crea o arquivo `versión 2.php`

    ```php
    <?php
    
    $db = new SQLite3('test.db');
    
    $version = $db->querySingle('SELECT SQLITE_VERSION()');
    
    echo $version . "\n";
    ```

    Executao no navegador ou na consola:

    `$ php version2.php`

    O programa devolve a versión actual da base de datos SQLite que estás a usar. 

    Esta vez executase a declaración  `SELECT SQLITE_VERSION()`.

    Coa liña:

    ```php
    $db = new SQLite3('test.db');
    ```

    creamos un obxecto SQLite3 e abrimos unha conexión coa base de datos SQLite3, incluída entre parenteses.

    ```php
    $version = $db->querySingle('SELECT SQLITE_VERSION()');
    ```

    `querySingle()` executa unha consulta e devolve un resultado único.

    ```bash
    $ php version2.php
    3.20.1
    ```

    Esta é a saída.

## PHP `exec` e  SQLite3

Segundo o [manual de php, a función exec](https://www.php.net/manual/es/function.exec.php) seve para 'executar un programa externo' desde a nosa aplicación con php. Neste caso unha consulta á base de datos.

Aquí `exec()` executa unha consulta sen resultados contra unha base de datos determinada. Isto é que non obten resposta pero inda así interactua coa base de datos creando taboas, engadindo datos,... e máis.

- Crea o arquivo `create_table.php`:

  ```php
  <?php
  
  $db = new SQLite3('test.db');
  
  $db->exec("CREATE TABLE cars(id INTEGER PRIMARY KEY, name TEXT, price INT)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Audi', 52642)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Mercedes', 57127)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Skoda', 9000)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Volvo', 29000)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Bentley', 350000)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Citroen', 21000)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Hummer', 41400)");
  $db->exec("INSERT INTO cars(name, price) VALUES('Volkswagen', 21600)");	
  ```

  O programa creará a táboa `cars` , coas cabeceiras de columna `id`, `name` e `price`.

  ```php
  $db->exec("CREATE TABLE cars(id INTEGER PRIMARY KEY, name TEXT, price INT)");

Esta instrución SQL crea unha nova táboa `cars`. Lembra que nas bases de datos SQLite, o valor `INTEGER PRIMARY KEY`  increméntase automaticamente.

As seguintes liñas introducen datos de coches coma novas entradas da táboa:

```php
$db->exec("INSERT INTO cars(name, price) VALUES('Audi', 52642)");
$db->exec("INSERT INTO cars(name, price) VALUES('Mercedes', 57127)");
...
```

Verifica os datos escritos coa ferramenta  `sqlite3` para ver se a consulta se executou correctamente. Primeiro podes modificar a forma en que se van a amosar os datos na consola. Dende a consola executa os seguinte comandos en `sqlite>`

```sqlite
sqlite> .mode column
sqlite> .headers on
```

Así os datos se amosan máis ordenados por columnas, e con cabeceiras.

```sqlite
sqlite> select * from cars;
id          name        price
----------  ----------  ----------
1           Audi        52642
2           Mercedes    57127
3           Skoda       9000
4           Volvo       29000
5           Bentley     350000
6           Citroen     21000
7           Hummer      41400
8           Volkswagen  21600
```

Estes son os datos que escribiches na táboa `cars`.

## PHP SQLite3 lastInsertRowID

Hai moitas formas nas que podemos necesitar interactuar cunha base de datos. Ás veces, necesitamos determinar, por exemplo, o `id` da última fila inserida. Para consultar isto en SQLite3 con PHP dispós do método `lastInsertRowID()`.

- Crea o arquivo `last_rowid.php`:

  ```php
  <?php
  
  $db = new SQLite3(':memory:');
  
  $db->exec("CREATE TABLE friends(id INTEGER PRIMARY KEY, name TEXT)");
  $db->exec("INSERT INTO friends(name) VALUES ('Tom')");
  $db->exec("INSERT INTO friends(name) VALUES ('Rebecca')");
  $db->exec("INSERT INTO friends(name) VALUES ('Jim')");
  $db->exec("INSERT INTO friends(name) VALUES ('Robert')");
  
  $last_row_id = $db->lastInsertRowID();
  
  echo "O Id da última inserida é $last_row_id";
  ```

  Así crearas unha táboa `friends` na memoria. Lembra que o `id` increméntase automaticamente xa que en SQLite3, a columna `INTEGER PRIMARY KEY` increméntase automaticamente. 

  Tamén hai unha palabra clave  `AUTOINCREMENT`. Cando se usa `INTEGER PRIMARY KEY ` con `AUTOINCREMENT` se aplica un algoritmo lixeiramente diferente para a creación do ID.

  ```php
  $db->exec("CREATE TABLE friends(id INTEGER PRIMARY KEY, name TEXT)");
  $db->exec("INSERT INTO friends(name) VALUES ('Tom')");
  $db->exec("INSERT INTO friends(name) VALUES ('Rebecca')");
  $db->exec("INSERT INTO friends(name) VALUES ('Jim')");
  $db->exec("INSERT INTO friends(name) VALUES ('Robert')");
  ```

  Cando se usa o incremento automático, temos que indicar explicitamente os nomes das columnas, omitindo aquilo que se incrementa automaticamente. As catro instrucións insiren catro filas na táboa `friends`.

  ```php
  $last_row_id = $db->lastInsertRowID();
  ```

  Usando  `lastInsertRowID()` obtés o `id`  da última fila inserida.

  Esta é a saída do programa:

  ```bash
  $ php last_rowid.php
  The last inserted row Id is 4
  ```

## Consulta con PHP en SQLite3

O método `query()` executa unha consulta SQL e devolve un obxecto de resultado.

- Crea o arquivo `fetch_all.php`. O exemplo recupera tódolos datos da táboa `cars`:

  ```php
  <?php
  
  $db = new SQLite3('test.db');
  
  $res = $db->query('SELECT * FROM cars');
  
  while ($row = $res->fetchArray()) {
      echo "{$row['id']} {$row['name']} {$row['price']} \n";
  }
  ```

  Esta instrución SQL selecciona todos os datos (`*`) da táboa `cars`.

  ```php
  $res = $db->query('SELECT * FROM cars');
  ```

  O `fetchArray()` recupera unha liña de resultado como unha matriz asociativa ou numericamente indexada ou ambos (o estándar é ambos). E devolve `false` se non hai máis filas.

  ```php
  while ($row = $res->fetchArray()) {
  ```

  Executa agora o arquivo para comprobar os resultados:

  ```bash
  $ php fetch_all.php
  1 Audi 52642
  2 Mercedes 57127
  3 Skoda 9000
  4 Volvo 29000
  5 Bentley 350000
  6 Citroen 21000
  7 Hummer 41400
  8 Volkswagen 21600
  ```

  Esta é a saída do exemplo.

## PHP `escapeString` con SQLite3 

`escapeString()`devolve unha cadea que se *escapou* correctamente - :smiley: que se obtivo de xeito correcto durante unha consulta á bbdd-.

- Crea o arquivo `scape_string.php`:

  ```php
  <?php
  
  $db = new SQLite3('test.db');
  
  $sql = "SELECT name FROM cars WHERE name = 'Audi'";
  
  $escaped = SQLite3::escapeString($sql);
  
  var_dump($sql);
  var_dump($escaped);
  ```

  O exemplo executa unha consulta e *escapa* unha cadea:

  ```php
  $ php escape_string.php
  string(41) "SELECT name FROM cars WHERE name = 'Audi'"
  string(43) "SELECT name FROM cars WHERE name = ''Audi''"
  ```

  Comproba a saída do exemplo.

## Declaracións parametrizadas PHP SQLite3

As instrucións SQL adoitan construírse de forma dinámica. Un usuario proporciona algunha entrada e esta entrada está integrada na declaración. Debemos ser cautelosos cada vez que tratamos cunha entrada dun usuario. **Ten algunhas implicacións graves de seguridade**. A forma recomendada de construír dinámicamente instrucións SQL é utilizar a vinculación de parámetros.

As consultas parametrizadas créanse con `prepare()`; este método *prepara* unha instrución SQL para a súa execución e devolve un obxecto de instrución. Unha capa de abstracción que minora os riscos na entrada de datos á base de datos.

Para SQLite3, PHP dispón dos métodos `bindParam()`e `bindValue()` para conectar os valores de marcadores de posición. Permite **vincular datos a signos de interrogación ou marcadores de posición con nome**. (no orixinal: *bind data to question mark or named placeholders.*)

### Enunciados parametrizados con signos de interrogación

No primeiro exemplo se usa a sintaxe dos signos de interrogación.

- Crea o arquivo `prepared.php`:

```php
<?php

$db = new SQLite3('test.db');

$stm = $db->prepare('SELECT * FROM cars WHERE id = ?');
$stm->bindValue(1, 3, SQLITE3_INTEGER);

$res = $stm->execute();

$row = $res->fetchArray(SQLITE3_NUM);
echo "{$row[0]} {$row[1]} {$row[2]}";
```

Se selecciona un coche usando o marcador de posición do signo de interrogación.

```php
$stm = $db->prepare('SELECT * FROM cars WHERE id = ?');
```

Os signos de interrogación `?` son marcadores de posición para os valores. Os valores engádense máis tarde (se enlazan) aos marcadores de posición.

```php
$stm->bindValue(1, 3, SQLITE3_INTEGER);
```

Con `bindValue()` se unen o valor 3 ao marcador de posición do signo de interrogación. O primeiro argumento é o parámetro posicional, que identifica o marcador de posición (pode haber varios marcadores de posición de signo de interrogación).

```
$ php prepared.php
3 Skoda 9000
```

Esta é a saída.

### Instrucións parametrizadas con marcadores de posición nomeados

O segundo exemplo usa instrucións parametrizadas con marcadores de posición nomeados.

- Crea o arquivo `prepared2.php`

```php
<?php

$db = new SQLite3('test.db');

$stm = $db->prepare('SELECT * FROM cars WHERE id = :id');
$stm->bindValue(':id', 1, SQLITE3_INTEGER);

$res = $stm->execute();

$row = $res->fetchArray(SQLITE3_NUM);
echo "{$row[0]} {$row[1]} {$row[2]}";
```

Seleccionamos un coche específico usando un marcador de posición nomeado.

```php
$stm = $db->prepare('SELECT * FROM cars WHERE id = :id');
```

:eye: Os marcadores de posición nomeados comezan co carácter `:`, dous puntos.

### PHP SQLite3 `bind_param` 

`bind_param()` enlaza un parámetro a unha variable de declaración. Pódese usar para xestionar varias filas.

- Crea o arquivo `bind_param.php`:

```php
<?php

$db = new SQLite3(':memory:');

$db->exec("CREATE TABLE friends(id INTEGER PRIMARY KEY, firstname TEXT, lastname TEXT)");

$stm = $db->prepare("INSERT INTO friends(firstname, lastname) VALUES (?, ?)");
$stm->bindParam(1, $firstName);
$stm->bindParam(2, $lastName);

$firstName = 'Peter';
$lastName = 'Novak';
$stm->execute();

$firstName = 'Lucy';
$lastName = 'Brown';
$stm->execute();

$res = $db->query('SELECT * FROM friends');

while ($row = $res->fetchArray()) {
    echo "{$row[0]} {$row[1]} {$row[2]}\n";
}
```

No exemplo, se insiren dúas filas nunha táboa cunha instrución parametrizada. Para enlazar os marcadores de posición, usamos o método `bind_param()`.

```bash
$ php bind_param.php
1 Peter Novak
2 Lucy Brown
```

Esta é a saída.

## Metadatos con PHP e SQLite3

Os metadatos son información sobre os datos na base de datos. Os metadatos en SQLite conteñen información sobre as táboas e columnas, nas que almacenamos os datos. O número de filas afectadas por unha instrución SQL é un metadato. O número de filas e columnas devoltas nun conxunto de resultados tamén pertence aos metadatos.

Os metadatos en SQLite pódense obter mediante métodos PHP, comandos específicos de PHP para SQLite3 ou consultando a táboa  `sqlite_master` do sistema SQLite .

- Crea o arquivo `num_of_columns.php`:

```php
<?php

$db = new SQLite3('test.db');

$res = $db->query("SELECT * FROM cars WHERE id = 1");
$cols = $res->numColumns();

echo "There are {$cols} columns in the result set\n";
```

 `numColumns()` devolve o numero de columnas do conxunto de resultados..

```bash
$ php num_of_columns.php
There are 3 columns in the result set
```

Esta é a saída .

- Crea o arquivo `column_names.php`:

```php
<?php

$db = new SQLite3('test.db');

$res = $db->query("PRAGMA table_info(cars)");

while ($row = $res->fetchArray(SQLITE3_NUM)) {
    echo "{$row[0]} {$row[1]} {$row[2]}\n";
}
```

Neste exemplo, se usa o comando `PRAGMA table_info(tableName)` para obter información de metadatos sobre a  táboa `cars` .

```php
$res = $db->query("PRAGMA table_info(cars)");
```

O comamdo `PRAGMA table_info(tableName)` devolve unha liña por cada columna da táboa `cars`. As columnas do conxunto de resultados inclúen o número de orde da columna, o nome da columna, o tipo de datos, se a columna pode ser ou non `NULL`, e o valor predeterminado para a columna.

```php
while ($row = $res->fetchArray(SQLITE3_NUM)) {
    echo "{$row[0]} {$row[1]} {$row[2]}\n";
}
```

A partir da información proporcionada, imprimimos o número de orde da columna, o nome da columna e o tipo de datos da columna.

```bash
$ php column_names.php
0 id INTEGER
1 name TEXT
2 price INT
```

Esta é a saída do exemplo.

No seguinte exemplo imprimimos todas as filas da táboa `cars` cos seus nomes de columna.

- Crea o arquivo `column_names2.php`:

```php
<?php

$db = new SQLite3('test.db');

$res = $db->query("SELECT * FROM cars");

$col1 = $res->columnName(1);
$col2 = $res->columnName(2);

$header = sprintf("%-10s %s\n", $col1, $col2);
echo $header;

while ($row = $res->fetchArray()) {

    $line = sprintf("%-10s %s\n", $row[1], $row[2]);
    echo $line;
}
```

Imprime o contido da táboa `cars` na consola e cos nomes das columnas tamén. Os rexistros están aliñados cos nomes das columnas.

```php
$col1 = $res->columnName(1);
```

`columnName()` devolve o nome da columna n.

```php
$header = sprintf("%-10s %s\n", $col1, $col2);
echo $header;
```

Estas liñas imprimen os nomes de dúas columnas da táboa `cars`.

```php
while ($row = $res->fetchArray()) {

    $line = sprintf("%-10s %s\n", $row[1], $row[2]);
    echo $line;
}
```

Imprime as filas usando o bucle `while`. Os datos están aliñados cos nomes das columnas.

```php
$ php column_names2.php
name       price
Audi       52642
Mercedes   57127
Skoda      9000
Volvo      29000
Bentley    350000
Citroen    21000
Hummer     41400
Volkswagen 21600
```

Esta é a saída.

No seguinte exemplo, se enumeran todas as táboas da base de datos `test.db`.

- Cera o arquivo `list_tables.php`:

```php
<?php

$db = new SQLite3('test.db');

$res = $db->query("SELECT name FROM sqlite_master WHERE type='table'");

while ($row = $res->fetchArray(SQLITE3_NUM)) {
    echo "{$row[0]}\n";
}
```

Este exemplo de  código imprime na consola todas as táboas dispoñibles na base de datos  especificada.

```php
$res = $db->query("SELECT name FROM sqlite_master WHERE type='table'");
```

Os nomes das táboas almacénanse dentro da táboa `sqlite_master` do sistema .

```bash
$ php list_tables.php
cars
images
```

Estas son as táboas do noso sistema.

`changes()`devolve o número de liñas de datos que foron modificados, inseridos ou borrados pola instrución última SQL.

- Crea o arquivo `changes.php`:

```php
<?php

$db = new SQLite3(':memory:');

$db->exec("CREATE TABLE friends(id INTEGER PRIMARY KEY, name TEXT)");
$db->exec("INSERT INTO friends(name) VALUES ('Tom')");
$db->exec("INSERT INTO friends(name) VALUES ('Rebecca')");
$db->exec("INSERT INTO friends(name) VALUES ('Jim')");
$db->exec("INSERT INTO friends(name) VALUES ('Robert')");

$db->exec('DELETE FROM friends');

$changes = $db->changes();

echo "The DELETE statement removed $changes rows";
```

O exemplo devolve o número de filas eliminadas.

```bash
$ php changes.php
The DELETE statement removed 4 rows
```

Esta é a saída.

## Exemplo PHP PDO SQLite3

PHP Data Objects (PDO) define define unha interface lixeira para acceder a bases de datos en PHP. Ofrece unha capa de abstracción de acceso a datos para traballar con bases de datos en PHP. Define API coherente para traballar con varios sistemas de bases de datos.

PHP PDO é unha biblioteca integrada; non necesitamos instalalo.

- Crea o arquivo `list_tables.php`:

```php
<?php

$pdo = new PDO('sqlite:test.db');

$stm = $pdo->query("SELECT * FROM cars");
$rows = $stm->fetchAll(PDO::FETCH_NUM);

foreach($rows as $row) {

    printf("$row[0] $row[1] $row[2]\n");
}
```

O exemplo obtén todas as filas da táboa con PHP PDO.

## Examplo Dibi 

PHP Dibi é unha pequena e intelixente capa de base de datos para PHP.

Emprega `composer`, o xestor de paquetes de PHP, para instalar a biblioteca Dibi:

```bash
$ composer req dibi/dibi
```

- Crea agora o arquivo `fetch_cars.php`:

```php
<?php

require('vendor/autoload.php');

$db = dibi::connect([
    'driver' => 'sqlite',
    'database' => 'test.db',
]);

$rows = $db->query('SELECT * FROM cars');

foreach ($rows as $row) {
    
    $id = $row->id;
    $name = $row->name;
    $price = $row->price;

    echo "$id $name $price \n";
}
```

O exemplo recolle todas as filas da táboa `cars`.

## Exemplo coa DBAL *Doctrine*

*Doctrine* é un conxunto de bibliotecas PHP centradas principalmente en ofrecer servizos de persistencia en PHP. Os seus principais proxectos son un mapeador relacional de obxectos (ORM) e a capa de abstracción de bases de datos (DBAL).

- object-relational mapper (ORM) 
- database abstraction layer (DBAL).

```bash
$ composer req doctrine/dbal
```

Con `composer` instala o paquete `Doctrine DBAL`.

>  :eye: Pode que, a demais, teñas que descomentar a seguinte extensión  
>
>  ``;extension=pdo_mysql``  &rarr; `extension=pdo_mysql`   
>
> no teu arquivo `php.ini`

- Crea entón o arquivo `fetch_cars2.php`:

```php
<?php

require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\FetchMode;

$attrs = ['driver' => 'pdo_sqlite', 'path' => 'test.db'];

$conn = DriverManager::getConnection($attrs);

$queryBuilder = $conn->createQueryBuilder();
$queryBuilder->select('*')->from('cars');

$stm = $queryBuilder->execute();
$rows = $stm->fetchAll(FetchMode::NUMERIC);

foreach ($rows as $row) {

    echo "{$row[0]} {$row[1]} {$row[2]}\n";
}
```

O exemplo recupera todas as filas da táboa de `cars` axudándose da biblioteca *Doctrine DBAL QueryBuilder*.

Até aquí unha breve introdución a algunha das cousas que podemos facer con PHP e a funcionalidade incluída SQLite3.

Queda da túa conta procurar máis información e adaptar estas tecnoloxías ao teu proxecto. 

[Titoría orixinal](https://zetcode.com/php/sqlite3/) de Jan Bodnar, admin(at)zetcode.com

Adaptado para o taller de formación e emprgeo FORMAWEB IV - Concello de Vigo 2021-2022

DEC 2021