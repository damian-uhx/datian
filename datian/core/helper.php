<?php

$db = mysqli_connect(DB_HOST, DB_BENUTZER, DB_PASSWORT, DB_NAME);

//executes sql command and returns message;
function sql_set($sql, $return_id=false)
{
    inf($sql);
    global $db;
    $message=mysqli_query($db, $sql);
    if ($return_id){
        return mysqli_insert_id($db);
    }
    return $message;
}

//executes sql command and returns result as an array
function sql_get($sql)
{
    //inf($sql);
    global $db;
    $daten=mysqli_query($db, $sql);
    $return=[];

    while ($entry = (mysqli_fetch_assoc($daten)))
    {
        $return[]=$entry;
    }
    arr($return, $sql);
    return $return;
}


//get entry from model for a specific table and fieldname
function get_model($table, $key)
{
    global $m;
    if (isset($m[$table][$key]))
    {
        return explode(':', $m[$table][$key]);
    }
    else{
        return [];
    }
}

//converts array of conditions to SQL WHERE string
function where2string($where){
    $return='';
    if (count($where)){
        $return=' WHERE ';
        foreach ($where as $condition){
            $return.=$condition.' AND ';
            inf($condition, 'condition');
        }
        $return=substr($return, 0, -5);
    }
    return $return;
}

//********************** */

//for debuging: show array
function arr($array, $text='--'){
    if (DEBUG){
        echo '<h2>'.$text.'</h2>';
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
    }
}

//for debugging: show string
function inf($string, $name=''){
    if (DEBUG)
    {
        echo '<br/>'.$name.': '.$string.'<br/>';
    }
}

//not used yet?
function subarray_search($needle, $array, $field=false)
{
    foreach ($array as $key=>$subarray){
        if ($field==false){
            if (in_array($needle, $subarray))
            {
                return ($subarray);
            }
        }
        else{
            if ($subarray[$field]==$needle)
            {
                return ($subarray);
            }
        }
    }
    return [];
}

function inputname($p){
    $return="data[";
    $return.=$p['table'];
    $return.="][";
    $return.=$p['id'];
    $return.="][";
    $return.=$p['name'];
    $return.="]";
    return $return;
}
?>