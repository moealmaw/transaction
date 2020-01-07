<?php

namespace Houston\Parsers;


use RuntimeException;
use SimpleXMLElement;

/**
 * Class JsonParser
 *
 * @package Houston\Parsers
 *
 * @author Mohammad Almawali <moealmaw@gmail.com>
 */
class XmlParser implements ParserInterface
{
    /**
     * @param $xml
     *
     * @return array
     */
    public function parse($xml): array
    {
        $data        = new SimpleXMLElement($xml, null, false);
        $transaction = json_decode(json_encode($data), true);
        $transformed = $this->transform($transaction);

        // type-specific validator
        if ( ! $this->validate($transformed) ) {
            throw new RuntimeException('Invalid XML data');
        }

        return $transformed;

    }

    /**
     * @param $transaction
     *
     * @return bool
     */
    public function validate($transaction): bool
    {
        //EXAMPLE validation, a more advanced validation techniques can be used to the requirements.

        return $transaction['taxes'][0]['inclusion_type'] === 'INCLUSIVE';
    }

    /**
     * @param $transaction
     *
     * @return array
     */
    public function transform(array $transaction): array
    {
        return [
            '_id'   => $transaction['_id'],
            'taxes' => $transaction['taxes']['element'],
        ];
    }
}