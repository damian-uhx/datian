<?php

$m2s=[
    'id'=>'none',
    'word'=>'varchar',
    'fkey'=>'int',
    'rkey'=>'none',
    'float'=>'float',
    'date'=>'date'
];

$s=[
    'varchar' => 'VARCHAR(255)',
    'int' => 'INT',
    'date' => 'DATE',
    'time' => 'TIME',
    'float' => 'FLOAT'
];


function init_sql()
{
    global $m;
    sql_set('DROP TABLE IF EXISTS `migration`;');
    sql_set('CREATE TABLE `migration`(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, table_name VARCHAR(255), field_name VARCHAR(255), field_type VARCHAR(255));');

    foreach ($m as $table=>$values)
    {
        reset_table($table);
    }
}

function alter_sql()
{
    global $m;
    foreach ($m as $table=>$columns)
    {
        $column_string='';
        $migrations=sql_get('SELECT * FROM migration WHERE table_name="'.$table.'";');
        arr($migrations, $table);
        if (empty($migrations)){
            reset_table($table);
        }
        arr($migrations, 'migrations');
        foreach ($columns as $name=>$type){
            $type=explode(':',$type)[0];
            $buffer=sql_type($type);
            arr($buffer, 'buffer');
            $migration=subarray_search($name, $migrations, 'field_name');
            arr($migration['field_type'], 'field_type');
            if (!empty($migration))
            {
                if (!empty($buffer)){
                    if ($migration['field_type']!==$buffer){
                        inf (sql_set ('ALTER TABLE '.$table.' MODIFY COLUMN '.$name.' '.$buffer.';'));
                        inf (sql_set ('UPDATE migration SET field_type = "'.$buffer.'" WHERE id = '.$migration['id'].';'));
                    }
                }
                else
                {
                    inf (sql_set ('ALTER TABLE '.$table.' DROP COLUMN '.$name.';'));
                }
            }
            else{
                if ($buffer){
                    inf (sql_set ('ALTER TABLE '.$table.' ADD '.$name.' '.$buffer.';'));
                    inf (sql_set ('INSERT INTO migration (table_name, field_name, field_type) VALUES ("'.$table.'", "'.$name.'", "'.$buffer.'");'));
                }
            }
        }
    }
}

function sql_type($type){
    global $m2s;
    global $s;
    return ($s[$m2s[$type]]) ?? false;
}

function reset_table($table){
    sql_set('DROP TABLE IF EXISTS `'.$table.'`;');
    sql_set('CREATE TABLE '.$table.'(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY);');
}

?>