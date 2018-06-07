# jobcloud-closure-validator

[![Build Status](https://api.travis-ci.org/jobcloud/jobcloud-closure-validator.png?branch=master)](https://travis-ci.org/jobcloud/jobcloud-closure-validator)
[![Total Downloads](https://poser.pugx.org/jobcloud/jobcloud-closure-validator/downloads.png)](https://packagist.org/packages/jobcloud/jobcloud-closure-validator)
[![Latest Stable Version](https://poser.pugx.org/jobcloud/jobcloud-closure-validator/v/stable.png)](https://packagist.org/packages/jobcloud/jobcloud-closure-validator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jobcloud/jobcloud-closure-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jobcloud/jobcloud-closure-validator/?branch=master)

## Features

A simple validator to check closure signatures.

## Requirements

PHP ~7.0

## Installation

Through [Composer](http://getcomposer.org) as [jobcloud/jobcloud-closure-validator][1].

## Usage

### Prepare

```{.php}
use Jobcloud\ClosureValidator\Parameter;
use Jobcloud\ClosureValidator\Signature;
use Jobcloud\ClosureValidator\Validator;

$closure = function($param1, $param2) {};

$validator = new Validator;

$givenSignature = $validator->getSignatureFromClosure($closure);

$wishedSignature = new Signature(
    [
        new Parameter('param1'),
        new Parameter('param2')
    ]
);
```

### Diff

```{.php}
$diff = $validator->compare($givenSignature, $wishedSignature);

if (!$diff->isIdentical()) {
    throw new \Exception('Invalid closure signature');
}
```

### Valid or exception

```{.php}
$validator->validOrException($givenSignature, $wishedSignature);
```

[1]: https://packagist.org/packages/jobcloud/jobcloud-closure-validator
