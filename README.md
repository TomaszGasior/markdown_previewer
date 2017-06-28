Markdown previewer
===

Simple GUI application for previewing Markdown files written in PHP. Requires GTK3 library, Zenity application and WebKit engine installed.

Application uses third-party components:

* **Parsedown** as Markdown parser — [parsedown.org](http://parsedown.org),
* **GitHub Markdown CSS** as preview stylesheet — [sindresorhus.com/github-markdown-css](http://sindresorhus.com/github-markdown-css).

Execute `php main.php` to start application. You can specify path of Markdown file as argument to directly open it.

If you want to use this application as single file, you can run `php prepare_application.php`. This script compiles all files of this project to one executable PHP script.