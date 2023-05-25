<?php
echo shell_exec("php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/testDBJSON.php  --colors=always --testdox");
echo shell_exec("php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/testDBCSV.php  --colors=always --testdox");
echo shell_exec("php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/testDBSQLite.php  --colors=always --testdox");

?>  