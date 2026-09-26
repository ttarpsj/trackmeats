<?php

return [
    'legacy_paths' => ['balboa-classic', 'icahn-memorial', 'm10ke', 'la-jolla-games'],
    'exporting' => false,
    // Set to the repository name (for example, "trackmeats") when exporting
    // for a GitHub project site. Leave empty for local use or a root domain.
    'base_path' => env('SITE_BASE_PATH', ''),
];
