# How to contribute #

In order to create and develop a great application, we need to follow a few rules.

## Commiting ##

Try to seperate your changes in as many commits as possible. Describe your changes shortly in the commit message's first line, then if needed, more detailed after a empty line.

## Writing to Changelog ##

Every change you made after version `v0.1.0` should be documented in the `CHANGELOG.md` in one of these categories:

- New Features
- Improvements (also Performance Improvements)
- Bug fixes (also Fixed Security Vulnerabilities)

After each changelog entry, write the author and commit's sha in brackets, e.g.:

```
New Features:
  MinePlus can be controlled via your mind! #1 (hice3000@4313a06)
``` 

*(In this example I also added a ticket that is solved with this change.)*

## Code Style ##

This are the most important rules, as we have to keep our code readable for each developer. To reach this goal, we need to follow these conventions:

**Variable Naming:**
```php
// INCORRECT:
$foo_bar = null;

// CORRECT:
$fooBar = null;
```
*Use camelCase in all your variables.*

**Method Naming:**
```php
// INCORRECT:
public function thisMethodGetsTheUsername() { /* ... */ }
public function get_username() { /* ... */ }

// CORRECT:
public function getUsername() { /* ... */ }
```
*Name your methods short and use camelCase.*

**Capitalization of Keywords**
```php
// INCORRECT:
$foo = NULL;
$bar = FALSE;
$fooBar = TRUE;

// CORRECT:
$foo = null;
$bar = false;
$fooBar = true;
```
*Lowercase special keywords.*

**Curly Braces**
```php
// INCORRECT:
class User {

    public function foo() {
        if ($bar)
        {
            /* ... */
        }
    }
    
}

// CORRECT:
class User
{

    public function foo()
    {
        if ($bar) {
            /* ... */
        }
    }

}
```
*Only create a new line for curly braces at classes, functions or methods. At control structures the curly brace should be in the same line*

**Indentation**

Don't use tabs, use 4 spaces instead.
