<?php

require __DIR__ . '/includes/auth.php';

if(is_logged_in()){
  require __DIR__ . '/views/dashborad.php';
} else {
  require __DIR__ . '/views/landing.php';
}

?>