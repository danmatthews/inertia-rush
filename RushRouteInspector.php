<?php

namespace App;

use App\HttpVerb;
use App\RushRoute;
use Inertia\Inertia;
use ReflectionClass;
use App\RushController;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class RushRouteInspector {

    public function inspectClass(string $class, string $root_path = ''): Collection
    {
         // Detect if the class is one that extends our controller.
         $reflection = new ReflectionClass(new $class);

         if (!$reflection->isSubclassOf(RushController::class)) {
             throw new \Exception("Classes passed to Route::rush should extend the RushController base class");
         }

         return Collection::make($reflection->getMethods())
         ->filter(fn ($method) => $method->class == $class)
         ->reject(fn ($method) => in_array($method->name, [
             'view', 'props',
         ]))
         ->map(function($method) use ($root_path) {

             // Check if it has the HttpVerb attribute applied.
             $attributes = Collection::make($method->getAttributes())
                 ->groupBy(fn ($attribute) => $attribute->getName())
                 ->map(fn ($attributes) => Collection::make($attributes->first()->getArguments()));
             
                 $relative_url = rtrim($root_path,'/').'/_endpoint/'.Str::snake("rush_".$method->name);

             return new RushRoute(
                  relative_url: $relative_url,
                  absolute_url: url($relative_url),
                  method_name: $method->name,
                  http_verb: $attributes->has(HttpVerb::class) 
                     ? $attributes->get(HttpVerb::class)->first() 
                     : 'POST',
             );
         });
    }

}
