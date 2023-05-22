<?php
echo shell_exec("php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/testRequest.php  --colors=always --testdox");
echo shell_exec("php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/testResponse.php  --colors=always --testdox");
echo shell_exec("php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/testArtemis.php  --colors=always --testdox");

?>  