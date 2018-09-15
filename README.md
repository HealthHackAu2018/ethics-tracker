# Ethics Tracker design document
# HealthHack Brisbane 15/09/2018 - 16/09/2018

## Purpose
Ethics Tracker is intended to provide a robust and easy-to-use solution for managing important documents relating to research in laboratories, specifically for tracking ethical approvals.

## System overview
Ethics Tracker is, at heart, a content management system. The full product will consist of a database that stores the records pertaining to the ethics applications to be managed by the system, which is connected to a web form interface for entering data. Ideally, the web form interface will include online accessibility features with basic security (e.g., a requirement for users to register themselves with the hosting website).

# Minimum viable product
The following is a list of features that should be considered the minimum required to create a viable prototype.

## Database and record fields
Each record stored in the database should be associated with a single ethics application. Records should have the capacity to store alphanumeric data as well as multiple small files (i.e., documents). When attaching a document to a record, the user must specify the class of document (‘Application’, ‘Policy’, ‘Approval’, ‘Modification’, ‘Progress report’, ‘Closure report’, ‘Incident report’, ‘Form’, ‘Finance’, ‘Material transfer agreement’, ‘Memorandum of understanding’, ‘Publication’, ‘Suspension’, ‘Other’), and may provide an accompanying description. The system should also query the user to supply a ‘filing date’ so that documents can be organised chronologically.

Alphanumeric data should be stored in the following fields 
* Identifier code (string)
* Ethics type (list, ‘Human’, ‘Animal’)
* Project name (string)
* Description (string)
* Lead investigator (string)
* Project status (list, ‘Active’, ‘Inactive’, ‘Closed’, ‘Suspended’)
* Start date (date)
* End date (date)
* (Optional) Completion date 
* Contact name (string)
* Contact email (string)
* Contact phone number (string)
* Approved investigators (string [array])
* Primary research ethics committee (string)
* Reporting period (date to date; day and month only)

## Note on record status
The status of the record reflects the status of the associated ethics application. ‘Active’ indicates that the ethics approval is in effect and that work may proceed on the projects covered by the approval, while ‘Inactive’ indicates that the ethics approval does not meet one or more vital dependency (e.g., the approval period has not yet commenced, the approval has expired, or a parent approval has lapsed). ‘Suspended’ indicates that the overseeing research ethics committee has suspended the approval, and ‘Closed’ indicates that all projects covered by the ethics approval have been completed.  

## Web form interfaces
Upon logging onto the system, the user should first be presented with an overview of all records to which they have been granted access. The overview should show only a subset of data contained within the viewable records (i.e., the ‘vital statistics’). Upon selecting a record from the list, the user should be presented with all the data that has been entered into the record, as well as any attached files. Tools to create, edit and delete records (based on the user’s level of access) should be made available in both the ‘records overview’ and ‘detailed record’ interfaces.

## Records overview interface
The records overview should be presented as a table or in another easily viewed format. Each record in the overview should display the following data fields
* Identifier code
* Project name
* Lead investigator
* Project status
* End date (overridden by the project completion date, if the record is ‘Closed’)
* Alert messages (if applicable)

## Detailed record interface
In the detailed record interface, users can view all data stored in the record, as well as edit and delete data (depending on their level of access). Users can also attach, download, and remove files, as well as edit file metadata (depending on their level of access). There should be navigation options to move to the previous / next record in the overview list, as well as an option to return to the records overview.

# Advanced features
The following is a list of features that will be required for the full product, but are not required for the prototype.

## System security
New users will be required to register an account with the hosting website to gain access to the system. Once approved by the system manager, the user will be granted administrator rights to their account and any records they create (delete, read and write privileges). 

## Users delegating access to other users
Users can nominate other registered users to be granted access to records they have created with the following pre-set degrees of accessibility
* Owner (DRW privileges. Can set access settings for other registered users)
* Member (RW privileges)
* Collaborator (R privileges)

## Record sorting, filtering and searching
In the record overview, record entries should be sortable (e.g., by ethics type), filterable (e.g., list records expiring within a defined period) and searchable (e.g., matching search terms in the record name or description).

