<?php namespace Gcphost\Laravelcp\Controllers;

use Gcphost\Laravelcp\Services\MergeService;

class AdminMergeController extends BaseController {
    protected $service;

    public function __construct(MergeService $service)
    {
        $this->service = $service;
    }

    public function getMassMergeConfirm()
    {
		return $this->service->get();
    }

    public function postMerge()
    {
		return $this->service->post();
	}
 }