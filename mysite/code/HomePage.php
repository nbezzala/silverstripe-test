<?php
class HomePage extends Page {

}

class HomePage_Controller extends Page_Controller {
    private static $allowed_actions = array('BrowserPollForm');

    public function BrowserPollForm() {
        $fields = new FieldList(
            new TextField('Name', 'Your Name'),
            new TextField('Email', 'Your Email'),
            new OptionsetField('Browser', 'Your Favourite Browser', array(
                'Internet Explorer' =>  'Internet Explorer',
                'Firefox'           =>  'Firefox',
                'Chrome'            =>  'Chrome',
                'Safari'            =>  'Safari',
                'Konqueror'         =>  'Konqueror',
                'Opera'             =>  'Opera',
                'Lynx'              =>  'Lynx',
            )),
            new TextAreaField('Reason')
        );

        $actions = new FieldList(
            new FormAction('doBrowserPoll', 'Submit')
        );
        
        return new Form($this, 'BrowserPollForm', $fields, $actions);
    }
	
    public function init() {
		parent::init();
    }

    public function doBrowserPoll($data, $form) {
        $submission = new BrowserPollSubmission();
        $form->saveInto($submission);
        $submission->write();
        return $this->redirectBack();
    }
}

