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

        $this->displayArrayRecursively($arr, null);
        $this->results = $this->key2key($this->results);

        return $this;
    }

    /**
     * This function will convert dimension array to array with key is
     * conbine all keys of original array
     *
     * Example:
          // ORIGINAL ARRAY
          // array (size=6)
          //     0 => string 'word' (length=4)
          //     1 => string 'my name' (length=7)
          //     2 => 
          //       array (size=2)
          //         0 => string 'calander name 1' (length=15)
          //         1 => string 'calander name 2' (length=15)
          //     3 => string 'Monday' (length=6)
          //     4 => 
          //       array (size=2)
          //         0 => 
          //           array (size=2)
          //             0 => string 'week 1.1' (length=8)
          //             1 => 
          //               array (size=2)
          //                 0 => string 'week 1.2.1' (length=10)
          //                 1 => string 'week 1.2.2' (length=10)
          //         1 => string 'week 2' (length=6)
          //     5 => string 'key word' (length=8)
          ---->>
          // array (size=10)
          //     'hello' => string 'word' (length=4)
          //     'myName' => string 'my name' (length=7)
          //     'calander.subCal1' => string 'calander name 1' (length=15)
          //     'calander.subCal2' => string 'calander name 2' (length=15)
          //     'today' => string 'Monday' (length=6)
          //     'week.week1.week11' => string 'week 1.1' (length=8)
          //     'week.week1.week12.week121' => string 'week 1.2.1' (length=10)
          //     'week.week1.week12.week122' => string 'week 1.2.2' (length=10)
          //     'week.week2' => string 'week 2' (length=6)
          //     'keyWord' => string 'key word' (length=8)
     * 
     * @param  [type] $array      original array
     * @param  string $keysString - separator sign 
     *
     * @return avoid
     */
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

    /**
     * This function will convert explode string key
     *  into multidimensional array with value
     *
     *  Example
     *      + ORIGINAL ARRAY
     *          $array = [
     *              "main;header;up" => "main_header_up value",
     *              "main;header;bottom" => "main_header_bottom value",
     *              "main;bottom" => "main_bottom value",
     *              "main;footer;right;top" => "main_footer_right_top value"
     *          ];
     *      + CONVERTED ARRAY
     *          $array = [
     *              "main" => [
     *                  "header" => [
     *                      "up" => "main_header_up value", 
     *                      "bottom" => "main_header_bottom value"
     *                  ],
     *                  "bottom" => ["main_bottom value"],
     *                  "footer" => [
     *                      "right" => [
     *                          "top" => "main_footer_right_top value
     *                      ]
     *                  ]
     *              ]
     *          ];
     * 
     *@param  $array - original array
     * 
     *@return $result - destination array
     */
    public function key2key($array)
    {
        $result = [];

        foreach($array as $path => $value) {
            $temp =& $result;

            foreach(explode('.', $path) as $key) {
                $temp =& $temp[$key];
            }
            $temp = $value;
        }

        return $result;
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
        return $this->results[$name] = $value;
    }
}