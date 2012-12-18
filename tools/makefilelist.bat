REM DropBox Public Lister
REM By Drale of drale.com
REM As seen on usefulgeek.com
REM ++++++++++++++++++++++++++
if exist dir.txt del dir.txt
dir /b /s /o:gen *.png *.jpg *.gif > dir.txt
REM dir /b /o:gen *.png *.jpg *.gif > dir.txt
