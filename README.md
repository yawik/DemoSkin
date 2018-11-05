YawikDemoSkin
=============

Skin for the Yawik Demo at https://yawik.org/demo/

Build status:
[![Build Status](https://travis-ci.org/yawik/DemoSkin.svg?branch=master)](https://travis-ci.org/yawik/DemoSkin)

Installation
------------

You can install this skin into your running YAWIK by:

```sh
$ cd /path/to/yawik
$ composer require yawik/demo-skin
```

To activate the module, create a file in you `YAWIK/config/autoload` directory

```
<?php
return ['YawikDemoSkin'];
```
