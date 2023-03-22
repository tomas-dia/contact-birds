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
}