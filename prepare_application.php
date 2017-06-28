<?php

$files = [
	'thirdparty/github-markdown-css.php',
	'thirdparty/parsedown.php',
	'source/app.php',
	'source/gui.php',
];

foreach ($files as &$file) {
	$file = str_replace(['<?php','?>'], '', php_strip_whitespace($file));
}

file_put_contents(
	'markdown_preview',
	'#!/usr/bin/php' . "\n" . '<?php ' . implode($files)
);
chmod('markdown_preview', 0755);