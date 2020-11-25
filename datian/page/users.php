
<?php

echo(get(
    [
        'table'=>'user',
        'values'=>[
            'id'=>[],
            '_div'=>[
                'name'=>['mode'=>'testmode'],
                'session'=>
                [
                    'values'=>
                    [
                        'id'=>[],
                        'name'=>[],
                        //if mode = create: insert hidden user input
                        '__button'=>['type'=>'create']
                    ],
                    'where'=>['id=0'],
                    'params'=>['url'=>'users'],
                    'mode'=>'edit', 
                    'view'=>'form'
                ]
            ]
        ], 
        'where'=>[],
        'params'=>[],
        'mode'=>'edit',
    ]
));

?>