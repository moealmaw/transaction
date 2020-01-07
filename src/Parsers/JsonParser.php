<?php

namespace Houston\Parsers;


use Exception;
use RuntimeException;

/**
 * Class JsonParser
 *
 * @package Houston\Parsers
 *
 * @author Mohammad Almawali <moealmaw@gmail.com>
 */
class JsonParser implements ParserInterface
{
    /**
     * @param $data
     *
     * @return array
     * @throws Exception
     */
    public function parse($data): array
    {
        $decoded = json_decode($data, true);

        if ( json_last_error() ) {
            throw new RuntimeException(json_last_error_msg());
        }

        return $this->transform($decoded);
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
            'taxes' => $transaction['taxes'],
        ];
    }
}