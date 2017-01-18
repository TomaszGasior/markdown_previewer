Markdown previewer
===

Simple GUI application for previewing Markdown files. It is written in PHP and uses wxWidgets library by [wxPHP](http://wxphp.org/) extension. Requires wxPHP extension and WebKit engine installed. Tested on Linux.

Application uses third-party components:

* **Parsedown** as Markdown parser — [parsedown.org](http://parsedown.org),
* **GitHub Markdown CSS** as preview stylesheet — [sindresorhus.com/github-markdown-css](http://sindresorhus.com/github-markdown-css).

Run `wxphp main.php` to run application. It is possible to specify path of Markdown file as argument to directly open it.

If you want to use this application as single file, you can run `php prepare_application.php`. This script compiles all files of this project to one executable PHP script.