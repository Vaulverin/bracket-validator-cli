<?php declare(strict_types=1);
require_once dirname(__DIR__). '/vendor/autoload.php';

use Vaulverin\BracketValidator\BracketValidator;

/**
 * Стартует приложение
 * @param int $argc Arguments count
 * @param array $argv Array of arguments
 */
function appRun(int $argc, array $argv) {
    if ($argc <= 1) {
        showInfo();
        return;
    }
    $filePath = $argv[1];
    if (file_exists($filePath) == false) {
        showError('Sorry, your file does not exist.');
        return;
    }
    $strToValidate = file_get_contents($filePath);
    $result = false;
    try {
        $result = BracketValidator::validate($strToValidate);
    } catch (Exception $e) {
        showError($e->getMessage());
        return;
    }
    $message = 'Yep, file is valid.';
    if ($result === false) {
        $message = 'Nope, file is not valid.';
    }
    showResult($message);
    return;
}

/**
 * Shows some information about this application.
 */
function showInfo() {
    $sep = '---------------------------------------------------------------------------------'. PHP_EOL;
    echo $sep;
    echo 'THIS IS BRACKET VALIDATOR COMMAND LINE INTERFACE'. PHP_EOL;
    echo '  Usage:'. PHP_EOL;
    echo '      php bin/console <filename> - it tells you if this file valid or not.'. PHP_EOL;
    echo $sep;
}

/**
 * Shows error message.
 * @param string $message
 */
function showError(string $message) {
    echo ':-( Smth went wrong.'. PHP_EOL;
    echo $message. PHP_EOL;
}

/**
 * Shows result message.
 * @param string $message
 */
function showResult(string $message) {
    echo ':-) Validation complete.'. PHP_EOL;
    echo $message. PHP_EOL;
}