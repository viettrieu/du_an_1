<?php
define("SITE_URL", "http://localhost/du_an_1");
define("ADMIN_URL", "http://localhost/du_an_1/admin");

require_once dirname(__DIR__) . '/vendor/autoload.php';
// Process URL from browser
require_once "./mvc/core/App.php";

// How controllers call Views & Models
require_once "./mvc/core/Controller.php";

// Connect Database
require_once "./mvc/core/DB.php";