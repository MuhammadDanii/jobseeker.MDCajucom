<?php

/**
 * Get the base path of the project
 * * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . ltrim($path, '/');
}

/**
 * Load a view template and inject data variables
 * * @param string $name
 * @param array $data
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");
    
    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View '{$name}' not found at: {$viewPath}";
    }
}

/**
 * Load a partial template block (header, footer, nav, etc.)
 * * @param string $name
 * @return void
 */
function loadPartial($name)
{
    $partialPath = basePath("App/views/partials/{$name}.php");
    
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial '{$name}' not found at: {$partialPath}";
    }
}

/**
 * Inspect a value cleanly on screen (Die and Dump preview tool)
 * * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre class="bg-gray-800 text-white p-4 rounded">';
    var_dump($value);
    echo '</pre>';
}

/**
 * Format salary numeric string into clean currency display
 * * @param string|int|float $salary
 * @return string
 */
function formatSalary($salary)
{
    // Strip out any accidental dollar signs or commas someone might input
    $cleanSalary = preg_replace('/[^\d.]/', '', $salary);

    if (is_numeric($cleanSalary) && !empty($cleanSalary)) {
        return '$' . number_format(floatval($cleanSalary));
    }

    return $salary; // Fallback to raw text if they type something like "Negotiable" or "Commission"
}