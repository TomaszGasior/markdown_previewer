<?php
# MIT © Sindre Sorhus
# https://github.com/sindresorhus/github-markdown-css/
#
# The MIT License (MIT)
#
# Copyright (c) Sindre Sorhus <sindresorhus@gmail.com> (sindresorhus.com)
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.
function get_stylesheet_code()
{
	return <<< 'EOL'
hr,img{box-sizing:content-box}body::after,body::before,hr::after,hr::before{display:table;content:""}a,a:not([href]){text-decoration:none}hr,svg:not(:root){overflow:hidden}img,table tr{background-color:#fff}pre,table{overflow:auto}dl,dl dt,hr,pre code,pre>code,td,th{padding:0}input,pre code{overflow:visible}pre,pre code{word-wrap:normal}body{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;color:#333;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";font-size:16px;line-height:1.5;word-wrap:break-word;margin:2em 4.5vw 2.5em}a{background-color:transparent;-webkit-text-decoration-skip:objects;color:#4078c0}a:active,a:hover{outline-width:0;text-decoration:underline}h1{margin:.67em 0}img{border-style:none;max-width:100%}h1,h2{padding-bottom:.3em;border-bottom:1px solid #eee}input{font:inherit;margin:0;font-family:inherit;font-size:inherit;line-height:inherit}*{box-sizing:border-box}strong{font-weight:600}body::after,hr::after{clear:both}table{border-spacing:0;border-collapse:collapse;display:block;width:100%}blockquote{margin:0;padding:0 1em;color:#777;border-left:.25em solid #ddd}ol ol,ul ol{list-style-type:lower-roman}ol ol ol,ol ul ol,ul ol ol,ul ul ol{list-style-type:lower-alpha}dd{margin-left:0}code{font-family:Consolas,"Liberation Mono",Menlo,Courier,monospace}pre{font:12px Consolas,"Liberation Mono",Menlo,Courier,monospace}input{-webkit-font-feature-settings:"liga" 0;font-feature-settings:"liga" 0}body>:first-child{margin-top:0!important}body>:last-child{margin-bottom:0!important}a:not([href]){color:inherit}blockquote,dl,ol,p,pre,table,ul{margin-top:0;margin-bottom:16px}hr{background:#e7e7e7;height:.25em;margin:24px 0;border:0}blockquote>:first-child{margin-top:0}blockquote>:last-child{margin-bottom:0}h1,h2,h3,h4,h5,h6{margin-top:24px;margin-bottom:16px;font-weight:600;line-height:1.25}dl dt,table th{font-weight:700}h1 code,h1 tt,h2 code,h2 tt,h3 code,h3 tt,h4 code,h4 tt,h5 code,h5 tt,h6 code,h6 tt{font-size:inherit}h1{font-size:2em}h2{font-size:1.5em}h3{font-size:1.25em}h4{font-size:1em}h5{font-size:.875em}h6{font-size:.85em;color:#777}ol,ul{padding-left:2em}ol ol,ol ul,ul ol,ul ul{margin-top:0;margin-bottom:0}li>p{margin-top:16px}li+li{margin-top:.25em}dl dt{margin-top:16px;font-size:1em;font-style:italic}dl dd{padding:0 16px;margin-bottom:16px}table td,table th{padding:6px 13px;border:1px solid #ddd}table tr{border-top:1px solid #ccc}table tr:nth-child(2n){background-color:#f8f8f8}code{padding:.2em 0;margin:0;font-size:85%;background-color:rgba(0,0,0,.04);border-radius:3px}code::after,code::before{letter-spacing:-.2em;content:"\00a0"}pre>code{margin:0;font-size:100%;word-break:normal;white-space:pre;background:0 0;border:0}pre{padding:16px;font-size:85%;line-height:1.45;background-color:#f7f7f7;border-radius:3px}pre code{display:inline;max-width:auto;margin:0;line-height:inherit;background-color:transparent;border:0}pre code::after,pre code::before{content:normal}kbd{display:inline-block;padding:3px 5px;font:11px Consolas,"Liberation Mono",Menlo,Courier,monospace;line-height:10px;color:#555;vertical-align:middle;background-color:#fcfcfc;border:1px solid #ccc;border-bottom-color:#bbb;border-radius:3px;box-shadow:inset 0 -1px 0 #bbb}hr{border-bottom-color:#eee}
EOL;
}