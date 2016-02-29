<?php

// Adds ID attributes to all headers that are in fields processed by kirbytext.
function retitle($match) {
    // Characters in the $delete array will be removed
    // Characters in the $hyphenate array will be changed to hyphens
    $delete = c::get('headid-delete', array(':','(',')','?','.','!','$',',','%','^','&',"'",';','"','[',']','{','}','|','`','#'));
    $hyphenate = c::get('headid-hyphenate', array(' ','~','@','*','+','=','/','>','<'));

    list($_unused, $h2, $title) = $match;
    preg_match('/id=\"(.*)\"/',$_unused,$idmatches);
    preg_match('/name=\"(.*)\"/',$_unused,$namematches);

    if (empty($idmatches) && empty($namematches)) {
        $id = strip_tags($title);

        $id = strtolower(str_replace($delete,'',str_replace($hyphenate,'-',$id)));
        $id = preg_replace('/<\/?a[^>]*>/','',$id);
        return "<$h2 id='$id'><a href='#$id'>$title</a></$h2>";
    } elseif (!empty($idmatches) && empty($namematches)) {
        return "<$h2 $idmatches[0]><a href='#$idmatches[1]'>$title</a></$h2>";
    } elseif (empty($idmatches) && !empty($namematches)) {
        return "<$h2 id='$namematches[1]'><a href='#$namematches[1]'>$title</a></$h2>";
    }
}

// These filters run after all markdown and kirbytext is processed.
kirbytext::$post[] = function($kirbytext, $value) {
    $value = preg_replace_callback("#<(h[1-6]).*>(.*?)</\\1>#", "retitle", $value);
    return $value;
};
