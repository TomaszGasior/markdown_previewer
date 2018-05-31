<?php

trait GUI
{
	static private function _zenity(array $arguments = [], ?string &$output = null) : bool
	{
		// Check whether Zenity is installed.
		static $checked = false;
		if (!$checked and !shell_exec('which zenity 2> /dev/null')) {
			exit('This application requires Zenity to work.');
		}
		$checked = true;

		// Remove Zenity icon from titlebar.
		$arguments['window-icon'] = '/usr/share/icons/Adwaita/scalable/mimetypes/text-x-generic-symbolic.svg';

		// Prepare arguments string.
		array_walk($arguments, function(&$value, $key){
			$value = '--' . $key . (($value == '') ? '' : '="' . $value . '"');
		});
		$arguments = implode(' ', $arguments);

		// Run Zenity. Use English messages for better consistence. Hide unwanted GTK error messages.
		// Return true when user clicked OK button or false when user clicked Close button.
		exec('LC_MESSAGES=C zenity ' . $arguments . ' 2> /dev/null', $output, $code);
		$output = join($output);
		return !(bool)$code;
	}

	static public function selectMarkdownFileToOpen() : string
	{
		self::_zenity([
			'file-selection' => '',
			'file-filter'    => 'Markdown files (*.md) | *.md',
			'title'          => 'Choose Markdown file',
		], $filePath);

		return $filePath;
	}

	static public function selectHTMLFileToSave() : string
	{
		self::_zenity([
			'file-selection'    => '',
			'save'              => '',
			'confirm-overwrite' => '',
			'file-filter'       => 'HTML documents (*.html) | *.html *.htm',
			'title'             => 'Choose location for HTML document',
		], $filePath);

		return $filePath;
	}

	static public function showHTMLFile(string $HTMLFilePath, string $markdownFilePath, ?bool &$userWantsHTMLFile) : void
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

	static public function sayHello() : void
	{
		$message = <<< 'EOL'
<span size='x-large'>Markdown previewer</span>\n\n
<b>This is a very simple application for viewing Markdown files.\n
Close this dialog and choose a Markdown file on your hard drive.\n
You can also run this application with a file path as an argument.</b>\n\n
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
			'ok-label'  => 'OK, let\'s go!',
		]);
	}
}
