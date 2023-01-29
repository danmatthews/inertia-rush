Work in progress.

In your routes file:
```php
Route::rush('/posts', PostsController::class);
```

In your controller:
```php
class PostsController extends RushController {

    // Set the view using a property.
    public $view = 'Pages/Posts';

    // ... or using a function if you need logic.
    public function view() {
        return 'Pages/Posts';
    }

    // Define your functions as if you were writing them using AJAX + Routes
    // Rush handles the URL plumbing for you.
    
    #[HttpVerb('GET')]
    public function getPosts()
    {

    }
    
    /* POST is the default, so no verb needs to be specified */
    public function createPost()
    {
        
    }

    // Specify an HTTP verb using an attribute (the default is POST)
    #[HttpVerb('DELETE')]
    public function deletePost() {

    }
}
```
