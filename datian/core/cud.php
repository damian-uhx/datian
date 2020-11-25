<?php
//update
//create
//delete

//foreach $table for each entry update when key > 0, else create
/*
function crud($model, $action)
{
    $input=[];
    foreach ($_POST as $key=>$value)
    {
        $key=explode(':', $key);
        $input[$key[0]][$key[1]]=$value;
    }

    switch ($action)
    {
        case 'create':
            echo 'CREATE';
        case 'default':
            echo 'DEFAULT';
    }
}

function sql_insert($input){
    //$sql = INSERT INTO
    foreach ($model as $table=>$value){
        
    }
}

*/


    /*
function get ($fields, $table){
        $columns=[];
        $conditions=[];
        foreach ($fields as $name=>$options){
            if (is_numeric($name)){
                $conditions[]=$options;
            }
            else if ($name[0]!=='_'){
                $columns[]=$name;
            }
        }
        $result=sql_get($table, $columns, $conditions);

        foreach ($fields as $name=>$options)
        {
            if (isset($result[$name])){
                $options['value']=$result[$name];
            }
            wrap($name, $options);
        }


}*/

/*function sql_get($table, $array, $conditions){

}*/

/*function wrap($options)
{
    //name->type
    //value
    //view
}*/

//creates all entries 
function save ($input){
    //arr($input, 'save');
    foreach ($input as $table=>$arrays)
    {
        foreach ($arrays as $array)
        {
            (arr)($arrays, '*'.$table);
            if (isset ($array['submit']) || isset ($array['post']))
            {
                sql_create($array, $table);
            }
            foreach ($array as $subtable=>$subarray){
                if (is_array($subarray)){
                    save([$subtable=>$subarray]);
                }
            }
        }
    }   
}

function create(){
    foreach ($_POST['data'] as $table=>$entries)
    {
        
        foreach ($entries as $i=>$entry)
        {
            if ($i>0){
                sql_update($entry, $table, $i);
            }
            else{
                sql_create($entry, $table);
            }
        }
    }
}

function sql_create($array, $table){
    //$sql='INSERT OR REPLACE INTO '.$table;
    $sql='INSERT INTO '.$table;
    $columns='';
    $values='';
    global $m;
    foreach  ($array as $column=>$value){
        $columns.=$column.', ';
        $values.='"'.$value.'", ';
        /*if (!is_array($value) && isset($m[$table][$column])){
            $columns.=$column.', ';
            $values.='"'.$value.'", ';
        }*/
    }
    $columns=substr($columns, 0, -2);
    $values=substr($values, 0, -2);
    $sql.=' ('.$columns.') VALUES ('.$values.');';
    //arr($sql, 'SQL');
    sql_set($sql);
}

function sql_update($array, $table, $id){
    $sql='UPDATE '.$table.' SET ';
    foreach  ($array as $column=>$value){
        $sql.=$column.'="'.$value.'", ';
    }
    $sql=substr($sql, 0, -2);
    $sql.=' WHERE id ='.$id.';';
    sql_set($sql);
}
//if submit: array: submit
