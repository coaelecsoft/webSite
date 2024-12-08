<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\components;

Class WordToUrl{
    public  function wordToUrl($word){
    return strtolower(str_replace(array('č', 'Č', 'ć', 'Ć', 'š', 'Š', 'ž', 'Ž', 'đ', 'Đ', '?','!',',','.','@',':','(',')','|',' '), array('c', 'c', 'c', 'c', 's', 's', 'z', 'z', 'd', 'd', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'), $word));
}
}

