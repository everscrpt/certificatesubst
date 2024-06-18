<?php

return [
    'allowed_type' => [
        'image' => 'Image',
        'document' => 'Document',
        'video' => 'Video',
    ],

    'image_sizes' => [
        'slider' => [
            'width' => 800,
            'height' => 300,
            'crop' => true,
        ],
        'single_post_image' => [
            'width' => 800,
            'height' => 400,
            'crop' => true,
        ],
        'thumbnail' => [
            'height' => 400,
            'width' => 400,
            'crop' => true,
        ],
        'content_post' => [
            'height' => 400,
            'width' => 1140,
            'crop' => true,
        ],
    ],
];
