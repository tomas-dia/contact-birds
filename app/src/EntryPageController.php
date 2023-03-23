<?php

use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;

class EntryPageController extends PageController
{
    private static $allowed_actions = [
        'Form',
        'edit',
        'update'
    ];
    
    public function Form()
    {
        $fields = new FieldList(
            TextField::create('Name'),
            EmailField::create('Email'),
            TextField::create('Phone'),
            TextField::create('Address')
        );
        $actions = new FieldList(
            new FormAction('submit', 'Submit')
        );
        return new Form($this, 'Form', $fields, $actions);
    }

    public function UpdateForm($ID)
    {
        $entry = Entry::get_by_id($ID);
        $fields = new FieldList(
            TextField::create('Name')->setValue($entry->Name),
            EmailField::create('Email')->setValue($entry->Email),
            TextField::create('Phone')->setValue($entry->Phone),
            TextField::create('Address')->setValue($entry->Address),
            HiddenField::create('ID')->setValue($entry->ID)
        );

        $actions = new FieldList(
            new FormAction('update', 'Update')
        );
        return new Form($this, 'Form', $fields, $actions);
    }

    public function edit(HTTPRequest $request){
        $entry = Entry::get()->byID($request->param('ID'));
        return [
            'Entry' => $entry
        ];
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

    public function update($data, $form, $entry)
    {
        $name = $data['Name'];
        $email = $data['Email'];
        $phone = $data['Phone'];
        $address = $data['Address'];
        $id = $data['ID'];

        $entry = Entry::get()->byID($id);

        $entry->Name = $name;
        $entry->Email = $email;
        $entry->Phone = $phone;
        $entry->Address = $address;

        $entry->write();

        return $this->redirect('/search-contacts');
    }
}