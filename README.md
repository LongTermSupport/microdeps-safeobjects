# MicroDeps/SafeObjects

MicroDeps are all about very small pieces of code that do a single small thing well

This MicroDep is for Safe Objects. This is an implementation of objects that prevent one particular foot gun - dynamic
properties.

This uses the magic `__get`, `__set` and `__isset` methods to intercept accesses to non existant properties and throws a
helpful exception - with a hint on which property you might have meant if it is a typo, or otherwise listing all public
properties.

## Installing

You can use Composer if you want to quickly test out the idea, though it is suggested that as this is so small - you
might be better just copy/pasting it into your first party code.

```
composer require lts/microdeps-safeobjects
```

## Developing

This package is intended to both be useful, and also to be an example of how to write modern well tested code utilising
the latest QA tools to enforce a high standard. You are encouraged to clone the repo and have a play with it and see how
it all works.

### PHP QA CI

This package is using PHP QA CI for the quality assurance and continuous integration. You can read more about that here:
https://github.com/LongTermSupport/php-qa-ci

#### To run QA process locally

To run the full QA process locally, simply run:

```bash
./bin/qa
```

## Long Term Support

This package was brought to you by Long Term Support LTD, a company run and founded by Joseph Edmonds

You can get in touch with Joseph at https://joseph.edmonds.contact/

Check out Joseph's recent book [The Art of Modern PHP 8](https://joseph.edmonds.contact/#book)
