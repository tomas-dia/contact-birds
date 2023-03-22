<?php

use Page;

class SearchPage extends Page 
{
    public function getControllerName()
    {
        return SearchPageController::class;
    }
}