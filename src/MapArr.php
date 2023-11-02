<?php 
namespace TrueMe;

use TrueMe\Str;

class MapArr
{
    protected $results;

    protected $casing = 'camel';

    public function build($arr=[])
    {
        if (!$arr) return [];

        /*$i = 0;
        //echo '$i';
        array_walk_recursive($arr, function($item, $key) use (&$i)
        {
            echo '$i: ' . $i . '</br>';
            echo  '$key: ' . $key . '</br>';
            $i++;
            $this->set($this->varName($item), $item);
        });
*/
        /*$this->arrayWalkRecursive($arr, function() {
            //return $array;
        });*/
        $this->displayArrayRecursively($arr, null);

        var_dump($this->results);

        return $this;
    }

    public function displayArrayRecursively($array, $keysString = '')
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $this->displayArrayRecursively($value, $keysString . $this->varName($value) . '.');
            }
        } else {
            $this->results[rtrim($keysString, '.')] = $array;
        }
    }

    public function key2key($key='', &$temArr)
    {
        if (!$key) return [];

        $keyArr = explode('.', $key);

        foreach($keyArr as $i){
            $temArr[$i] = null;
        }

        return $this;
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