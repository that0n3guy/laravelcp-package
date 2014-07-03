<?php namespace Gcphost\Laravelcp\Controllers;

use Gcphost\Laravelcp\Services\SiteBlog;

class BlogController extends BaseController {
    protected $service;

    public function __construct(SiteBlog $service)
    {
        $this->service = $service;
    }
    
	public function getIndex()
	{
		return $this->service->index();
	}

	public function getView($slug)
	{
		return $this->service->view($slug);
	}

	public function postView($slug)
	{
		return $this->service->post($slug);
	}

	public function postContactUs(){
		return $this->service->postContactUs();
	}

	public function getContactUs(){
		return $this->service->getContactUs();
	}
}