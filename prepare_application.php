<?php

$files = [
	'thirdparty/github-markdown-css.php',
	'thirdparty/parsedown.php',
	'source/gui.php',
	'source/app.php',
];

foreach ($files as &$file) {
	$file = str_replace(['<?php','?>'], '', php_strip_whitespace($file));
}

file_put_contents(
	'markdown_previewer',
	'#!/usr/bin/php' . "\n" . '<?php ' . implode($files)
);
chmod('markdown_previewer', 0755);