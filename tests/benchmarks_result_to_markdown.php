<?php

// Parse command line options
// -i / --input : Input XML file path
// -o / --output : Output Markdown file path
// -j / --json-output : Output JSON file path (Optional)
$options = getopt("i:o:j:", ["input:", "output:", "json-output:"]);

// Set file paths
$inputFile = $options['i'] ?? $options['input'] ?? __DIR__ . '/benchmarks_result.xml';
$outputMdFile = $options['o'] ?? $options['output'] ?? __DIR__ . '/benchmarks_result.md';

// Default JSON output path replaces .md extension with .json if not explicitly provided
$outputJsonFile = $options['j'] ?? $options['json-output'] ?? preg_replace('/\.md$/i', '.json', $outputMdFile);

if (!file_exists($inputFile)) {
    die("Error: Input file not found: " . $inputFile . "\n");
}

// Load and parse XML content
libxml_use_internal_errors(true);
$xml = simplexml_load_file($inputFile);

if ($xml === false) {
    die("Error: Failed to parse XML from " . $inputFile . "\n");
}

$results = [];

// Parse PHPBench XML structure (suite -> benchmark -> subject -> variant)
foreach ($xml->xpath('//subject') as $subject) {
    $method = str_replace('bench_', '', (string)$subject['name']);

    foreach ($subject->variant as $variant) {
        // Extract parameter set name
        $setName = 'default';
        if (isset($variant->parameter)) {
            $setName = (string)$variant->parameter['value'];
        } elseif (isset($variant['name'])) {
            $setName = (string)$variant['name'];
        }

        // Extract performance metric (mode time in microseconds)
        $time = 0.0;
        if (isset($variant->stats)) {
            $time = (float)($variant->stats['mode'] ?? $variant->stats['mean'] ?? 0.0);
        }

        if (!isset($results[$method])) {
            $results[$method] = [];
        }

        $results[$method][$setName] = $time;
    }
}

ksort($results);

// 1. Generate Structured Data Array for JSON Export
$jsonReportData = [];

foreach ($results as $method => $sets) {
    $minTime = min($sets);
    $setsData = [];

    foreach ($sets as $setName => $time) {
        $percentage = ($minTime > 0) ? ($time / $minTime) * 100 : 0.0;

        $setsData[] = [
            'set' => $setName,
            'time_us' => round($time, 3),
            'percentage' => round($percentage, 2)
        ];
    }

    $jsonReportData[] = [
        'subject' => $method,
        'min_time_us' => round($minTime, 3),
        'results' => $setsData
    ];
}

// Ensure output directory exists
$outputDir = dirname($outputMdFile);
if (!is_dir($outputDir)) {
    if (!mkdir($outputDir, 0755, true)) {
        die("Error: Failed to create output directory: " . $outputDir . "\n");
    }
}

// Save JSON Report
$jsonOutput = json_encode($jsonReportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
file_put_contents($outputJsonFile, $jsonOutput);
echo "Success: JSON Report generated at " . $outputJsonFile . "\n";

// 2. Generate Markdown Report
$md = "";

foreach ($results as $method => $sets) {
    $minTime = min($sets);

    $md .= "### $method\n\n";
    $md .= "| Set | Time (μs) | Percentage |\n";
    $md .= "| --- | --- | --- |\n";

    foreach ($sets as $setName => $time) {
        $percentage = ($minTime > 0) ? ($time / $minTime) * 100 : 0;
        $md .= "| $setName | " . number_format($time, 3) . " | " . number_format($percentage, 2) . "% |\n";
    }

    $md .= "\n";
}

// Save Markdown Report
file_put_contents($outputMdFile, $md);
echo "Success: Markdown Report generated at " . $outputMdFile . "\n";