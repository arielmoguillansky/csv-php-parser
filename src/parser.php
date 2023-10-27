<?php
require_once 'CSVParser.php';

$shortOptions = "";
$longOptions = ["file:", "unique-combinations:"];
$options = getopt($shortOptions, $longOptions);
$inputFile = $options['file'] ?? '';
$outputFile = $options['unique-combinations'] ?? '';

if (empty($inputFile) || empty($outputFile)) {
    die("Usage: parser.php --file <input_file> --unique-combinations <output_file>");
}
// Create an instance of CSVParser
$parser = new CSVParser($inputFile, $outputFile);

// Call the parse method
$parser->parse();

