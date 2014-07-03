<?php namespace Gcphost\Laravelcp\Services;

use Gcphost\Laravelcp\Helpers\Search;
use Gcphost\Laravelcp\Helpers\Theme;

class SearchService {
	public function index($search)
    {
		$results=Search::Query($search);
		return Theme::make('admin/search/index', compact('results'));
    }

}