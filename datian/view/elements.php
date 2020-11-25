<?php
//dynamic & static elements

/*function element($element, $p)
{
    include "elements/".$element.'.phtml';
}*/
/*function element($value='', $type='default', $name='', &$parameters=[])
{
    arr([$value, $type, $name]);
    $namestring='';
    if ($name!==''){
        $namestring=' name ="'.$name.'" ';
    }
    
    switch ($type)
    {
        case 'select':
            return '<select>'.$value.'<select>';
        case 'option':
            return '<option>'.$value.'<option>';
        case 'word':
            return '<p class="'.$type.'">' . $value . '</p>';
        case 'none':
            return '';
        case 'hidden':
            return '<input '.$namestring.' type="hidden" value="'.$value .'">';
        case 'text':
            return '<input '.$namestring.'type="text" value="'.$value.'">';
        case 'div':
            return '<div '.$namestring.'>'.$value.'</div>';
        case 'fix_submit':
            return '<button type="submit" '.$namestring.' value="create">'.$value.'</button>';
        case 'fix_post':
            return '<input '.$namestring.' type="hidden" value="'.$value.'">';
        case 'raw':
            return $value;
        default:
            return $value;
    }
}*/