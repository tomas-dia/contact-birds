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

    public function DeleteLink()
    {
        $page = EntryPage::get()->first();
        return $page->Link('delete/'.$this->ID);
    }
}