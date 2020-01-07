<?php

namespace Houston;

use Exception;
use Houston\Parsers\ArrayParser;
use Houston\Parsers\JsonParser;
use Houston\Parsers\ParserInterface;
use Houston\Parsers\XmlParser;
use RuntimeException;

class Transaction
{
    /**
     * @var array
     */
    private $_transaction = [];
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * Transactions constructor.
     *
     * @param ParserInterface $parser
     * @param $data
     *
     * @throws Exception
     */
    public function __construct(ParserInterface $parser, $data)
    {
        $transaction = $parser->parse($data);

        // the object can be validated using a schema validator on Transaction level
        if ( $this->validate($transaction) ) {
            $this->setTransaction($transaction);
        } else {
            throw new RuntimeException('Invalid transaction format');
        }

        // Type (Parser) specific validation (XML specific validation) can be triggered by each parser
        // $parser->validate / $parser->transform
    }

    /**
     * @return array
     */
    public function getTransaction(): array
    {
        return $this->_transaction;
    }

    /**
     * @param array $transaction
     */
    private function setTransaction(array $transaction): void
    {
        $this->_transaction = $transaction;
    }

    /**
     * @param $json
     *
     * @return Transaction
     * @throws Exception
     */
    public static function createFromJson($json): Transaction
    {
        return new Transaction(new JsonParser(), $json);
    }

    /**
     * @param array $data
     *
     * @return Transaction
     * @throws Exception
     */
    public static function createFromArray($data): Transaction
    {
        return new Transaction(new ArrayParser(), $data);
    }

    /**
     * @param string $xml
     *
     * @return Transaction
     * @throws Exception
     */
    public static function createFromXml($xml): Transaction
    {
        return new Transaction(new XmlParser(), $xml);
    }

    /**
     * Validate transaction after its parsed into an array
     *
     * @param $transaction
     *
     * @return mixed
     */
    public function validate(array $transaction)
    {
        //example validation to check the schema has the following keys:
        return $this->keysExist(['_id', 'taxes'], $transaction);
    }

    /**
     * Helper: Check if all given keys exist within the array
     *
     * @param array $keys
     * @param array $array
     *
     * @return bool
     */
    public function keysExist(array $keys, array $array): bool
    {
        return ! array_diff_key(array_flip($keys), $array);
    }
}
