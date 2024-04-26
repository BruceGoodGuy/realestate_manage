<?php
return [
    'user' => [
        'status' => ['created' => 0, 'active' => 1, 'blocked' => 2,],
        'kind' => ['guest' => 0, 'admin' => 1],
        'access' => ['client' => 'api-client']
    ],
    'platform' => ['mobile' => 0, 'web' => 1],
    'maxrecords' => 2000,
    'content' => ['inactive' => 0, 'active' => 1],
];
