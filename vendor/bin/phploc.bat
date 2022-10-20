@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../stefanzweifel/laravel-stats-phploc/phploc
php "%BIN_TARGET%" %*
