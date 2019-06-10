<?php

  $key = array_keys($_POST)[0];
  $value = $_POST[$key];
  $sql = "UPDATE graduation_status SET $key = '$value' WHERE member_srl='{$_SESSION['user_srl']}'";

  if(!DB::getConn()->query($sql))
  {
    echo "ERROR: ". DB::getConn()->error;
  }
  Header("Location: /?act=detail");
 ?>
