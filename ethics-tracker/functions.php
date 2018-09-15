<?php
function test_ethics_hello_world() {
  global $wpdb;
  $result = $wpdb->get_results('SELECT * FROM `wppe_posts` LIMIT 10');
  var_dump($result);
}

?>