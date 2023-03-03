<?php
trait intHelper{

    public function clear_int($int):int
    {
        return preg_replace('/[[0-9]]/', '', $int);
    }
}