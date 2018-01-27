<?php
define('LOCALHOST', 'http://localhost/');
define('ABSURL', LOCALHOST.'zzz/hack/');
define('RELPATH', 'medicine/');
define('ABSPATH', dirname(__FILE__) . '/' . RELPATH);
define('PAGE_NAME', 'index.php');

require_once(ABSPATH."constants.php");
require_once(ABSPATH."base.php");
require_once(ABSPATH."common.php");
require_once(ABSPATH."functions.php");
require_once(ABSPATH."html.php");
?>
