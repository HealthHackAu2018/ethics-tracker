<?php

/**
 * Fired during plugin activation
 *
 * @link       kiaradavison.com
 * @since      1.0.0
 *
 * @package    Ethics_Tracker
 * @subpackage Ethics_Tracker/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ethics_Tracker
 * @subpackage Ethics_Tracker/includes
 * @author     Kiara Davison <kiara@kiaradavison.com>
 */
class Ethics_Tracker_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	static function setup_project_table($table_name) {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $table_name (
			id varchar(100) NOT NULL,
			name varchar(100) NOT NULL,
			type varchar(100) DEFAULT NULL,
			description varchar(1000) DEFAULT NULL,
			lead_investigator varchar(100) DEFAULT NULL,
			status varchar(100) DEFAULT NULL,
			start_date date DEFAULT NULL,
			end_date date DEFAULT NULL,
			completion_date date DEFAULT NULL,
			contact_name varchar(100) DEFAULT NULL,
			contact_email varchar(100) DEFAULT NULL,
			contact_phone varchar(100) DEFAULT NULL,
			report_date date DEFAULT NULL,
			approved_investigators varchar(1000) DEFAULT NULL,
			committee varchar(100) DEFAULT NULL,
			notes varchar(1000) DEFAULT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$result = dbDelta( $sql );
	}

	static function setup_users_table($table_name) {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $table_name (
			username varchar(100) NOT NULL,
<<<<<<< HEAD
			fullname varchar(100) NOT NULL,
			password varchar(100) NOT NULL,
			project_list varchar(1000) NOT NULL,
=======
			fullname varchar(100) DEFAULT NULL,
			password varchar(100) DEFAULT NULL,
			project_list varchar(1000) DEFAULT NULL,
>>>>>>> 9c647b49db94a81ac0445a89e78cc2944e272f3a
			PRIMARY KEY (username)
			) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
<<<<<<< HEAD
	}

	static function setup_attachments_table($table_name) {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $table_name (
			id INT AUTO_INCREMENT, 
			project_id varchar(100) NOT NULL,
			uploader varchar(100) NOT NULL,
			name varchar(100) NOT NULL,
			date_uploaded date NOT NULL,
			document_date date,
			description varchar(1000),
			PRIMARY KEY (id)
			) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
=======
>>>>>>> 9c647b49db94a81ac0445a89e78cc2944e272f3a
	}

	// Setup database tables if they do not exist
	static function setup_database_tables() {
		
		global $wpdb;
		$table_name = 'projects';
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			//table not in database. Create new table
			self::setup_project_table($table_name);
		}
		$table_name = 'users';
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			//table not in database. Create new table
			self::setup_users_table($table_name);
		}
<<<<<<< HEAD
		$table_name = 'attachments';
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			//table not in database. Create new table
			self::setup_attachments_table($table_name);
		}
=======
		
>>>>>>> 9c647b49db94a81ac0445a89e78cc2944e272f3a
	}
	public static function activate() {
		self::setup_database_tables();
	}
}
