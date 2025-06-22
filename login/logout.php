<?php
session_start();
session_destroy();

// Çıkış yaptıktan sonra login sayfasına yönlendiriyoruz ve URL'ye ?logout=1 parametresi ekliyoruz
header("Location: ../login/login.php?logout=1");
exit();