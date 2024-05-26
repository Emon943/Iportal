<?php

$auth->logout($hash);

header("Location: ?page=login&m=1");

exit();
session_destroy();
?>