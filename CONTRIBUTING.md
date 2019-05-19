# Developer guide

## Issues

- **Please search internet first to find the answer.**
- If a similar issue exists, append comment to it.
- If there are multiple issues, make issues separately.
- If you find a security vulnerability, please send an email to the maintainers before it is exposed to bad crackers.
- **Please Check below before report a bug.**
  - Browser type, version
  - PHP version
  - Server configurations
- **Please include below information in bug report.**
  - Environment
    - "Can I Graduate?" version, e.g. 1.0.0
    - Browser type, version, e.g. IE 11
    - PHP version, e.g. 7.0.0
    - Server information, e.g. Amazon AWS t2.micro
  - Entire error message
    - Web page screenshots
    - Screenshots of console, network tab in browser developer tool.
  - Website addess which shows the problem

## Pull requests (PR)

- Make a topic branch in your forked repository and do your jobs then send PR to `develop` branch of this original repository.
  - Branch naming rule: `do/something` form.
    "do" part is an appropriate verb, "something" part is a description which implies the detail of the PR.
    If you can't find intutive "do" part verb, just simply use `pr/something` form.
  - Example: If you solve a bug related to icons, make `fix/icon` branch and do your jobs.
    If you improved network related features, make `pr/network` branch and do your jobs.

## Coding style guide

### General

Character set of all kinds of text files including PHP, HTML, CSS, JS, XML are UTF-8 without BOM.

Line break type is Unix(`LF`).

Indent with a tab.

Empty lines are not indented.

PHP source files which contains PHP codes only do not append `?>` tag at the end of the file.

### Whitespace / Line break

Use brace at the next line in case of class, function declarations and `if`, `for`, `foreach`, `while`.

    class Foo
    {                              // RIGHT
        public function bar() {    // WRONG
            
        }
    }

### Comment

Leave comments above the related codes.

    // If foo is bar, do something.
    if ($foo->isBar())
    {
        // Note: this will do X, Y, and Z.
        $foo->doSomething();
    }
    // Otherwise, do something else.
    else
    {
        // TODO: Refactor this later.
        $foo->doSomethingElse();
    }

Leave Doxygen style comments to every classes and functions.

    /**
     * This is the Foo class.
     */
    class Foo
    {
        /**
         * Constructor.
         *
         * @param string $member_srl
         */
        public function __construct($member_srl)
        {
            // 생략
        }
        
        /**
         * Check if this Foo is bar.
         *
         * @return bool
         */
        public function isBar()
        {
            return true;
        }
    }

### Etc.

In case of the situations which is not included in here, follow
[PSR-1](http://www.php-fig.org/psr/psr-1/),
[PSR-2](http://www.php-fig.org/psr/psr-2/).
