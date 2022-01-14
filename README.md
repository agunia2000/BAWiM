# Intro
Aplikacja webowa sprzedaj.pl by Amadeusz Gunia & Marek Kwak przygotowana w ramach projektu z przedmiotu Bezpieczeństwo aplikacji webowych i mobilnych.

# Przygotowanie środowiska
* Zainstaluj XAMPP
	- Apache
	- MySQL
* Uruchom XAMPP i ww. usługi
* Otwórz panel phpMyAdmin
* Utwórz nową bazę danych o nazwie bawim
* Zaimportuj zrzut bazy danych bawim.sql
* Usuń domyślną zawartość folderu htdocs i przenieś do niego pliki naszej aplikacji
* Otwórz przeglądarkę internetową (np. Chrome) i wpisz w niej adres localhost lub adres IP swojego komputera
* Dodatkowo (jeśli korzystasz w Windowsa) przygotuj maszynę wirtualną z zainstalowanym systemem Linux

# Zadania
## Zadanie 1
* Zaloguj się na konto sprzedawca@agh.pl nie znając hasła. Wykorzystaj do tego podatność SQL Injection.

* Przydatne informacje dot. MySQL:
	- 'tralalala'  
	- -- komentarz 
	- ; koniec zapytania 

* Jako odpowiedź do tego zadania prześlij zrzut ekranu zawierający stronę logowania z wypełnionymi i widocznymi polami email i hasło.

## Zadanie 2
* Napraw logowanie wykorzystując tzw. spreparowane instrukcje.

* Konstrukcja prepared statement:
	- $stmt = $dbh->prepare("SELECT * FROM table_name WHERE col = :var");
	- $stmt->execute([':var' => $php_var]);

* Można także przenieść weryfikację hasła poza zapytanie SQL.

* Jako odpowiedź do tego zadania prześlij zrzut ekranu zawierający fragment poprawionego kodu - plik login.php.

## Zadanie 3
* Załóżmy, że udało Ci się przechwycić hasła użytkowników. Spróbuj je złamać mając na uwadze, że serwis używa przestarzałego algorytmu do hashowania - MD5. Hasła znajdują się w pliku passwords.txt.

* Potrzebne narzędzia:
	- Virtual Box lub VMware player + Linux (dowolny)
	- narzędzie do łamania haseł - John the Ripper, Hashcat lub inne
	- instalacja: sudo apt-get install john -y

* Jako odpowiedź do tego zadania prześlij zrzut ekranu zawierający rozszyfrowane hasła.

* Przydatne strony:
	- czy hasło kiedyś wyciekło - https://haveibeenpwned.com/Passwords
	- czy hasło jest mocne - https://www.passwordmonster.com

## Zadanie 4
* Prześlij do bazy danych złośliwy kod i użyj go w niecny sposób wykorzystując podatność cross-site scripting.

* Idealnym miejscem do tego ataku będzie strona dodawania ogłoszeń. Znajdź pole gdzie możesz wprowadzić dużo tekstu. Napisz skrypt JS, który np. pokoloruje element strony lub wyświetli przerażający alert.

* Ważne: kodem pocztowym w Twoim ogłoszeniu musi być 00-000

* Jako odpowiedź do tego zadania prześlij zrzut ekranu obrazujący wykonanie Twojego złośliwego kodu - localhost/xss.

* Podpowiedź: Jeśli nie masz pomysłu - poszukaj na stack'u.

## Zadanie 5 
* Twig zapewnia zabezpieczenie przed XSS, jednak dla potrzeb tego zadania strona /xss celowo generuje front za pomocą czystego php.

* Znajdź i dopisz w odpowiednim miejscu funkcję, która konwertuje wszystkie znaki specjalne na encje HTML, nieinterpretowane przez przeglądarkę. 

* Jako odpowiedź do tego zadania prześlij zrzuty ekranu zawierające:
	- poprawnie wyświetlane ogłoszenie - localhost/xss
	- fragment poprawionego kodu - plik xss.php




