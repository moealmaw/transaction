<?php

namespace Houston\Parsers;

use Exception;

/**
 * Interface ParserInterface
 *
 * @package Houston\Parsers
 *
 * @author Mohammad Almawali <moealmaw@gmail.com>
 */
interface ParserInterface
{
    /**
     * @param $data
     *
     * @return array
     * @throws Exception
     */
    public function parse($data): array;

    /**
     * @param $transaction
     *
     * @return array
     */
    public function transform(array $transaction): array;
}