## Description

A collection of PHPStan rules.

## Requirements

* PHP 8.0+

## Installation

```
composer require odan/phpstan-rules --dev
```

To use the PHPStan rules, you need to include the classes 
in your PHPStan configuration file `phpstan.neon`.

```neon
services:
- class: Odan\PHPStan\Rules\AssignmentInConditionRule
  tags: [ phpstan.rules.rule ]
  
- class: Odan\PHPStan\Rules\YodaConditionRule
  tags: [ phpstan.rules.rule ]
```

## Rules

* AssignmentInConditionRule
* YodaConditionRule

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
