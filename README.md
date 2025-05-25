# PHPStan Rules

A collection of PHPStan rules.

## Requirements

* PHP 8.2+

## Installation

```
composer require odan/phpstan-rules:dev-master --dev
```

To use the PHPStan rules, you need to include the classes 
in your PHPStan configuration file `phpstan.neon`.

Just pick the rules you want:

```neon
rules:
	- Odan\PHPStan\Rules\AssignmentInConditionRule
	- Odan\PHPStan\Rules\YodaConditionRule
	- Odan\PHPStan\Rules\CyclomaticComplexityRule
```

If you want to include all rules, you have to include `rules.neon` in your project's PHPStan config:

```neon
includes:
	- vendor/odan/phpstan-rules/rules.neon
```

## Register CyclomaticComplexityRule in phpstan.neon

```neon
services:
    -
        class: YourNamespace\Rules\CyclomaticComplexityRule
        arguments:
            - 10 # Max allowed complexity
        tags:
            - phpstan.rules.rule

```

## Rules

* AssignmentInConditionRule
* YodaConditionRule
* CyclomaticComplexityRule

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
