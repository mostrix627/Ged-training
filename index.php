<?php
session_start();
require_once('vendor/autoload.php');
require_once('librairies/tools/Autoload.php');

use \tools\Application;
use \tools\Autoload;


   Autoload::load();
   Application::process();




