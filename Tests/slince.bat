::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::
:: Cake is a Windows batch script for invoking CakePHP shell commands
::
:: CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
:: Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
::
:: Licensed under The MIT License
:: Redistributions of files must retain the above copyright notice.
::
:: @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
:: @link          http://cakephp.org CakePHP(tm) Project
:: @since         2.0.0
:: @license       http://www.opensource.org/licenses/mit-license.php MIT License
::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

:: In order for this script to work as intended, the cake\console\ folder must be in your PATH

@echo.
@echo off

SET app=%0
SET lib=%~dp0

php "%lib%index.php" %*

echo.

exit /B %ERRORLEVEL%
