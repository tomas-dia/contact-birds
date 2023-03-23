<?php

use PageController;
use GuzzleHttp\Client;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;


class BirdPageController extends PageController
{

    private static $allowed_actions = [
        'index'
    ];

    public function index(HTTPRequest $request)
    {
        $birds = new ArrayList();

        $client = new Client([
            'base_uri' => 'https://catalogue.data.govt.nz/api/3/action/'
        ]);

        $query = 'datastore_search?resource_id=1f7d28c3-012c-4646-958f-6eea488f9a8d';

        if ( $request->getVar('Name')){
            $query = $query . '&q=' . $request->getVar('Name');
        }
        if ( $request->getVar('Count')){
            $query = $query . '&q=' . $request->getVar('Count');
        }
        $response = $client->get($query);
        if ($response->getStatusCode() == 200) {
            $body = json_decode($response->getBody(), true);
            $results = $body['result'];
            $records = $results['records'];
            foreach ($records as $record) {
                $birds->push(new ArrayData([
                    'Name' => ucwords($record['Species common name (taxon [AGE / SEX / PLUMAGE PHASE])']),
                    'Count' => $record['COUNT']
                ]));
            }
        }

        $paginatedBirds = PaginatedList::create(
            $birds,
            $request
        )->setPageLength(10)
            ->setPaginationGetVar('s');

        $data = array(
            'Results' => $paginatedBirds
        );

        return $data;
    }

    public function Filter()
    {
        $fields = new FieldList(
            new TextField('Name', 'Bird Name'),
            new TextField('Count'),
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
}
