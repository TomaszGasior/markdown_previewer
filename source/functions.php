<?php

function display_html_file($html_file_path, $markdown_file_path, $simple = false)
{
	$window = new wxFrame(null, null, null);
	$window->SetTitle(preg_replace('/^'.preg_quote(get_directory(),'/').'/', '~', $markdown_file_path));
	$window->SetSize(1000, 600);
	$window->SetSizeHints(500, 400);

	if ($simple) {
		$html_view = new wxHtmlWindow($window, 1);
		$html_view->AppendToPage(read_file_contents($html_file_path));
	}
	else {
		$browser_view = wxWebView::NewMethod();
		$browser_view->Create($window, 1, 'file://'.$html_file_path);
	}

	$window->Show();
	wxEntry();
}

function pick_markdown_file()
{
	$picker = new wxFileDialog(
		null, 'Select Markdown file to preview', get_directory(), null,
		'Markdown files (*.md)|*.md|All files|*'
	);

	if ($picker->ShowModal() == wxID_OK) {
		return $picker->GetPath();
	};
	return false;
}

function show_alert($title, $message)
{
	$dialog = new wxMessageDialog(null, $title, $title);
	$dialog->SetExtendedMessage($message);
	$dialog->ShowModal();
}

function parse_markdown_file($markdown_file_path)
{
	$parsed_markdown = (new Parsedown)->text(read_file_contents($markdown_file_path));
	$html_code = '<!doctype html><meta charset="utf-8"><style>' . get_stylesheet_code() . '</style>' . $parsed_markdown;

	$html_file_path = tempnam(sys_get_temp_dir(), 'markdown_') . '.html';
	file_put_contents($html_file_path, $html_code);

	register_shutdown_function(create_function(null, '@unlink(\''.$html_file_path.'\');'));

	return $html_file_path;
}

function read_file_contents($file_path)
{
	// open_baserdir workaround.
	$temp_file_path = tempnam(sys_get_temp_dir(), 'markdown_read_');
	$return = wxCopyFile($file_path, $temp_file_path) ? file_get_contents($temp_file_path) : false;

	unlink($temp_file_path);
	return $return;
}

function get_directory()
{
	if (getenv('HOME')) {
		return getenv('HOME');
	}
	elseif (getenv('HOMEPATH')) {
		return getenv('HOMEDRIVE') . getenv('HOMEPATH');
	}
	else {
		return getcwd();
	}
}