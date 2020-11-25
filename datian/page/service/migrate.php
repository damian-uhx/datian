<?php
if (isset($_POST['alldelete']))
{
include './core/migration.php';

init_sql();

alter_sql();
}
else{
    echo 'If you really want to delete everything:
    Please provide a variable called "alldelete" as POST variable. 
    All Database content will be deleted.';
}

?>