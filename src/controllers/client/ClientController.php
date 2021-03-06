<?php namespace Gcphost\Laravelcp\Controllers;

use Gcphost\Laravelcp\Services\ClientService;

class ClientController extends BaseController {
    protected $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function getIndex()
    {
		return $this->service->index();
    }
}