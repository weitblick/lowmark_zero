<?php
$lowmark = [
    'sitename'    => 'lowmark zero theme', // Title of the website
    'description' => 'Reach the bottom of simplicity – A minimalist version of the low-tech Markdown website generator.', // Default site description
    'title'       => '- undefined -', // Default page title (is normally set via frontmatter)
];
include_once 'lowmark/core.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= (!$lowmark['home'] ? $lowmark['title'] . " | " : '') . ($lowmark['sitename'] ?? 'Missing Site Name') ?></title>
<meta name="description" content="<?= htmlspecialchars($lowmark['description']) ?>">
<style>
body {
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    line-height: 1.6;
    color: #222;
    background: #fff;
    font-size: 1.2em;
}

.container {
    max-width: 750px;
    margin: 0 auto;
    padding: 0 1em;
}

header, footer {
    background: #f5f5f5;
    padding: 1em 0;
}

header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    max-width: 1072px;
}

header .h1 {
    margin: 0;
    font-size: 1.25em;
}

nav a {
    margin-left: 1em;
    text-decoration: none;
    color: #007acc;
}

nav a:hover {
    text-decoration: underline;
}

main {
    max-width: 750px;
    margin: 2em auto;
    padding: 0 1em;
}

footer .container {
    text-align: center;
    font-size: 0.9em;
    color: #666;
}

.footnotes, cite {
    font-size: 0.9em;
    color: #666;
}

.footnote-ref {
    font-size: 0.9em;
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
    line-height: 1.25;
    margin: 1.5em 0 0.5em;
}

p {
    margin: 1em 0;
}

ul, ol {
    margin: 1em 0 1em 1.5em;
    padding: 0;
}

li {
    margin: 0.25em 0;
}

a {
    color: #007acc;
}

blockquote {
    border-left: 4px solid #ccc;
    margin: 1em 0;
    padding-left: 1em;
    color: #555;
    font-style: italic;
}

code {
    background: #f2f2f2;
    padding: 0.2em 0.4em;
    border-radius: 3px;
    font-family: monospace;
}

pre {
    background: #f2f2f2;
    padding: 1em;
    overflow-x: auto;
    border-radius: 4px;
}

kbd {
    display: inline-block;
    padding: 0.2em 0.4em;
    font-size: 0.9em;
    font-family: monospace, monospace;
    color: #333;
    background-color: #f7f7f7;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-shadow: inset 0 -1px 0 #bbb;
}

img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 1em 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 1em 0;
}

th, td {
    border: 1px solid #ccc;
    padding: 0.5em;
    text-align: left;
}

th {
    background: #eee;
}

@media (max-width: 600px) {
    body {
        font-size: 1.05em;
    }
}

@media (prefers-color-scheme: dark) {
    body {
        background: #121212;
        color: #ddd;
    }

    header, footer {
        background: #1e1e1e;
    }

    nav a {
        color: #66b0ff;
    }

    a {
        color: #66b0ff;
    }

    blockquote {
        border-left-color: #444;
        color: #aaa;
    }

    code, pre {
        background: #2b2b2b;
        color: #ccc;
    }

    th {
        background: #2a2a2a;
    }

    td, th {
        border-color: #444;
    }
}


@media print {
    header, footer, nav {
        display: none;
    }

    body {
        background: white;
        color: black;
        font-size: 12pt;
    }

    main {
        margin: 0;
        padding: 0;
        max-width: 100%;
    }

    a::after {
        content: " (" attr(href) ")";
        font-size: 90%;
    }

    img {
        max-width: 100%;
        height: auto;
        page-break-inside: avoid;
    }

    table {
        page-break-inside: avoid;
    }
}
</style>
</head>
<body>

<header>
<div class="container">
<a href="/" title="Home" style="color: inherit;"><svg style="width: 150px; height: auto;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 810 178" alt="Example logo of lowmark – copyright by https://lowmark.de"><style>.cls-1{fill:currentColor;stroke-width:0px;}</style><path class="cls-1" d="M552.17,55.47c-20.3,0-56.18,10.87-58.29,56.75-2.1,45.88,19.02,59.67,40.75,59.67s44.75-19.22,44.75-19.22v19.22h29.83v-67.2s-5.49-49.21-57.05-49.21ZM535.16,143.29c-10.2,0-10.2-12.87-10.2-12.87v-18.2s1.08-26.14,27.22-26.14c23.68,0,27.22,22.81,27.22,26.14s-30.91,31.06-44.24,31.06ZM37.06,172.04H5V4.96h32.06v167.09ZM120.05,55.58c-32.44,0-58.73,26.3-58.73,58.73s26.3,58.73,58.73,58.73,58.73-26.3,58.73-58.73-26.3-58.73-58.73-58.73ZM120.05,142.83c-15.75,0-28.51-12.77-28.51-28.51s12.77-28.51,28.51-28.51,28.51,12.77,28.51,28.51-12.77,28.51-28.51,28.51ZM470.9,98.53v74.03h-30.76l.13-73.98s-2.55-10.71-14.38-10.69c-11.85.03-14.69,10.69-14.69,10.69l.08,73.98h-31.01l.03-73.9s-3.38-10.79-14.46-10.85c-11.08-.04-14.07,10.77-14.07,10.77v32.14s0,41.84-45.31,41.84c-18.66,0-29.43-11.59-29.43-11.59,0,0-9.22,11.59-30.55,11.59-45.11,0-45.11-41.84-45.11-41.84V63.26h30.76l-.13,67.42s2.53,10.71,14.38,10.68c11.84-.02,14.68-10.68,14.68-10.68l-.08-67.42h31.01l-.02,67.34s3.38,10.79,14.45,10.83c11.08.06,14.07-10.76,14.07-10.76v-32.15s0-41.83,45.32-41.83c18.66,0,29.42,11.58,29.42,11.58,0,0,9.24-11.58,30.56-11.58,45.11,0,45.11,41.83,45.11,41.83ZM693.04,86.08s-14.56,0-18.25,0c-7.92,0-10.05,7.2-10.05,9.89v75.92h-30.91v-78.12c0-11.23,9.38-36.91,33.68-36.91h25.53v29.22ZM744.56,98.84c17.17,0,29.22-14.16,29.22-23.84v-18.15h31.22v18.15c0,23.84-18.95,39.37-18.95,39.37,0,0,18.95,15.69,18.95,39.68s0,17.84,0,17.84h-31.22v-17.84c0-15.5-18.59-23.99-29.22-23.99v41.83h-31.83V56.86h31.83v41.98Z"/></svg></a>
<nav>
<a href="/">Home</a>
<a href="/example.html">Example Page</a>
</nav>
</div>
</header>

<main>
<?= $lowmark['content'] ?>
</main>

<footer>
<div class="container">
<p>powered by <a href="https://lowmark.de" target="_blank">lowmark</a> – <a href="legal.html">Legal Notice</a> – <a href="privacy.html">Privacy Policy</a></p>
</div>
</footer>

</body>
</html>
