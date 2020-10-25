<div align="center">  
  <img src="assets/title.svg"><br>  
  <h1><img src="https://views.whatilearened.today/views/github/PresentKim/arrayutils.svg?style=for-the-badge" height="24" align="right"></h1><br>  
  <img src="https://img.shields.io/github/stars/PresentKim/arrayutils?style=for-the-badge" height="24">  
  <img src="https://img.shields.io/github/license/PresentKim/arrayutils.svg?style=for-the-badge" height="24">  
  <a href="https://poggit.pmmp.io/ci/PresentKim/arrayutils/~">  
    <img src="https://poggit.pmmp.io/ci.shield/PresentKim/arrayutils/~?style=for-the-badge" height="24">   
  </a>  
  
  <h1><strong> Library that provides a method to fancy manipulate an array </strong></h1><br>  
</div>  

## :clipboard: Table of Contents  
- [:book: Introduction](#book-introduction)  
- [:zap: Features](#zap-features)  
- [:file_folder: Target software](#file_folder-target-software)  
- [:wrench: Installation](#wrench-installation)  
- [:package: Downloads](#package-downloads)  
- [:space_invader: Demo](#space_invader-demo)  
- [:memo: License](#memo-license)  
  
<br>  
  
## :book: Introduction  
PHP's array functions are painful for developers. (like `array_map`, `array_filter`)  
- Array first or callback function first...  
- Return value or reference a variable...  

In addition, since it is a `function`, the code breaks every time.  
I created this library to solve these problems and make js-array-like code flow.  
  
<br>  
  
## :zap: Features  
You can use `ArrayUtils` or `ArrayBuilder` to use the features of this library. 
- **`ArrayUtils`**
  ```php  
  namespace kim\present\utils\arrays;  
  
  class ArrayUtils{  
    public static function from(array|ArrayBuilder $origin) : Builder{  
        return new ArrayBuilder($origin);  
    }  
  
    public static function __callStatic(string $name, array $arguments){  
        return self::from(array_shift($arguments))->{$name}(...$arguments);  
    }  
  }  
  ```  
  As above, This is proxy class for quick access to `ArrayBuilder`.  
- **`ArrayBuilder`**  
  ```php  
  namespace kim\present\utils\arrays;  
  
  class ArrayBuilder extends \ArrayObject{  
    public function __construct(array|ArrayBuilder $array, $flags = 0, $iteratorClass = "ArrayIterator")  
    public function join(string $glue = "", string $prefix = "", string $suffix = "") : string  
    public function validate(callable $callable, bool $invertBreak = false) : bool  
    public function filter(callable $callable, int $flag = 0) : ArrayBuilder  
    public function slice(int $offset, ?int $length = null, bool $preserveKeys = false) : ArrayBuilder  
    public function map(callable $callable) : ArrayBuilder  
    public function keys() : ArrayBuilder  
    public function values() : ArrayBuilder  
    public function combine() : ArrayBuilder  
    public function merge($array) : ArrayBuilder  
    public function mergeSoft($array) : ArrayBuilder  
    public function mapAssoc(callable $callable) : ArrayBuilder  
    public function keyMap(callable $callable) : ArrayBuilder  
    public function flip() : ArrayBuilder  
    public function diff(array|ArrayBuilder $array) : ArrayBuilder  
    public function diffKey(array|ArrayBuilder $array) : ArrayBuilder  
    public function first() : mixed  
    public function firstKey() : mixed  
    public function last() : mixed  
    public function lastKey() : mixed  
    public function random() : mixed  
    public function randomKey() : mixed  
    public function pop() : mixed  
    public function shift() : mixed  
    public function sum() : int|float  
    public function toArray() : array  
    public function toString() : string  
  }  
  ```  
  As above, This is array object with array related chaining methods.  
  If you add suffix `As` to the method that returns an `ArrayBuilder`, it returns an `array`  
  `example`
  ```php
  public function map(callable $callable) : ArrayBuilder  
  public function mapAs(callable $callable) : array  
  ```
  
<br>  
  
## :file_folder: Target software:  
**This is works with [Pocketmine-MP](https://github.com/pmmp/PocketMine-MP)**  
  
<br>  
  
## :wrench: Installation
See [poggit/support/virion](https://github.com/poggit/support/blob/master/virion.md)
  
<br>  
  
## :package: Downloads:  
Download from [Poggit](https://poggit.pmmp.io/ci/PresentKim/arrayutils/~)
  
<br>  
  
## :space_invader: Demo  
- `Before`
  ```php
  use pocketmine\Server;
  use pocketmine\Player;
  
  $allPlayers = array_merge_recursive(
      $players = array_column(
          array_map(function(Player $player){
              return [strtolower($name = $player->getName()), $name];
          }, Server::getInstance()->getOnlinePlayers(), []),
          1,
          0
      ),
      array_diff_key(
          array_column(
              array_map(function(string $fileName){
                      return [
                          strtolower($name = substr($fileName, 0, -strlen(".dat"))),
                          $name
                      ];
                  },
                  array_filter(
                      scandir(Server::getInstance()->getDataPath() . "players/"),
                      function(string $fileName) : bool{ return substr($fileName, -strlen(".dat")) === ".dat"; }),
                  []),
              1,
              0
          ),
          $players
      )
  );
  ```
- `After`
  ```php
  use pocketmine\Server;
  use pocketmine\Player;
  use kim\present\utils\arrays\ArrayUtils as Arr;

  $allPlayers = Arr::from(Server::getInstance()->getOnlinePlayers())
    ->mapAssoc(function($_, Player $player){ return [strtolower($name = $player->getName()), $name]; })
    ->mergeSoftAs(
      Arr::from(scandir(Server::getInstance()->getDataPath() . "players/"))
      ->filter(function(string $fileName) : bool{ return substr($fileName, -strlen(".dat")) === ".dat"; })
      ->map(function(string $fileName) : bool{ return substr($fileName, 0, -strlen(".dat")); })
      ->combine()
  )
  ```
- `Final (PHP >= 7.4)`
  ```php
  use pocketmine\Server;
  use pocketmine\Player;
  use kim\present\utils\arrays\ArrayUtils as Arr;

  $allPlayers = Arr::from(Server::getInstance()->getOnlinePlayers())
      ->mapAssoc(fn($_, Player $player) => [strtolower($name = $player->getName()), $name])
      ->mergeSoftAs(
          Arr::from(scandir(Server::getInstance()->getDataPath() . "players/"))
              ->filter(fn(string $fileName) => substr($fileName, -strlen(".dat")) === ".dat")
              ->map(fn(string $fileName) => substr($fileName, 0, -strlen(".dat")))
              ->combine()
      );
  ```
  
<br>  
  
## :memo: License  
> You can check out the full license [here](LICENSE)  
  
This project is licensed under the terms of the **MIT** license  