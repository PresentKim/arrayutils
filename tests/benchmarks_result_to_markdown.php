<?php

// Parse command line options (Short options: -i, -o / Long options: --input, --output)
$options = getopt("i:o:", ["input:", "output:"]);

// Set input JSON file path (fallback to default path if not specified)
$inputFile = $options['i'] ?? $options['input'] ?? __DIR__ . '/benchmarks_result.json';

// Set output Markdown file path (fallback to default path if not specified)
$outputFile = $options['o'] ?? $options['output'] ?? __DIR__ . '/benchmarks_result.md';

if (!file_exists($inputFile)) {
    die("Error: Input JSON file not found: " . $inputFile . "\n");
}

$content = file_get_contents($inputFile);

// Handle encoding conversion safely to prevent JSON decode failures
$decodedContent = @mb_convert_encoding($content, 'UTF-8', 'UTF-16');
$data = json_decode($decodedContent ?: $content, true);

if (!$data) {
    die("Error: Failed to decode JSON from " . $inputFile . "\n");
}

$results = [];

foreach ($data as $item) {
    $method = str_replace('bench_', '', $item['subject']);
    $set = $item['set'];
    $mode = $item['mode'];

    if (!isset($results[$method])) {
        $results[$method] = [];
    }

    $results[$method][$set] = $mode;
}

ksort($results);

// Generate Markdown output
$md = "";

foreach ($results as $method => $sets) {
    $minTime = min($sets);

    $md .= "### $method\n\n";
    $md .= "| Set | Time (μs) | Percentage |\n";
    $md .= "| --- | --- | --- |\n";

    foreach ($sets as $setName => $time) {
        $percentage = ($time / $minTime) * 100;
        $md .= "| $setName | " . number_format($time, 3) . " | " . number_format($percentage, 2) . "% |\n";
    }

    $md .= "\n";
}

// Create output directory if it does not exist
$outputDir = dirname($outputFile);
if (!is_dir($outputDir)) {
    if (!mkdir($outputDir, 0755, true)) {
        die("Error: Failed to create output directory: " . $outputDir . "\n");
    }
}

file_put_contents($outputFile, $md);
echo "Success: Report generated at " . $outputFile . "\n";