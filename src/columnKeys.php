<?php
// Set output file column names
$csvData[] = ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition', 'count'];

// Map column names from input file to new columns
$keyMapping = [
            'brand_name' => 'make',
            'model_name' => 'model',
            'colour_name' => 'colour',
            'gb_spec_name' => 'capacity',
            'network_name' => 'network',
            'grade_name' => 'grade',
            'condition_name' => 'condition',
        ];

