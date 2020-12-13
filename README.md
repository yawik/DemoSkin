[![Gitpod
ready-to-code](https://img.shields.io/badge/Gitpod-ready--to--code-blue?logo=gitpod)](https://gitpod.io/#https://github.com/yawik/DemoSkin)

DemoSkin
========

Skin for the Yawik Demo at https://yawik.org/demo/

Build status:
[![Build Status](https://travis-ci.org/yawik/DemoSkin.svg?branch=master)](https://travis-ci.org/yawik/DemoSkin)
[![Latest Stable Version](https://poser.pugx.org/yawik/demo-skin/v/stable)](https://packagist.org/packages/yawik/demo-skin)
[![Total Downloads](https://poser.pugx.org/yawik/demo-skin/downloads)](https://packagist.org/packages/yawik/demo-skin)
[![License](https://poser.pugx.org/yawik/demo-skin/license)](https://packagist.org/packages/yawik/demo-skin)

Installation
------------

You can install this skin into your running YAWIK by:

```sh
$ composer --no-dev create-project yawik/standard:dev-master MyYawik
$ cd MyYawik
$ composer require yawik/demo-skin
```



To activate the module, create a file in you `YAWIK/config/autoload` directory

```
<?php
return ['YawikDemoSkin'];
```
