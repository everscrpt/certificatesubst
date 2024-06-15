<?php
return [
    'allowed_type' => [
        'image' => 'Image',
        'document' => 'Document',
        'video' => 'Video'
    ],

    'image_sizes' => [
        'slider'  => array(
            'width' => 800,
            'height' => 300,
            'crop' => true
        ),
        'single_post_image'  => array(
            'width' => 800,
            'height' => 400,
            'crop' => true
        ),
        'thumbnail'  => array(
            'height' => 400,
            'width' => 400,
            'crop' => true
        ),
        'content_post'  => array(
            'height' => 400,
            'width' => 1140,
            'crop' => true
        )
    ],
];