<?php

trait App
{
	static public function main(array $argv) : void
	{
		// Get Markdown file path from first argument in command line. Chech file existence by realpath().
		$markdownFilePath = (!empty($argv[1]) and $p = realpath($argv[1])) ? $p : false;

		// Ask user to choose Markdown file if it is not specified.
		if (!$markdownFilePath) {
			GUI::sayHello();
			($markdownFilePath = GUI::selectMarkdownFileToOpen()) or exit();
		}

		// Generate HTML file and show it.
		$HTMLPreviewFile = self::_generatePreview($markdownFilePath);
		GUI::showHTMLFile($HTMLPreviewFile, $markdownFilePath, $userWantsHTMLFile);

		// Copy HTML file to specified location if user selected this option.
		if ($userWantsHTMLFile) {
			($copyHTMLToPath = GUI::selectHTMLFileToSave()) or exit();
			copy($HTMLPreviewFile, $copyHTMLToPath);
		}
	}

	static private function _generatePreview(string $markdownFilePath) : string
	{
		$stylesheet = STYLESHEET_CSS_CODE;
		$content    = (new Parsedown)->text(file_get_contents($markdownFilePath));

		preg_match('/<h[1|2|3]>.*<\/h[1|2|3]>/', $content, $matches);
		$title = (!empty($matches[0])) ? trim(strip_tags($matches[0])) : $markdownFilePath;

		$HTMLCode = <<< EOL
<!doctype html>

<meta charset="utf-8">
<meta name="Generator" content="Markdown preview & Parsedown">
<title>$title</title>

<style>$stylesheet</style>

$content
EOL;

		$HTMLPreviewFile = tempnam(sys_get_temp_dir(), 'markdown_preview_');
		register_shutdown_function(function() use ($HTMLPreviewFile){
			@unlink($HTMLPreviewFile);
		});

		file_put_contents($HTMLPreviewFile, $HTMLCode);
		return $HTMLPreviewFile;
	}
}

// Start an application here.
App::main($argv);