<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/docs', function () {
    $path = resource_path('docs/api-documentation.md');

    if (File::exists($path)) {
        $markdown = File::get($path);
        $html = (new Parsedown())->text($markdown);
        return view('docs', ['Content' => $html]);
    }

    return abort(404, 'Documentation not found');
});
*/

Route::resource('projects', 'ProjectsController');