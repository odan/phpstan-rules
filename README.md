# PHPStan Rules

[![Latest Version on Packagist](https://img.shields.io/github/release/odan/phpstan-rules.svg)](https://packagist.org/packages/odan/phpstan-rules)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/odan/phpstan-rules.svg)](https://packagist.org/packages/odan/phpstan-rules/stats)

A collection of PHPStan rules.

## Requirements

* PHP 8.2+

## Installation

```
composer require odan/phpstan-rules --dev
```

To use the PHPStan rules, you need to include the classes 
in your PHPStan configuration file `phpstan.neon`.

Just pick the rule(s) you want:

```neon
rules:
	- Odan\PHPStan\Rules\AssignmentInConditionRule
	- Odan\PHPStan\Rules\YodaConditionRule
```

If you want to include all rules, you have to include `rules.neon` in your project's PHPStan config:

```neon
includes:
	- vendor/odan/phpstan-rules/rules.neon
```

## Register CyclomaticComplexityRule in phpstan.neon

Add a new service configuration and change the `maxComplexity` as needed.

```neon
services:
	-
		class: Odan\PHPStan\Rules\CyclomaticComplexityRule
		arguments:
			maxComplexity: 3
		tags:
			- phpstan.rules.rule

```

Note: If exists, remove the rule `Odan\PHPStan\Rules\CyclomaticComplexityRule` from the `rules:` section in `phpstan.neon`

## Rules

* AssignmentInConditionRule
* YodaConditionRule
* CyclomaticComplexityRule

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
