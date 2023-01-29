Work in progress.

```php
Route::rush('/posts', RushComponent::class);
```

```php
class Posts extends RushComponent {

    // Set the view using a property.
    public $view = 'Pages/Posts';

    // ... or using a function if you need logic.
    public function view() {
        return 'Pages/Posts';
    }

    // Any function is callable from within by simply calling Rush.methodName and is passed the parameters
    // supplied.
    public function methodName($param, $param2, $param3)
    {

    }

    // Specify an HTTP verb using an attribute (the default is POST)
    #[HttpVerb('DELETE')]
    public function deletePost() {

    }
}
```
