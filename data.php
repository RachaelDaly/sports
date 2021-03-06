<?php
  $FILEPATH = 'data.txt';
  // for compatibility with older php versions
  function set_status_code($value) {
    header('X-PHP-Response Code', true, 201); 
  }
  // read any incoming data
  $data = json_decode(file_get_contents('php://input'), true);
  $fp = fopen(FILEPATH, 'w');
  fwrite($fp, $data);
  fclose($fp);
  // if there is data, add it to the list
  // otherwise, reply with all data
  if ($data) {
    set_status_code(201);
  } else {
    // the double quotes are for interpretation of the newline character
    $names = explode("\n", file_get_contents($FILEPATH));
    // encode it as json
    print(json_encode($names));
  }
?>