In the detailed view, file attachments should be sortable (e.g., by attachement type), filterable (e.g., attachments with a filing date within a defined period) and searchable (e.g., matching search terms in the attachment name or description).

## Additional, or more advanced, record fields for the database
* Completion date (date, populated automatically if the project has the ‘Closed’ status)
* Number of approved changes to the protocol within the reporting period (integer, populated automatically, set by the number of files attached to the record with the ‘Modification’ type with an approval date with the most recent ‘Reporting period’)
* Number of adverse incidents within the reporting period (integer, populated automatically, set by the number of files attached to the record with the ‘Incident report’ type that have an approval date with the most recent ‘Reporting period’)
* Number of publications released as a result of this study (integer, populated automatically, set by the number of files attached to the record with the ‘Publications’ type)
* Alert message (string [array], populated automatically, set by the system)
* Parent approval (list [array], populated automatically, containing links to all other records that must be ‘Active’ for the current record to also be listed as ‘Active’)
* Dependent approval (list [array], populated automatically, containing links to all other records which are contingent on the status of the current record)

## Record linking
Records may be linked to one another (i.e., to represent when an ethics application is dependent on another ethics application) using the ‘Parent approval’ record field. When linked, the status of the parent record dictates the status of the child record. If the status of a parent record is set to ‘Inactive’, ‘Closed’, or ‘Suspended’, child records with an ‘Active’ status are automatically set to ‘Inactive’ with an alert raised that the parent of the child record is currently not active. Records should be linked via their record identifier codes, so a warning should display when a new record is being created or edited and the identifier code is not unique.

## User set alerts
For each record, one or more alerts can be set (or dismissed) by the user. When triggered, an alert will display a predefined message next to the record in the records overview and detailed records interfaces and / or send an email to a designated list of contacts. An alert will not be sent if the status of a record is set to ‘Closed’. 

When an alert is added to a record, the user will be required to fill the following form 
* Alert message (string)
* (Optional) Alert description (string)
* Alert occurrence (date and time)
* (Optional) Alert contact email list (string [array])
* (Optional) Alert recurrence pattern (Daily, Weekly, Monthly, Yearly, with sub forms for each option)
* (Optional) Alert recurrence range (‘No End Date’, ‘End After ‘X’ Occurrences’, ‘End by Date’)
Once an alert is triggered, it will remain listed against the record until the alert is marked as ‘Resolved’ by an ‘Owner’ or ‘Member’.

## System logic
The following is a list of operations that should be included to prevent the user taking particular forms of action, flag records with automatic alert messages, and automatically populate certain information within records
* If the current date is within the ‘Start date’ and ‘End date’ period of a record, the status of the record is set to ‘Active’ if it is currently ‘Inactive’. The user can set the record status to ‘Active’, ‘Closed’ or ‘Suspended’.
* If the current date is outside the ‘Start date’ and ‘End date’ period of a record, the status of the record is set to ‘Inactive’ if it is currently ‘Active’. The user can set the record status to ‘Inactive’, ‘Closed’ or ‘Suspended’.
* If a user sets the status to ‘Suspended’, the user is prompted to supply a description, a filing date, and attach any desired documents. Attached documents will be filed with the supplied date and description under ‘Suspensions’.
* If a user sets the status to ‘Closed’, the user is prompted to supply a description, a filing date, and attach any desired documents. Attached documents will be filed with the supplied date and description under ‘Closure reports’. The ‘Completion date’ field will be automatically updated with the supplied filing date.
* The status of a record cannot be set to ‘Closed’ if it has one or more dependent records and those dependent records have not yet been set to ‘Closed’.
* Records which have the ‘Closed’ status should be considered archived; they should be viewable by users with access to the record but can only be edited by ‘Owners’ (the system should also ask the user to confirm their intension to edit closed records). Owners can revive a closed record by setting its status back to ‘Active’.
* If the status of a record is changed to ‘Inactive’ or ‘Suspended’, any dependent records which are ‘Active’ are automatically set to ‘Inactive’. If the parent record is returns to the ‘Active’ state, dependent records will automatically be set to ‘Active’ if they are ‘Inactive’ (provided the current date is within the ‘Start date’ and ‘End date’ of the dependent record).
