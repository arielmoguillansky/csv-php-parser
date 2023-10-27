<?php
require_once __DIR__ . '/../src/CSVParser.php'; 

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase {
  public function testCSVParser() {
    // Set up test data and files
    $inputFile = 'examples/products_comma_separated.csv';
    $outputFile = 'test_output.csv';

    // Create an instance of the CSVParser class
    $parser = new CSVParser($inputFile, $outputFile);

    // Perform the parsing
    $parser->parse();

    // Assert that the output file exists
    $this->assertFileExists($outputFile);

  // Assert that the output file has the correct column names
    $expectedColumnNames = ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition', 'count'];
    $fileContent = file_get_contents($outputFile);

    foreach ($expectedColumnNames as $columnName) {
        $this->assertStringContainsString($columnName, $fileContent);
    }

    // Assert that the output file contains the expected data
    // $expectedData = '...'; // Replace with the expected content of the output file
    // $this->assertStringEqualsFile($outputFile, $expectedData);

    unlink($outputFile); // Remove the output file after testing
  }
  public function testIncorrectInput() {
    // Set up test data and files
    $incorrectInputFile = 'non_existent.csv';
    $outputFile = 'test_output.csv';

    // Create an instance of the CSVParser class
    $parser = new CSVParser($incorrectInputFile, $outputFile);

    // Use the @ operator to suppress die/exit in the script for testing
    // PHPUnit will capture the output for assertion
    ob_start();
    $parser->parse();
    $output = ob_get_clean();
    
    // Assertions
    // Assert that the output contains the expected error message
    $expectedErrorMessage = "Error creating CSV file.\n";
    $this->assertStringContainsString($expectedErrorMessage, $output);

    // Assert that the output file does not exist
    $this->assertFileDoesNotExist($outputFile);
  }
}
