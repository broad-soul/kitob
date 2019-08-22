<?php
$uri = $_SERVER['REQUEST_URI'];
$data = explode('/', $uri);
if ($data[1] == 'data') {
    Route::get($uri, function () use ($uri)
    {
        if (!File::exists($uri)) return abort(404);

        $file = File::get($uri);
        $type = File::mimeType($uri);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });
}
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

