DropGal
=========
[![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/noidexe/DropGal?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

DropGal is an automatically generated image gallery/portfolio using Dropbox. 

INSTALL
-------
1.- Create a folder in your 'Dropbox/Public' directory.
2.- Copy tools/makefilelist.bat to the new folder.
3.- Edit config.php with your name, your dropbox id (what follows "https://dl.dropbox.com/u/" in public links) and your portfolio folder name.
4.- Upload index.php, config.php, lib/, templates/, and css/ to your website

USAGE
-----
Add images to your portfolio folder. Any folder you create inside your portfolio folder will become a category. Images in the root of the porfolio folder belong to the category "Home". Folder more than 1-level deep are ignored during category generation but its files are included.
Whenever you update your portfolio run makefile.bat and it will immediatly update in your site.


TODO
-----

DropGal is 100% Artist Code. If you refactor or reimplement it with pretty code send me a pull request.


TODO SOMETIME
-------------

- Make a version that uses the Dropbox API and doesn't need "dl.dropbox..." or batch files
