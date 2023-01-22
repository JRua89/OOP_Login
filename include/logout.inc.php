<?php
session_start();
session_unset();
session_destroy();

session_unset($_SESSION["userid"]);
session_unset($_SESSION["useruid"]);

//Going to back to front page
header("Location: ../login-form-7.php?error=none");
exit();
?>