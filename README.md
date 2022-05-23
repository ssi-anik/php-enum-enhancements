anik/php-enum-enhancements
[![codecov](https://codecov.io/gh/ssi-anik/php-enum-enhancements/branch/main/graph/badge.svg?token=9E9465CPPA)](https://codecov.io/gh/ssi-anik/php-enum-enhancements)
[![PHP Version Require](http://poser.pugx.org/anik/php-enum-enhancements/require/php)](//packagist.org/packages/anik/php-enum-enhancements)
[![Latest Stable Version](https://poser.pugx.org/anik/php-enum-enhancements/v)](//packagist.org/packages/anik/php-enum-enhancements)
===

**anik/php-enum-enhancements** provides a few methods to retrieve keys, values or kv pair on PHP Enums.

# Documentation

## Installation

To install the package, run
> composer require anik/php-enum-enhancements

## Usage

Use the `Anik\PhpEnumEnhancements\Enhancement` trait in any of your Enum, and you'll have access to the following method.

```php

# [\UnitEnum | \BackedEnum ]::case->getName(/* null or callable */)
# \BackedEnum::case->getValue(/* null or callable */)
# [\UnitEnum | \BackedEnum ]::names(/* null or callable */)
# \BackedEnum::values(/* null or callable */)
# \BackedEnum::kvPair(
        /* nameCallback: null or callable, */ 
        /* valueCallback: null or callable, */ 
        /* valueAsKey: bool */
#   )
```

## Examples

For the enum below,

```php
enum PostStatus: string {
    use \Anik\PhpEnumEnhancements\Enhancement;
    
    case DRAFT = 'draft';
    case UNDER_REVIEW = 'under_review';
    case PUBLISHED = 'published';
}
```

- `PostStatus::DRAFT->getName()` will return `"DRAFT"` .
- `PostStatus::DRAFT->getName('strtolower')` will return `"draft"` .
- `PostStatus::DRAFT->getValue()` will return `"draft"` .
- `PostStatus::DRAFT->getValue('ucfirst')` will return `"Draft"` .

- `PostStatus::names()` will return `[ "DRAFT", "UNDER_REVIEW", "PUBLISHED", ]` .
- `PostStatus::names('strtolower')` will return `[ "draft", "under_review", "published", ]` .

- `PostStatus::values()` will return `[ "draft", "under_review", "published", ]` .
- `PostStatus::values('ucfirst')` will return `[ "Draft", "Under_review", "Published", ]` .

- `PostStatus::kvPair()` will
  return `[ "draft" => "DRAFT", "under_review" => "UNDER_REVIEW", "published" => "PUBLISHED", ]` .
- `PostStatus::kvPair(nameCallback: 'strtolower')` will
  return `[ "draft" => "draft", "under_review" => "under_review", "published" => "published", ]` .
- `PostStatus::kvPair(valueCallback: 'ucfirst')` will
  return `[ "Draft" => "DRAFT", "Under_review" => "UNDER_REVIEW", "Published" => "PUBLISHED", ]` .
- `PostStatus::kvPair(valueAsKey: false)` will
  return `[ "DRAFT" => "draft", "UNDER_REVIEW" => "under_review", "PUBLISHED" => "published", ]`
  in **['NAME_OF_ENUM' => 'VALUE OF ENUM']** format.

# Issues?

If you find any issue/bug/missing feature, please submit an issue and PRs if possible. 
