<?php

trait App
{
	static public function main(array $argv)
	{
		// Get Markdown file path from first argument in command line. Chech file existence by realpath().
		$markdownFilePath = (!empty($argv[1]) and $p = realpath($argv[1])) ? $p : false;

		// Ask user to choose Markdown file if it is not specified.
		if (!$markdownFilePath) {
			GUI::sayHello();
			($markdownFilePath = GUI::pickMarkdownFileToOpen()) or exit();
		}

		// Generate HTML file and show it.
		$HTMLPreviewFile = self::_generatePreview($markdownFilePath);
		GUI::showHTMLFile($HTMLPreviewFile, $markdownFilePath, $userWantsHTMLFile);

		// Copy HTML file to specified location if user selected this option.
		if ($userWantsHTMLFile) {
			($copyHTMLToPath = GUI::pickHTMLFileToSave()) or exit();
			copy($HTMLPreviewFile, $copyHTMLToPath);
		}
	}

	static private function _generatePreview($markdownFilePath)
	{
		$stylesheet = STYLESHEET_CSS_CODE;
		$title      = $markdownFilePath;
		$content    = (new Parsedown)->text(file_get_contents($markdownFilePath));

		$HTMLCode = <<< EOL
<!doctype html>

<meta charset="utf-8">
<meta name="Generator" content="Markdown preview & Parsedown">
<title>$title</title>

<style>$stylesheet</style>

$content
EOL;

		$HTMLPreviewFile = sys_get_temp_dir() . '/markdown_preview.html';
		register_shutdown_function(function(){
			@unlink(sys_get_temp_dir() . '/markdown_preview.html');
		});

		file_put_contents($HTMLPreviewFile, $HTMLCode);
		return $HTMLPreviewFile;
	}
}

// Start an application here.
App::main($argv);