<?php

trait GUI
{
	static private function _zenity(array $arguments = [])
	{
		// Check whether Zenity is installed.
		static $checked = false;
		if (!$checked and !shell_exec('which zenity 2> /dev/null')) {
			exit('This applications requires Zenity.'."\n");
		}
		$checked = true;

		// Remove Zenity icon from titlebar by setting unexistent icon.
		$arguments['window-icon'] = 'undefined';

		// Prepare arguments string.
		array_walk($arguments, function(&$value, $key){
			$value = '--' . $key . (($value == '') ? '' : '="' . $value . '"');
		});
		$arguments = implode(' ', $arguments);

		// Run Zenity. Use English messages for better consistence. Hide unwanted GTK error messages.
		// Return value returned by Zenity if is not empty. Otherwise, return true when exit code
		// was other than 0 or return false when exit code is equal to 0.
		exec('LC_MESSAGES=C zenity ' . $arguments . ' 2> /dev/null', $output, $code);
		return ($output) ? implode('', $output) : !(bool)$code;
	}

	static public function pickMarkdownFileToOpen()
	{
		return self::_zenity([
			'file-selection' => '',
			'file-filter'    => 'Markdown files (*.md) | *.md',
			'title'          => 'Choose Markdown file',
		]);
	}

	static public function pickHTMLFileToSave()
	{
		return self::_zenity([
			'file-selection'    => '',
			'file-filter'       => 'HTML documents (*.html) | *.html *.htm',
			'save'              => '',
			'confirm-overwrite' => '',
			'title'             => 'Choose locaction to save new HTML file',
		]);
	}

	static public function showHTMLFile($HTMLFilePath, $markdownFilePath, &$userWantsHTMLFile)
	{
		$clickedButton = self::_zenity([
			'text-info'    => '',
			'html'         => '',
			'filename'     => $HTMLFilePath,
			'title'        => str_replace((string)getenv('HOME'), '~', $markdownFilePath),
			'ok-label'     => 'Save HTML file',
			'cancel-label' => 'Close preview',
			'width'        => '1020',
			'height'       => '640',
		]);

		$userWantsHTMLFile = $clickedButton;
	}

	static public function sayHello()
	{
		$message = <<< 'EOL'
<span size='x-large'>Markdown previewer</span>\n\n
This is an very simple application for viewing Markdown files.\n
Close this dialog and pick Markdown file on your hard drive.\n
You can also run this application with file path as argument.\n\n
Uses Parsedown as Markdown parser\n
— <a href='http://parsedown.org'>http://parsedown.org</a>\n
Uses GitHub Markdown CSS as preview stylesheet\n
— <a href='http://sindresorhus.com/github-markdown-css'>http://sindresorhus.com/github-markdown-css</a>.\n\n
Written by Tomasz Gąsior — <a href='https://tomaszgasior.pl'>https://tomaszgasior.pl</a>.
EOL;

		self::_zenity([
			'info'      => '',
			'ellipsize' => '',
			'text'      => str_replace("\n", '', $message),
			'icon-name' => 'edit',
			'title'     => 'Markdown previewer',
			'ok-label'  => 'OK, go next!',
		]);
	}
}