<?php

// These functions will be merged with functions.php

function et_display_overview_table() {

  global $wpdb;
  $results = $wpdb->get_results("SELECT * FROM projects");

  foreach( $results as $key => $row ) {

    echo '<a href="./view-application?key=' . $key
        . '"><div class="application">';
    echo $row->id . ', ';
    echo $row->name . ', ';
    echo $row->type . ', ';
    echo $row->status . ', ';
    echo $row->end_date . 'end';
    echo '</div></a>';

    //echo '<a href="">';
    //echo '</a>';

  }
}

function et_display_application_details() {

  $key = $_GET["key"];

  global $wpdb;
  $results = $wpdb->get_results("SELECT * FROM projects");
  $row = $results[$key];

echo <<<EOL

  <h2 id="meta">Application Details</h2>

    $row->id <br/>
    $row->name <br/>
    $row->type <br/>
    $row->status <br/>
    $row->end_date <br/>

    $row->description <br/>
    $row->lead_investigator <br/>
    $row->start_date <br/>
    $row->completion_date <br/>
    $row->contact_name <br/>
    $row->contact_email <br/>
    $row->contact_phone <br/>
    $row->report_date <br/>
    $row->committee <br/>

  <h2 id="investigators">Approved Investigators</h2>
    $row->approved_investigators <br/>

  <h2 id="attachments">Attachements</h2>

  <a href="./upload-attachment">Upload Attachment</a>

EOL;

}

// Post processing action for uploading attachments
// Adds an entry to the attachments table in the db
add_action( 'upload_attachment_action', 'et_upload_attachment');
function et_upload_attachment( $data ) {

  $user_id = get_current_user_id();
  if ($user_id !== 0) {

    // TODO: Project id

    //$file_name = $data->file;
    // TODO: The file needs to be put somewhere and an id assigned

    global $wpdb;
    $wpdb->insert('attachments', array('project_id' => $data['application_id'],
        'uploader' => $user_id, 'name' => $data['name'],
        'date_uploaded' => current_time('mysql'),
        'document_date' => date('Y-m-d', strtotime($data['document_date'])),
        'description' => $data['description']));
  }
}

// Fetches attachments from the db
function et_fetch_attachments($key) {

  global $wpdb;

  $results = $wpdb->get_results("SELECT * FROM attachments ".
      "WHERE project_id=".$key);

  return $results;
}

// Post processing action for the add application page
// Adds a record to the projects table in the db
add_action('add_project_to_db_action', 'add_project_to_db');
function add_project_to_db($data) {
	$user_id = get_current_user_id();
  if ($user_id != 0) {
		global $wpdb;
	  $wpdb->insert('projects', array('id' => $data['approval_number'],
				'name' => $data['project_name'],
				'type' => $data['ethics_type'],
				'description' => $data['description'],
				'lead_investigator' => $data['lead_investigator'], 
				'status' => $data['project_status'],
				'start_date' => date('Y-m-d', strtotime($data['start_date'])),
				'end_date' => date('Y-m-d', strtotime($data['end_date'])),
				'completion_date' => date('Y-m-d', strtotime($data['completion_date'])),
				'contact_name' => $data['contact_name'],
				'contact_email' => $data['contact_email'],
				'contact_phone' => $data['contact_phone_number'],
				'report_date' => date('Y-m-d', strtotime($data['report_date'])),
				'approved_investigators' => $data['approved_investigators'],
				'committee' => $data['primary_research_ethics_comittee'],
				'notes' => $data['messagecomments'] ));
  }
}
add_filter( 'caldera_forms_upload_directory', function(){
	return get_current_user();
});
?>
