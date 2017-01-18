<?php

$files = [
	'thirdparty/github-markdown-css.php',
	'thirdparty/Parsedown.php',
	'source/functions.php',
	'source/previewer.php',
];

foreach ($files as &$file) {
	$file = str_replace(['<?php','?>'], '', php_strip_whitespace($file));
}

file_put_contents(
	'markdown_preview',
	'#!/usr/bin/wxphp' . "\n" . '<?php ' . implode($files)
);
chmod('markdown_preview', 0755);