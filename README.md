# Transactions Parser

The library helps consuming transaction data from different source (XML, JSON, Array).

Each type is consumed in Transaction class using a type-specific Parser (inside Parsers) that's injected into the Transaction class.

Note: Although validation is done (checking the existence of two keys (_id, taxes)) on the transaction schema after its parsed from its original format and converted to an associated array; more sophisticated validation can be still added on the transaction it self, for each type transformer, and/or validation can be injected as a service. I've just done it the best way I understood it for the scope of the requirements.

Transformer method: The provided XML and JSON samples don't fully match after parsing (XML data specifically has "element" key on taxes and some other array values), hence, a transform method is added to the parser where each type needs to extract data differently from other types.

### Usage

```php
<?php

use Houston\Parsers\JsonParser;
use Houston\Transaction;

require_once 'vendor/autoload.php';
```

```php
//load sample data
$jsonSample  = file_get_contents('./data_samples/transaction.json');
$xmlSample   = file_get_contents('./data_samples/transaction.xml');
$arraySample = include './data_samples/transaction.php';
```


Using factory method:
```php
//load from JSON
$jsonTrans = Transaction::createFromJson($jsonSample);

//load from XML
$xmlTrans = Transaction::createFromXml($xmlSample);

//load from Array
$arrTrans = Transaction::createFromArray($arraySample);


print_r($jsonTrans->getTransaction()['taxes']);
print_r($xmlTrans->getTransaction()['taxes']);
print_r($arrTrans->getTransaction()['taxes']);
```

Or using a custom parser:

```php
//load from cvsParser
$csvParser      = new csvParser();
$csvTransaction = new Transaction($csvParser, $csvSample);

print_r($jsonTransaction->getTransaction()['taxes']);
```

### Using this library

Clone the repo:
```bash
git clone git@github.com:moealmaw/transaction.git
```
Run composer install:

```bash
composer install  
```
Run example in index.php

```bash
php index.php
```