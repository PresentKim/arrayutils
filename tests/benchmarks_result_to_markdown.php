<?php

const RESULT_JSON = __DIR__ . '/benchmarks_result.json';
const RESULT_MARKDOWN = __DIR__ . '/benchmarks_result.md';

if(!file_exists(RESULT_JSON)){
    die("File not found: " . RESULT_JSON . "\n");
}

$content = file_get_contents(RESULT_JSON);
$content = mb_convert_encoding($content, 'UTF-8', 'UTF-16');
$data = json_decode($content, true);

if(!$data){
    die("Failed to decode JSON\n");
}

$results = [];

foreach($data as $item){
    $method = str_replace('bench_', '', $item['subject']);
    $set = $item['set'];
    $mode = $item['mode'];

    if(!isset($results[$method])){
        $results[$method] = [];
    }

    $results[$method][$set] = $mode;
}

ksort($results);

// Generate MD
$md = "";

foreach($results as $method => $sets){
    $minTime = min($sets);

    $md .= "### $method\n\n";
    $md .= "| Set | Time (μs) | Percentage |\n";
    $md .= "| --- | --- | --- |\n";

    foreach($sets as $setName => $time){
        $percentage = ($time / $minTime) * 100;
        $md .= "| $setName | " . number_format($time, 3) . " | " . number_format($percentage, 2) . "% |\n";
    }

    $md .= "\n";
}

file_put_contents(RESULT_MARKDOWN, $md);
echo "Report generated in " . RESULT_MARKDOWN . "\n";
