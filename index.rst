.. WebService - Quadratic Equation documentation master file, created by
   sphinx-quickstart on Sun Jun 21 23:13:07 2015.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

Dokumentacja: WebService - Rówanie kwadratowe!
===========================================================



PHP / Symfony2
-----------------

Projekt został wykonany w języku PHP przy użyciu framworka Symfony2.

Przy implementacji Web Servisu użyto biblioteki Zendframwork Zend-Soap.


Git
-----------------

Do wersjonowania użyto systemu Git i umieszczono projekt w repozytorium w serwisie GitHub:

https://github.com/shopsimple/webservice


Sphinx
------------------

Do wygenerowania dokumentacji użyto narzędzia Sphinx.

Główny plik umieszczony jest w katalogu:

/_build/html/index.html


Soap / WSDL
--------------------------

Web Service został umieszczony na serwerze:

http://ws1.ppiatek.linuxpl.eu/api/equation/quadratic?wsdl

Korzystanie z danego web service-u jest możliwe po pobraniu aplikacji z GitHub-a i zrobieniu update za pomoca Composer-a:

>> composer update 


Działająca wersja
--------------------------------

http://ws1.ppiatek.linuxpl.eu



Contents:

.. toctree::
   :maxdepth: 1

   src/index
   app/index





