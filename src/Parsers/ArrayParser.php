<?php

namespace Houston\Parsers;


use Exception;

/**
 * Class JsonParser
 *
 * @package Houston\Parsers
 *
 * @author Mohammad Almawali <moealmaw@gmail.com>
 */
class ArrayParser implements ParserInterface
{
    /**
     * @param $data
     *
     * @return array
     * @throws Exception
     */
    public function parse($data): array
    {
        return $this->transform($data);
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