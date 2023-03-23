<?php

use Page;

class EntryPage extends Page 
{

    private static $has_many = [
        'Entries' => Entry::class
    ];
    
    public function getControllerName()
    {
        return EntryPageController::class;
    }
}