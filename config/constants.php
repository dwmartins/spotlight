<?php 

return [
    // Setting cache time (in minutes)
    'cache_time' => 10080, // 7 days = 10,080 minutes
    
    // Translation files
    'translation_files' => [
        'messages.php',
        'validation.php'
    ],

    'min_password_length' => 6,

    // List of all roles that exist in the system
    'allowed_roles' => ['support', 'admin', 'mod', 'test', 'visitor', 'sponsor'],

    // List of roles that have access to the site's administrative panel
    // Only users with these roles will be able to access the dashboard's features.
    'has_access_app' => ['support', 'admin', 'mod', 'test'],

    // path to user avatars
    'path_to_user_avatars' => '/storage/users/avatars/',

    // paths to default avatar
    'path_to_default_avatar' => '/assets/images/default/avatar.jpg'
];