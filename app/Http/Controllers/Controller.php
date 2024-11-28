<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="8.6.3",
 *      title="Whatsapp API Server",
 *      description="L5 Swagger API Documentation",
 *
 *      @OA\Contact(
 *          email="ajmalmohd0501@gmail.com"
 *      ),
 *
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="https://www.apache.org"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
