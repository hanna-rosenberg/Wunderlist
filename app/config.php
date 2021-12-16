<?php

declare(strict_types=1);

// This file contains a list of global configuration settings.

return [
    'title' => 'Wunderlist',
    'database_path' => sprintf('sqlite:%s/database/wunderlist.sqlite', __DIR__),
];
