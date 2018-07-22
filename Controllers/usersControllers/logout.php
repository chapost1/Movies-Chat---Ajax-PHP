<?php
session_start();
unset($_SESSION['currentUser']);
echo 'ok';