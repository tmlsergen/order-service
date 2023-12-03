<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Example for response examples value"
 * )
 *
 * @OA\PathItem(path="/api")
 */
class Controller extends BaseController
{
    use ApiResponse, AuthorizesRequests, ValidatesRequests;
}
