<?php
require "../controlers/filter_sqli.php";
$username = "abcde;";
echo $username;
$username = filter_sqli($username);
echo $username;
