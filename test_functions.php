<?php

function test_move_updloaded_files() {
  echo "in test_move_uploaded files";
  $user = get_current_user();
  echo "current user";
  var_dump($user);
  echo "uploads dir";
  var_dump($uploads_dir);
  $sourcedir = $uploads_dir+'/'+$user;
  echo "source dir:";
  var_dump($sourcedir);
  $destdir = $sourcedir+'/'+'testproject';
  echo "destination dir:";
  var_dump($destdir);
  if (wp_mkdir_p( $destdir )) {
      echo "created dest dir";
    if (is_dir($sourcedir)){
        echo "isdir sourcedir";
      if ($dh = opendir($sourcedir)){
          echo "opened dir";
        while (($file = readdir($dh)) !== false){
           move_uploaded_file($sourcedir+'/'+$file,$destdir+'/'+$file);
        }
        closedir($dh);
      }
    }
  }
  
}

?>