# schedule
schedule management with calendar on a website

## Specification
### 1. Get Username
  In 'index.php', the program get a username by using $_GET['usr'],
  thus users should specify their username with ?usr=\<username\>.

### 2. Add a Event
  In 'index.php', the program get an event date and an event content
  by using $_GET['data'], thus users should write an event
  as follows ?data=\<year\>/\<month\>/\<day\>;\<content\>.

  In the \<content\>, HTML tags and line feed codes '\n' can be written.
  WARNING: This specification contains vulnerabilities (XSS).

### 3. Erase a Event
  In 'index.php', the program get an event to be erased by using $_GET['erase'],
  the format is same as $_GET['data'], and then exactly matched data will be erased.

### 4. Switch The Month
 * Method 1: In 'schedule.js', the program switch a displayed calender by updshow function, thus users should type a command on the console of browser as follows, updshow(\<year\>, \<month\>).

 * Method 2: In 'index.php', the program get a month of display by $_GET['show'], thus users should specify month with ?show=\<year\>,\<month\>.
