<?php
include('middleware/verifyuser.php');

session_destroy();
header('location: ./');