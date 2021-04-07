# Dataman
Dataman is a simple object database manager using PDO that simplifies back-end processing and grants with useful tools.

## Instructions
+ Go to the root of your php project and `git clone https://github.com/Apter-X/dataman.git`.
+ Configure your connection with your database in the file `./database/myConfig`.

## How to use
We need to instantiate our dataman like this :

```php
  include_one './dataman/myConfig.php';
  $dataman = new Dataman;
  $dataman->ping();
```

## Example
Let's pretend that this table represents our database.

**users**
|id |username|is_admin|
|---|--------|--------|
| 1 | steave | 0      |
| 2 | pyck   | 0      |
| 3 | bishop | 1      |
***
With this method we can get a specific row by passing certain references as parameters :
```php
  $data = $dataman->selectRow('users', 'id', '3');
  $dataman->displayRow($data);
```
Output:
|id |username|is_admin|
|---|--------|--------|
| 3 | bishop | 1      |
***
With this method we can get a specific value :
```php
  $data = $dataman->selectValue('users', 'is_admin','username', 'beshop');
  $dataman->displayRow($data);
```
Output: `1`

***
### License
Under **GNU General Public License v3.0**.
