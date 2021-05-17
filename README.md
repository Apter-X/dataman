# Dataman
Dataman is a simple database manager using PDO that simplifies back-end processing and grants with useful tools.

## Instructions
+ Go to the root of your php project and `git clone https://github.com/Apter-X/dataman.git`.
+ Configure the connection with your database here `./database/myConfig`.

## How to use

```php
  include_once './dataman/config.php';
  $dataman = new Dataman;
  $dataman->ping();
```

## Example
Let's pretend that table represents our datatable.

**users**
|id |username|is_admin|
|---|--------|--------|
| 1 | steave | 0      |
| 2 | pyck   | 0      |
| 3 | bishop | 1      |
***
With this method we can get a specific row in a table as an associative array :
```php
  $data = $dataman->selectRow('users', 'id', '3');
  $dataman->displayRow($data);
```
Output:
|id |username|is_admin|
|---|--------|--------|
| 3 | bishop | 1      |
***
With this method we can get a specific value in a table as a string :
```php
  $data = $dataman->selectValue('users', 'username','is_admin', '1');
  echo $data;
```
Output: `bishop`

***
### License
Under **GNU General Public License v3.0**.
