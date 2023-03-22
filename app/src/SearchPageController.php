<?php

use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextField;

class SearchPageController extends PageController
{
    private static $allowed_actions = [
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
            new FormAction('submit', 'Search')
        );

        $form = new Form($this, 'Form', $fields, $actions);
    
        $form->setFormMethod('GET')
         ->setFormAction($this->Link())
         ->disableSecurityToken()
         ->loadDataFrom($this->request->getVars());

        return $form;
    }


    public function index(HTTPRequest $request){
        $entries = Entry::get();
        $data = array(
            'Results' => $entries
        );

        return $data; 
    }
}