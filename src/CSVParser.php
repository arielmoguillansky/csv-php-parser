<?php
include 'columnKeys.php';

class CSVParser {
    private $inputFile;
    private $outputFile;

    public function __construct($inputFile, $outputFile) {
        $this->inputFile = $inputFile;
        $this->outputFile = $outputFile;
    }

    public function parse() {
        if (empty($this->inputFile) || empty($this->outputFile)) {
            die("Usage: parser.php --file <input_file> --unique-combinations <output_file>");
        }

        $csvDataAsString = $this->csvFileToString($this->inputFile);

        $keyMapping = [
            'brand_name' => 'make',
            'model_name' => 'model',
            'colour_name' => 'colour',
            'gb_spec_name' => 'capacity',
            'network_name' => 'network',
            'grade_name' => 'grade',
            'condition_name' => 'condition',
        ];

        $result = $this->parseCSVData($csvDataAsString, $keyMapping);

        $outputFilePath = $this->outputFile;

        if ($this->createCSVFile($result, $outputFilePath)) {
            echo "CSV file created successfully: $outputFilePath \n";
        } else {
            echo "Error creating CSV file.\n";
        }

        echo "Parsing completed.\n";
    }

    private function csvFileToString($filePath) {
        print_r($filePath);
        // Check if the file exists
        if (file_exists($filePath)) {
            // Read the contents of the CSV file into a string
            $csvString = file_get_contents($filePath);

            // Return the CSV data as a string
            return $csvString;
        } else {
            // Handle the case where the file doesn't exist
            return false;
        }
    }

    private function createCSVFile($products, $outputFilePath) {
      if (empty($products)) {
          return false;
      }

      // Initialize an associative array to keep track of product counts
      $productCounts = [];

      // Prepare the data for CSV

      foreach ($products as $product) {
          // Convert the product data to a string for comparison
          $productString = implode(',', $product);

          if (!isset($productCounts[$productString])) {
              $productCounts[$productString] = 1;
          } else {
              $productCounts[$productString]++;
          }
      }

      foreach ($productCounts as $productString => $count) {
          $productData = explode(',', $productString);
          $productData[] = $count;
          $csvData[] = $productData;
      }

      // Create and write the CSV file
      $file = fopen($outputFilePath, 'w');

      if ($file) {
          foreach ($csvData as $row) {
              fputcsv($file, $row);
          }
          fclose($file);
          return true;
      } else {
          return false;
      }
    }

    private function parseCSVData($csvString, $keyMapping) {
      $lines = explode(PHP_EOL, $csvString);
      $data = [];

      foreach ($lines as $key => $line) {
          if (empty($line)) {
              continue;
          }
          $row = str_getcsv($line);

          // Use the first row as headers to map column names to their positions
          if ($key === 0) {
              $headers = $row;
              continue;
          }

          $object = [];

          foreach ($row as $index => $value) {
              // Map the object keys to the CSV headers using the provided mapping
              $header = $headers[$index];
              if (isset($keyMapping[$header])) {
                  $object[$keyMapping[$header]] = $value;
              }
          }

          $data[] = $object;
      }

      return $data;
    }
}