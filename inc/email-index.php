<?php

if(isset($_POST['name']) && !empty($_POST['name']) &&
   isset($_POST['email']) && !empty($_POST['email']) &&
   isset($_POST['phone']) && !empty($_POST['phone']) &&
   isset($_POST['message'])) {

    var_dump($_POST);

}