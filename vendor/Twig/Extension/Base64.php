<?php

/*
 * This file is part of Twig.
 *
 * (c) 2012 Angelo Lima
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Extension_base64 extends Twig_Extension
{
    protected $defaultStrategy;

    public function __construct()
    {
        
    }

    public function getFilters() {
        return array(
            'base64_encode' => new \Twig_Filter_Method($this, 'base64Encode'),
            'base64_decode' => new \Twig_Filter_Method($this, 'base64Decode'),
        );
    }

    public function getFunctions() {
        return array(
            'i_range' => new \Twig_Function_Method($this, 'iRange'),
        );
    }

    public function getName() {
        return 'addbuyer';
    }

   public function iRange($min,$max){
        $result = array();
        for ($i = $min; $i <= $max; $i++){
            $result[] = $i;
        }
        return $result;
    }

    public function base64Encode($str){
        return base64_encode($str);
    }

    public function base64Decode($str){
        return base64_decode($str);
    }
}