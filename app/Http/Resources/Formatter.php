<?php

namespace App\Http\Resources;

use App\Http\Parser\SimpleXMLParser;
use Illuminate\Http\Resources\Json\Resource;

class Formatter extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (empty($request->input('outputType'))) {
            return parent::toArray($request);
        }

        if (
            !empty($request->input('outputType')) &&
            $request->input('outputType') == 'xml'
        ) {
            $xml = new SimpleXMLParser(parent::toArray($request));
            return $xml->getResult();
        }
    }
}
