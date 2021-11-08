<?php

class Mylib_Encode
{

    public function password($value, $option = null)
    {
         $newPass = md5($value);
         return $newPass;
    }
}