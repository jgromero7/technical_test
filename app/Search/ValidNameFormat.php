<?php
namespace App\Search;

interface ValidNameFormat
{
    /**
     * @param $searchName
     * @param $baseName
     * @return boolean
     */
    public function ValidName($searchName, $baseName);

    /**
     * @param $dictionary
     * @param $searchName
     * @param $percentage
     * @return array
     */
    public function compareData ($dictionary, $searchName, $percentage);
    
}