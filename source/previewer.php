<?php

if (!extension_loaded('wxwidgets')) {
	exit('This application requires wxWidgets extension.'.PHP_EOL);
}

set_error_handler(function($n, $message){
	show_alert('PHP error', $message);
});



if (empty($argv[1])) {
	show_alert(
		'Markdown previewer',
		'This is an very simple application for viewing Markdown files.'."\n".
		'Close this dialog and pick Markdown file on your hard drive.'."\n".
		'You can also run this application with file path as argument.'."\n\n".
		'Written by Tomasz Gąsior — http://tomaszgasior.pl.'."\n\n".
		'Uses Parsedown as Markdown parser'."\n".
		'— http://parsedown.org.'."\n".
		'Uses GitHub Markdown CSS as preview stylesheet'."\n".
		'— http://sindresorhus.com/github-markdown-css.'
	);

	if (!$markdown_file_path = pick_markdown_file()) {
		exit;
	}
}

else {
	$markdown_file_path = $argv[1];

	if (!wxFileExists($markdown_file_path)) {
		show_alert(
			'File does not exists',
			'Markdown file'."\n\"".$markdown_file_path."\"\n".'does not exists.'
		);
		exit;
	}
}

$html_file_path = parse_markdown_file($markdown_file_path);
display_html_file($html_file_path, $markdown_file_path, !empty($argv[2]));