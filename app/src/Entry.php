<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Entry extends DataObject{

    private static $db = [
        'Name' => 'Varchar',
        'Address' => 'Varchar',
        'Email' => 'Varchar',
        'Phone' => 'Varchar',
    ];

    private static $has_one = [
        'EntryPage' => EntryPage::class,
    ];


    public function EditLink()
    {
        $page = EntryPage::get()->first();
        return $page->Link('edit/'.$this->ID);
    }
}