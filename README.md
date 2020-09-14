<p align="right">  
  <a href="https://github.com/Blugin/virions/blob/master/MultilingualConfigTrait/README.md">  
    <img src="https://img.shields.io/static/v1?label=%ED%95%9C%EA%B5%AD%EC%96%B4&message=%EB%A1%9C+%EC%9D%BD%EA%B8%B0&labelColor=success">  
  </a>  
</p>  
  
#### :zap: Write `config.yml` file
> This library uses the language resource name pattern used by PMMP  
> Therefore, need to name the language resource file according to the established rules  
> ```php  
> Rules:  
> /resources/config/{$locale}.yml  
> ```  
> - **$locale** is the code of the language according to the [`ISO_639-3`](https://en.wikipedia.org/wiki/ISO_639-3) standard  
> ```php  
> Examples:  
> /resources/config/eng.yml  
> /resources/config/kor.yml  
> /resources/config/chz.yml  
> /resources/config/ind.yml  
> /resources/config/jpn.yml  
> ```  
  
#### :sparkles: Support multilingual in `config.yml` file
> Just use `MultilingualConfigTrait` provided by this library  
> ```php  
> Examples: 
> //Roughly, example source that  example source that save default config file  
> class Main extends PluginBase{  
>     use MultilingualConfigTrait;  
> 
>     public function onLoad() : void{  
>         $this->saveDefaultConfig();  
>     }  
> }  
> ```  