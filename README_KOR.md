<p align="right">  
  <a href="https://github.com/Blugin/virions/blob/master/MultilingualConfigTrait/README.md">  
    <img src="https://img.shields.io/static/v1?label=read%20in&message=English&color=success">  
  </a>  
</p>  
  
#### :zap: `config.yml`파일 작성하기  
> 이 라이브러리는 PMMP에서 사용하는 언어 리소스 이름 패턴을 사용합니다  
> 따라서 설정된 규칙에 따라 언어 자원 파일의 이름을 지정해야합니다  
> ```php  
> Rules:  
> /resources/config/{$locale}.yml  
> ```  
> - **$locale**은 [`ISO_639-3`](https://en.wikipedia.org/wiki/ISO_639-3) 표준에 따른 언어 코드입니다  
> ```php  
> Examples:  
> /resources/config/eng.yml  
> /resources/config/kor.yml  
> /resources/config/chz.yml  
> /resources/config/ind.yml  
> /resources/config/jpn.yml  
> ```  
  
#### :sparkles: `config.yml`파일 다국어 지원하기
> 이 라이브러리에서 제공하는 `MultilingualConfigTrait` 를 사용하면 됩니다  
> ```php  
> 예시: 
> //대충, 기본 언어 구성 파일을 저장하는 예제 소스
> class Main extends PluginBase{  
>     use MultilingualConfigTrait;  
> 
>     public function onLoad() : void{  
>         $this->saveDefaultConfig();  
>     }  
> }  
> ```  