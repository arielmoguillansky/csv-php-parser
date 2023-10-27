# CSV Parser

## Overview

The CSV Parser is a PHP script that reads a CSV file, performs data transformation, and writes the results to a new CSV file. This README provides information about how to use the parser, the CSVParser class, and the accompanying PHPUnit test.

## Table of Contents

- [Usage](#usage)
- [CSVParser Class](#csvparser-class)
- [Testing](#testing)

## Usage

### parser.php

The `parser.php` script is a command-line utility that accepts the following options:

- `--file`: The input CSV file path.
- `--unique-combinations`: The output CSV file path.

To run the parser, use the following command:

```shell
php parser.php --file <input_file> --unique-combinations <output_file>
```

### CSVParser Class

The CSVParser class encapsulates the functionality of the parser. You can use this class within your PHP code to perform CSV data processing.

### Testing

The PHPUnit test (CSVParserTest.php) is included to verify the functionality of the CSVParser class. It covers both correct and incorrect input scenarios. To run the tests, ensure PHPUnit is installed and execute the following command:

```shell
vendor/bin/phpunit CSVParserTest.php
```
