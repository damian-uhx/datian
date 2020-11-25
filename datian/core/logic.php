
<?php
    function get($array) //first position = tablename, condition = condition
    {
        global $m;
        global $e;
        $return='';
        
        //set condition from all elements of array['where'] and get results
        $where=where2string($array['where']);
        $result=sql_get('SELECT * FROM '.$array['table'].$where.';');

        //foreach result
        foreach ($result as $index=>$entry)
        {
            //if index = 0: display hidden fkey
            inf('forresult:'.$index);
            $subquery='';
            $array['params']=array_merge(['id'=>$entry['id'], 'table'=>$array['table']], $array['params']);
            //display the row according to array
            foreach ($array['values'] as $key=>$value)
            {
                $model=get_model($array['table'], $key);
                if (substr($key,0,1)=='_') //if its a view wrapper
                {
                    if (substr($key,0,2)=='__') //if it's a single element without DB query
                    {
                        $subquery .= element(substr($key,2), $value);
                    }
                    else //if it's a wrapper of multiple columns (including foreign tables)
                    {
                        $subarray=$array; //
                        $subarray['values']=$value;
                        $subarray['where'][]='id='.$entry['id'];
                        $subarray['params']=$array['params']; 
                        $subarray['params']['value']=get($subarray);
                        $subquery .= element(substr($key,1), $subarray['params']);
                    }
                }
                elseif ($model[0]=='fkey' || $model[0]=='rkey' || is_numeric($key)) //if it's a foreign table or a new query
                {
                    $where=[];
                    $value['table']=$model[1];
                    /*if ($array['mode']=='editcreate'){

                    }
                    else if ($array['mode']=='create'){
                        $where=['id=0'];
                    }
                    else if ($array['mode']=='edit')
                    {
                        $where=['id>0'];
                    }*/
                    //if mode = create id=0;
                    //if else: id>0
                    
                    if ($model[0]=='fkey')
                    {
                        $where[]=$entry[$model[2]].'='.$entry[$model[1]];
                    } // 
                    elseif ($model[0]=='rkey')
                    {
                        $where[]=$model[2].'='.$entry['id'];
                        arr($model, 'rkey model');
                        $value['hidden']=[$model[2]=>$entry['id']]; //fkey=id
                    } //
                   

                    $value['where']=array_merge($where, $value['where']);
                    if (!isset($value['mode'])){$value['mode']=$array['mode'];}
                    
                    //OR id = 0 if editcreate???

                    //get each element of foreign table
                    $subquery.=get($value);
                    //if id>0: subquery.=fkey=id | e.g. user=1
                }
                else //if it is a value: wrap element
                {
                    $view = $value['mode'] ?? $e[$m[$array['table']][$key]][$array['mode']]; //mode
                    $array['params'] = array_merge($array['params'], ['id'=>$entry['id'], 'name'=>$key, 'value'=>$entry[$key]]);
                    $subquery .= element($view, $array['params']);
                }
            }
            //hidden fields
            if (isset($array['hidden']))
            {
                foreach ($array['hidden'] as $key=>$value)
                {
                    $subquery .= element('hidden', ['table' => $array['table'], 'id'=>0, 'name' => $key, 'value'=>$value]);
                }  
            }
            //wrap subquery if view is set
            if (isset($array['view']))
            {
                $array['params']['value']=$subquery;
                $return.=element($array['view'], $array['params']);
            }
            else
            {
                $return.=$subquery;
            }
            
        }
        arr($return);
        return $return;
        
    }

    function element($element, $p, $data=[])
    {
        if (file_exists("view/elements/".$element.'.phtml'))
        {
            ob_start();
            include("view/elements/".$element.'.phtml');
            return ob_get_clean();
        }
        else
        {    
            return $p['value'] ?? '?';
        }
    }


?>