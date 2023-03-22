<?php

use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextField;

class EntryPageController extends PageController
{
    private static $allowed_actions = [
        'Form'
    ];
    
    public function Form()
    {
        $fields = new FieldList(
            new TextField('Name'),
            new EmailField('Email'),
            new TextField('Phone'),
            new TextField('Address')
        );
        $actions = new FieldList(
            new FormAction('submit', 'Submit')
        );
        return new Form($this, 'Form', $fields, $actions);
    }

    public function submit($data, $form)
    {
        $name = $data['Name'];
        $email = $data['Email'];
        $phone = $data['Phone'];
        $address = $data['Address'];

        $entry = Entry::create();

        $entry->Name = $name;
        $entry->Email = $email;
        $entry->Phone = $phone;
        $entry->Address = $address;

        $entry->write();

        return $this->redirectBack();
    }
}