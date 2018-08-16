<?php
/**
 * Created by PhpStorm.
 * User: sana
 * Date: 16.08.18
 * Time: 18:14
 */

namespace App\Http\Parser;


use function MongoDB\BSON\toJSON;

class SimpleXMLParser
{
    /**
     * @var string
     */
    private $message = "Not data found";


    /**
     * @var SimpleXMLElement
     */
    private $xml;

    public function __construct($data)
    {
        $this->xml = new \SimpleXMLElement('<root/>');
        if (!empty($data) && is_array($data)) {
            $this->parseData($data);
        } else {
            $this->xml->addChild('item', $this->message);
        }

    }

    private function parseData($data)
    {
        foreach ($data as $k=>$v) {
            if (is_array($v) || $v instanceof \stdClass) {
                $this->parseData($v);
            } else {
                $this->xml->addChild($k, $v);
            }
        }
    }

    public function getResult()
    {
        return $this->xml->asXML();
    }

}