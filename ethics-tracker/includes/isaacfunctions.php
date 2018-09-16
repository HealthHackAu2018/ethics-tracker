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

  <h2>Application Details</h2>

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

  <h2>Approved Investigators</h2>
    $row->approved_investigators <br/>

  <h2>Attachements</h2>

  <a href="./new-attachement">Upload Attachment</a>

EOL;

}

?>
