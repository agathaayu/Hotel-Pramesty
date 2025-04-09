protected $routeMiddleware = [
    // Middleware lainnya...
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
];