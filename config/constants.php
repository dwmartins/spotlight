<?php 

return [
    // Setting cache time (in minutes)
    'cache_time' => 10080, // 7 days = 10,080 minutes

    // List of all roles that exist in the system
    'allowed_roles' => ['support', 'admin', 'mod', 'test', 'visitor', 'sponsor'],

    // List of roles that have access to the site's administrative panel
    // Only users with these roles will be able to access the dashboard's features.
    'has_access_app' => ['support', 'admin', 'mod', 'test'],

    // path to user avatars
    'path_to_user_avatars' => '/storage/users/avatars/',
    'path_to_default_avatar' => '/assets/images/default/avatar.jpg',

    //Types of files that the system accepts
    'accepted_image' => 'image/jpeg, image/jpg, image/png',
    'accepted_favicon' => 'image/vnd.microsoft.icon, image/x-icon, image/jpeg, image/jpg, image/png',

    // Accepted file types
    'allowedMimeTypes' => [
        'images' => ['image/jpeg', 'image/png', 'image/jpg'],
        'favicon' => ['image/vnd.microsoft.icon', 'image/x-icon', 'image/jpeg', 'image/jpg', 'image/png']
    ],

    // Accepted file sizes
    'allowedFileSizes' => [
        'images' => 5 * 1024 * 1024, // 5MB
        'avatars' => 2 * 1024 * 1024, // 2MB
    ]
];