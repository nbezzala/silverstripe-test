<?php
class BrowserPollSubmission extends DataObject {
    private static $db = array(
        'Name'      => 'Text',
        'Email'     => 'varchar(255)',
        'Browser'   => 'Text',
    );
}
