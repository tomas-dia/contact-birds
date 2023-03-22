<?php

use Page;

class EntryPage extends Page 
{
    public function getControllerName()
    {
        return EntryPageController::class;
    }
}