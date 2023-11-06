<?php

include "admin/connect.php";

session_destroy();
session_unset();

header("location: login.php");