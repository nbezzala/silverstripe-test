<?php
class HomePage extends Page {

}

class HomePage_Controller extends Page_Controller {
    private static $allowed_actions = array('BrowserPollForm');

    public function BrowserPollForm() {
        if (Session::get('BrowserPollVoted')) return false;

        $fields = new FieldList(
            new TextField('Name', 'Your Name'),
            new EmailField('Email', 'Your Email'),
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

        $validator = new RequiredFields('Name', 'Email', 'Browser');
        
        return new Form($this, 'BrowserPollForm', $fields, $actions, $validator);
    }
	
    public function init() {
		parent::init();
    }

    public function doBrowserPoll($data, $form) {
        $submission = new BrowserPollSubmission();
        $form->saveInto($submission);
        $submission->write();
        Session::set('BrowserPollVoted', true);
        return $this->redirectBack();
    }

    public function BrowserPollResults() {
        $submissions = new GroupedList(BrowserPollSubmission::get());
        $total = $submissions->Count();

        $list = new ArrayList();
        foreach ($submissions->groupBy('Browser') as $browserName => $browserSubmissions) {
echo $browserName . "<br>";
            $percentage = (int) $browserSubmissions->Count() / $total * 100;
            $list->push(new ArrayData(array(
                'Browser'       => $browserName,
                'Count'         => $browserSubmissions->Count(),
                'Percentage'    => $percentage,
            )));
        }
        return $list;
    }
}

