<?php
/**
 * ███
 * ███
 * ███    ██████    ██   ██    █████ ████     ██████     ████  ███   ██
 * ███  ███    ███  ██   ██   ██  ███  ███  ███    ██   ███    ███  ███
 * ███  ███    ███  ███  ███  ██   ██   ██  ███   ████  ███    ███████
 * ███    ██████     ████ █████    ██   ██   ██████ ██  ███    ███   ██
 *
 * Lowmark Zero: Reach the Bottom of Simplicity
 * A minimal Version of the Low-tech Markdown Website Generator
 *
 * File:         core.php
 * Version:      0.1-zero
 * Last updated: 2025-04-23
 * Homepage:     https://lowmark.de
 * Repository:   https://github.com/weitblick/lowmark_zero
 *
 * Description:  Load and render the requested Markdown page
 *               Converts the requested URI (e.g. "about.html") into a .md file path,
 *               verifies that it lies within the content directory, and processes it.
 *               This is the core logic of Lowmark – routing, security, and rendering
 *               of Markdown-based pages using frontmatter and ParsedownExtra.
 *
 * Lowmark is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Lowmark is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Lowmark. If not, see <https://www.gnu.org/licenses/>.
 *
 * Depends on:   Parsedown & ParsedownExtra from https://parsedown.org/
 */

$start_time = microtime(true); // Start render time

// Includes
include_once 'lowmark/frontmatter.php'; // Simple frontmatter parser
include_once 'lowmark/Parsedown.php'; // Markdown parser. Download from https://github.com/erusev/parsedown
include_once 'lowmark/ParsedownExtra.php'; // Markdown extra extension. Download from https://github.com/erusev/parsedown-extra

// Validate and resolve the content directory
// Ensures the 'content' folder exists and resolves its absolute path.
// This prevents the system from accessing unintended locations.

$lowmark['error'] = false; // Initialize error state

// Define base directory
$base_dir = realpath('content');
if ($base_dir === false) {
    http_response_code(500);
    $lowmark['error']   = true;
    $lowmark['title']   = 'Error 500';
    $lowmark['content'] = '<h2>Error 500</h2><p>Content directory not found</p>';
}

$uri = urldecode($_GET['q'] ?? 'index.html'); // Get uri from the GET parameter q, default: index.html

// Sanitize path
if (!$lowmark['error'] && preg_match('/[\x00-\x1F\x7F<>:"|?*]/', $uri)) {
    http_response_code(400);
    $lowmark['error']   = true;
    $lowmark['title']   = 'Error 400';
    $lowmark['content'] = '<h2>Error 400</h2><p>Invalid characters in filename</p>';
}

$converted_path = preg_replace('/\.html$/', '.md', $uri); // Convert .html to .md
$lowmark['home'] = ($converted_path === 'index.md'); // Identify the homepage

if (!$lowmark['error']) {
    $requested_path = realpath($base_dir . '/' . $converted_path); // Resolve requested file path
    // Error if base_dir is not part of requested_path
    if ($requested_path === false || strpos($requested_path, $base_dir) !== 0 || !is_file($requested_path)) {
        http_response_code(404);
        $lowmark['error']   = true;
        $lowmark['title']   = 'Error 404';
        $lowmark['content'] = '<h2>Error 404</h2><p>File not found</p>';
    }
}

// Load and process markdown only if no error so far
if (!$lowmark['error'] && is_file($requested_path)) { // No errors: check if the markdown file exists
    $markdown = file_get_contents($requested_path); // Read the content of the markdown file
    $resource = parse_frontmatter($markdown); // Get metadata (frontmatter and content) from markdown file

    // Merge Frontmatter values into $lowmark
    if (isset($resource['frontmatter']) && is_array($resource['frontmatter'])) {
        $lowmark = array_merge($lowmark, $resource['frontmatter']);
    }

    // Convert markdown content to HTML
    $Extra = new ParsedownExtra();
    if ($Extra instanceof ParsedownExtra) {
        $lowmark['content'] = $Extra->text($resource['content']);
    } else {
        $lowmark['content'] = $resource['content'];
    }
}

// Set base URL and canonical URL
$https = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || // Detect HTTPS via direct headers ...
    (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') // ... or proxy headers
);
$host = $_SERVER['HTTP_HOST']                         // Get host with port (e.g. example.com or localhost:8000)
?? ($_SERVER['SERVER_NAME'] ?? 'localhost');          // Fallback: server name or 'localhost'
$lowmark['base_url'] = ($https ? 'https' : 'http') . "://$host"; // Build full base URL (e.g. http://localhost:8000)
$lowmark['base_url'] = rtrim($lowmark['base_url'], '/');         // Remove trailing Slash
$lowmark['canonical_url'] = $lowmark['base_url'] . $_SERVER['REQUEST_URI']; // Build canonical URL

$end_time = microtime(true); // Determine the execution time of the script
$execution_time = ($end_time - $start_time) * 1000; // Convert to milliseconds

?>
