<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;

class ImagesController extends Controller
{
    public function show(FilesystemAdapter $filesystem, Request $request, $path)
    {
        $server = ServerFactory::create(
            [
            'response' => new LaravelResponseFactory($request),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.glide-cache',
            ]
        );

        return $server->getImageResponse($path, $request->all());
    }
}
