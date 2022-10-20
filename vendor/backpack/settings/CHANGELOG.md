# Changelog

All Notable changes to `Backpack Settings` will be documented in this file

-----

## [3.0.7] - 2020-04-24

### Added
- support for Backpack 4.1;


## [3.0.6] - 2020-04-13

### Added
- Serbian localization;


## [3.0.5] - 2020-03-05

### Fixed
- dropped PHPUnit 4 support;


## [3.0.4] - 2020-03-05

### Fixed
- upgraded PHPUnit to 9/7/4;


## [3.0.3] - 2020-02-16

### Added
- PHP 7.2, 7.3, 7.4 and 8.0 to TravisCI;


## [3.0.2] - 2020-01-14

### Added
- Indonesian language;


## [3.0.1] - 2019-12-19

### Added
- Farsi (Persian) language file;


## [3.0.0] - 2019-09-24

### Added
- support for CRUD 4.0.x

### Removed
- support for CRUD 3.x

-----

## [2.1.3] - 2019-03-12

- added support for CRUD 3.6.x

## [2.1.2] - 2018-11-22

- added support for CRUD 3.5.x

## [2.1.1] - 2018-10-15

## Added
- Dutch translation;

## Fixed
- using default Backpack guard;

## [2.1.0] - 2018-04-23

## Added
- Backpack\CRUD 3.4 constraint;
- backpack_middleware() usage;

## Removed
- Backpack\CRUD 3.2 and 3.3 support;


## [2.0.31] - 2018-04-23

## Added
- German translation;

## Fixed
- show active settings in AjaxDataTables;


## [2.0.30] - 2018-03-15

## Fixed
- ```Setting``` getter and setter now trigger exception or return false if operation was unsuccessful;


## [2.0.29] - 2018-03-13

## Fixed
- unique added to key column;


## [2.0.28] - 2018-03-13

## Added
- ```Setting``` alias;
- ```Setting::get()``` method; fixes 
- ```Setting::set()``` method;

## Fixed
- json_encode() field instead of casting it to array - merged #44; fixes #33;


## [2.0.27] - 2017-12-18

## Fixed
- routes are setup in the boot() method - merged #65;

## [2.0.26] - 2017-12-02

## Added
- Italian translation;
- removed publishing of seeds;


## [2.0.25] - 2017-11-22

## Fixed
- composer.json CRUD requirement - makes Settings package work on Backpack\CRUD 3.3;


## [2.0.24] - 2017-11-14

## Fixed
- proper CRUD routes - makes Settings package work on Backpack\CRUD 3.3;


## [2.0.23] - 2017-11-02

## Fixed
- route uses CRUD facade instead of route, for it to have the search route in CRUD 3.3;


## [2.0.22] - 2017-08-30

## Added
- package autodiscovery;

## Fixed
= text type columns for values in example migrations;

## [2.0.21] - 2017-08-11

## Added
- Russian (ru) language files, thanks to [Андрей](https://github.com/parabellumKoval);


## [2.0.20] - 2017-08-11

## Added
- Danish (da_DK) language files, thanks to [Frederik Rabøl](https://github.com/Xayer);


## 2.0.19 - 2017-07-06

### Added
- overwritable routes file;

## 2.0.18 - 2017-07-05

### Fixed
- Removed HHVM from TravisCI, since Laravel 5.4 no longer supports it;

## 2.0.17 - 2017-07-05

### Added
- Portugese translation (thanks to [Toni Almeida](https://github.com/promatik));
- Portugese (Brasilian) translation (thanks to [Guilherme Augusto Henschel](https://github.com/cenoura));
- command line feedback when seeding the settings table;


## 2.0.16 - 2017-04-21

### Removed
- Backpack\CRUD no longer loads translations, as Backpack\Base does it for him.


## 2.0.15 - 2017-02-14

### Removed
- Support for PHP 5.5 and HHVM, as Laravel 5.4 no longer supports them;


## 2.0.14 - 2017-02-14

### Added
- Support for Backpack\CRUD 3.2


## 2.0.13 - 2017-01-08

### Added
- Lang files for the Settings package, thanks to [Phouvanh Korngchansavath](https://www.phouvanh.com/);



## 2.0.12 - 2016-12-13

### Fixed
- Can now publish assets again.



## 2.0.11 - 2016-12-07

### Fixed
- No longer conflicting with artisan when no database is present.


## 2.0.10 - 2016-09-21

### Fixed
- Settings now respects the admin prefix set in Backpack\Base's config file - thanks to [Twaambo Haamucenje](https://github.com/twoSeats);


## 2.0.9 - 2016-08-31

### Fixed
- Setting name is again disabled in the Edit screen;
- Support for Laravel 5.3 (Backpack\CRUD 3.1.x);


## 2.0.8 - 2016-08-05

### Fixed
- PosgreSQL / SQLite support;


## 2.0.7 - 2016-07-31

### Added
- Bogus unit tests. At least we'be able to use travis-ci for requirements errors, until full unit tests are done.


## 2.0.5 - 2016-07-12

### Fixed
- Seeds had missing Field column for two demo entries.


## 2.0.4 - 2016-06-06

### Fixed
- Seeds had slashes, which caused installation problems for some users.


## 2.0.3 - 2016-06-02

### Fixed
- It did not load the correct field type on edit (from the db). Now it does.


## 2.0.2 - 2016-06-02

### Fixed
- Routes are now defined in the SettingsServiceProvider;
- Using the Admin middleware instead of Auth, as of Backpack\Base v0.6.0;


## 2.0.1 - 2016-05-20

### Fixed
- composer.json now requires Backpack\CRUD v2


## 2.0.0 - 2016-05-20

### Added
- SettingCrudController syntax changed to match the new API-based Backpack\CRUD v2.


## 1.2.3 - 2016-03-16

### Fixed
- Added page titles.


## 1.2.2 - 2016-03-11

### Fixed
- Changed folder structure to resemble a Laravel application - Http and Models are in an app folder.


## 1.2.1 - 2016-03-11

### Fixed
- Removed some more Dick mentions and fixed readme badges.


## 1.2.0 - 2016-03-11

### Fixed
- Changes namespaces to Backpack and removed every mention of Dick.


## 1.1.3 - 2015-09-10

### Fixed
- Namespacing and classes in seedfile, to allow seeding without publishing the assets.
