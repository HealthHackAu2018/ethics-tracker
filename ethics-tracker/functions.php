<?php
function test_ethics_hello_world() {
  global $wpdb;
  $result = $wpdb->get_results('SELECT * FROM `wppe_posts` LIMIT 10');
  var_dump($result);

}

function setup_users_table($table_name) {
    global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();  
    
		$sql = "CREATE TABLE $table_name (
			username varchar(100) NOT NULL,
			fullname varchar(100) DEFAULT NULL,
			password varchar(100) DEFAULT NULL,
			project_list varchar(1000) DEFAULT NULL,
			PRIMARY KEY (username)
			) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $result = dbDelta( $sql );
    var_dump($result);
	}

function test_create_tables() {

  global $wpdb;
  $table_name = 'users';
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			//table not in database. Create new table
			setup_users_table($table_name);
	}
}

function et_application_details_header() {

  echo '<div>';
  echo '<a class="button" href="">Edit</a>';
  echo '<a class="button" href="">Attach Document</a>';
  echo '<a class="button" href="">View Attachments</a>';
  echo '</div>';

}

add_action('add_project_to_db_action', 'add_project_to_db');
function add_project_to_db($details) {
	//$user = get_current_user_id();

}
add_filter( 'caldera_forms_upload_directory', function( $dir, $field_id, $form_id ){
	$field = Caldera_Forms_Field_Util::get_field( $field_id, Caldera_Forms_Forms::get_form(  $form_id ) );
	if ( is_array( $field ) ) {
		$dir = sanitize_title( $field[ 'slug' ] );
	}
	return $dir;
}, 10, 3  )

?>
