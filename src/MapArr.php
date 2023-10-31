<?php 
namespace TrueMe;

use TrueMe\Str;

class MapArr
{
    protected $results;

    protected $key = '';
    protected $dimensionKey = '';
    protected $isArr = false;

    protected $casing = 'camel';

    //protected $recursiveName = null;

    protected $i = 0;

    public function build($arr=[])
    {
        if (!$arr) return [];

        $this->arrayWalkRecursive($arr, function() {
            //return $array;
        });

        return $this;
    }


    public function arrayWalkRecursive(array &$array, callable $callback)
    {
        echo '--------------kkk' . '</br>';
        foreach ($array as $k => &$v) {
            //if (!$this->dimensionKey) $this->dimensionKey = $this->varName($v);

            if (is_array($v)) {
                echo '$i: ' . $this->i; echo ' is_array . </br>';

                $this->dimensionKey = $this->varName($v);

                $this->results[$this->varName($v)] = null;
                $this->isArr = true;

                $this->arrayWalkRecursive($v, $callback);
            } else {
                echo '$i: ' . $this->i; echo ' no array . </br>';

                $this->dimensionKey = $this->dimensionKey && $this->isArr ? $this->dimensionKey . '.' . $this->varName($v) : $this->varName($v);
                //if ($k == 1) $this->i = str_replace('.0', '', $this->i);
                
                $this->set($this->varName($v), $v);
                $callback($v, $k, $array);

                //$this->i++;
            }
            //var_dump($k, $v, '$i = ' . $this->i);
            echo 'key: ' . $this->dimensionKey . '</br>';
            $this->i++;
        }

        $this->isArr = false;
        //$this->recursiveName = null;
    }

    public function camel()
    {
        $this->casing = 'camel';

        return $this;
    }

    public function snake()
    {
        $this->casing = 'snake';

        return $this;
    }

    public function isSnake()
    {
        if ($this->casing === 'snake') return true;

        return false;
    }

    public function isCamel()
    {
        if ($this->casing === 'camel') return true;

        return false;
    }

    public function varName($var)
    {
        foreach($GLOBALS as $varName => $value) {
            if ($value === $var) {
                return $this->key = $this->isCamel() ? Str::camel($varName) : Str::snake($varName);
            }
        }

        return false;
    }

    public function get()
    {
        return $this->results;
    }


    public function set($name, $value)
    {
        //if ($this->recursiveName) return $this->results[$this->recursiveName][$name] = $value;

        return $this->results[$name] = $value;
    }
}