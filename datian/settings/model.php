<?php

$m=[
    'user'=>
        [
        'id' => 'id',
        'name' => 'word',
        'session' => 'rkey:session:user'
        ],
    'session'=>
        [
        'id' => 'id',
        'user' => 'fkey:user:id',
        'name' => 'word',
        'session' => 'rkey:session:session'
        ],
    'category'=>
        [
        'id' => 'id',
        'name' => 'word',
        'parent' => 'fkey:category:children',
        'children' => 'rkey:category:parent'
        ]
    ];

  


    

?>