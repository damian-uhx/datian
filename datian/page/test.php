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
                        '__button'=>['type'=>'create']
                    ],
                    'where'=>[],
                    'params'=>['url'=>'test.php'],
                    'mode'=>'edit',
                    'view'=>'form'
                ]
            ]
        ], 
        'where'=>[],
        'params'=>[],
        'mode'=>'default',
        //'view'=>'form'
    ]
));


?>