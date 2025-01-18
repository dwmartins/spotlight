<?php 

return [
    // Setting cache time (in minutes)
    'cache_time' => 10080, // 7 days = 10,080 minutes
    
    // Setting the minimum number of characters for the password
    'min_password_length' => 6,

    // Translation files
    'translation_files' => [
        'messages.php',
    ],

    // List of all roles that exist in the system
    'allowed_roles' => ['support', 'admin', 'mod', 'test', 'visitor', 'sponsor'],

    // List of roles that have access to the site's administrative panel
    // Only users with these roles will be able to access the dashboard's features.
    'has_access_app' => ['support', 'admin', 'mod', 'test'],
];