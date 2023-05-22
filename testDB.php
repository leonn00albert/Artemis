<?php
echo shell_exec("php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/testDBJSON.php  --colors=always --testdox");


?>  