<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Task Management API',
    description: 'Laravel Technical Assessment'
)]
#[OA\Server(
    url: 'http://127.0.0.1:8000',
    description: 'Local Server'
)]
class OpenApi
{
}
