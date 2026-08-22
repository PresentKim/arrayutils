<!-- PROJECT BADGES -->
<div align="center">

[![Packagist Status][packagist-status-badge]][packagist-url]
[![Packagist Downloads][packagist-downloads-badge]][packagist-url]
[![Stars][stars-badge]][stars-url]
[![License][license-badge]][license-url]

</div>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <img src="https://raw.githubusercontent.com/presentkim/arrayutils/main/assets/icon.png" alt="Logo" width="80" height="80">
  <h3>arrayutils</h3>
  <p align="center">
    An library that provides a method to fancy manipulate an array!

[View in Packagist][packagist-url] · [Report a bug][issues-url] · [Request a feature][issues-url]

  </p>
</div>
  
## :book: Introduction  
The ~~evil~~ PHP array functions give developers the pain of:

* Some functions **requires array first**, but some functions **require array last**...  
* Some functions **returns result**, but some functions **modify referenced variables**...
* Code was **line-break** because since it is a function...
* Each function has **different parameters to the callback function**...
* No modern functions using arrays. Such as `every`, `some`

I created this library to solve these problems and make code flow like `js-array`

For a detailed description, [Click here (GitBook)](https://arrayutils.docs.present.kim/)

-----
  
## :package: Installation
You can use this library with composer.  
- Go to [**Packagist**](https://packagist.org/packages/presentkim/arrayutils)

-----

## :chart_with_upwards_trend: Performance Benchmark
You can run the performance benchmarks using the following commands:

```bash
.\vendor\bin\phpbench run --report=expression --output=json > .\tests\benchmarks_result.json
php .\tests\benchmarks_result_to_markdown.php
```

-----

## :memo: License  
> You can check out the full license [here](LICENSE)  
  
This project is licensed under the terms of the **MIT** license  


[packagist-status-badge]: https://poser.pugx.org/presentkim/arrayutils/v?style=for-the-badge
[packagist-downloads-badge]: https://poser.pugx.org/presentkim/arrayutils/downloads?style=for-the-badge
[stars-badge]: https://img.shields.io/github/stars/presentkim/arrayutils.svg?style=for-the-badge
[license-badge]: https://img.shields.io/github/license/presentkim/arrayutils.svg?style=for-the-badge

[packagist-url]: https://packagist.org/packages/presentkim/arrayutils
[stars-url]: https://github.com/presentkim/arrayutils/stargazers
[issues-url]: https://github.com/presentkim/arrayutils/issues
[license-url]: https://github.com/presentkim/arrayutils/blob/main/LICENSE

[pmmp-url]: https://github.com/pmmp/Pocketmine-MP