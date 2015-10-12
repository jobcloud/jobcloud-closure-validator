# jobcloud-closure-validator

[![Build Status](https://api.travis-ci.org/jobcloud/jobcloud-closure-validator.png?branch=master)](https://travis-ci.org/jobcloud/jobcloud-closure-validator)
[![Total Downloads](https://poser.pugx.org/jobcloud/jobcloud-closure-validator/downloads.png)](https://packagist.org/packages/jobcloud/jobcloud-closure-validator)
[![Latest Stable Version](https://poser.pugx.org/jobcloud/jobcloud-closure-validator/v/stable.png)](https://packagist.org/packages/jobcloud/jobcloud-closure-validator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jobcloud/jobcloud-closure-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jobcloud/jobcloud-closure-validator/?branch=master)

## Features

A simple validator to check closure signatures.

## Requirements

PHP ~5.3

## Installation

Through [Composer](http://getcomposer.org) as [jobcloud/jobcloud-closure-validator][1].

## Usage

```{.php}
use Jobcloud\ClosureValidator\Parameter;
use Jobcloud\ClosureValidator\Validator;

$closure = function($param1, $param2) {};

$validator = new Validator;

$givenSignature = $validator->getSignatureFromClosure($closure);

$whishedSignature = new Signature(array(
    new Parameter('param1'),
    new Parameter('param2')
);

$diff = $validator->compare($givenSignature, $whishedSignature);

if (!$diff->isIdentical()) {
    throw new \Exception('Invalid closure signature');
}
```

[1]: https://packagist.org/packages/jobcloud/jobcloud-closure-validator
