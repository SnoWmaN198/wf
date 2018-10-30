<?php 

require_once __DIR__ .  '/../model/User.php';

logout();
session_write_close();

header('Location: /');                                  // go back to the root page
