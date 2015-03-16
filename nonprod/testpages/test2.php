<?php

session_start();

?>

<html>

<body>

<?php

echo "Your username is: $HTTP_SESSION_VARS ['username'] <br>";

echo "Your password is: $password ";

?>

</body>

</html>