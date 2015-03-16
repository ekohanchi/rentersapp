<?php

session_start();

session_register( "username" );

session_register( "password" );

 

$username="terry";

$password="moves";

 

echo "Username set";

?>