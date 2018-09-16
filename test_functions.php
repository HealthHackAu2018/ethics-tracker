<?php

function test_move_updloaded_files() {
  
  $user = get_current_user();
  
  
  $uploads_dir = wp_upload_dir()['basedir'];
  
  
  $sourcedir = "${uploads_dir}/${user}";
  
  $destdir = "${sourcedir}/testproject";
  echo "destination dir:";
  var_dump($destdir);
  if (wp_mkdir_p( $destdir )) {
      echo "created dest dir";
    if (is_dir($sourcedir)){
        echo "isdir sourcedir";
      if ($dh = opendir($sourcedir)){
          echo "opened dir";
        while (($file = readdir($dh)) !== false){
          echo "file";
          var_dump($file);
           move_uploaded_file("${sourcedir}/${file}","${destdir}/${file}");
        }
        closedir($dh);
      }
    }
  }
  
}

?>