<?php

namespace App;

use Inertia\Inertia;

abstract class RushController {

    public $view = '';

    public function routeResponse()
    {
        
    }

    public function render()
    {
        // Get the data.
        
        // Put together the method map and object and merge it with the data.
        $data = (new RushRouteInspector)->inspectClass($this::class)->toArray();

        // return the view.
        // @TODO check for defined function instead of property.

        return Inertia::render($this->view, ['RushConfig' => $data]);
    }

}
