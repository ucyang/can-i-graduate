<?php
/**
 * @brief Declare constants for generic use and for checking to avoid a direct call from the Web
 **/
define('__CIG__', true);

/**
 * CIG_VERSION is the version number of the "Can I Graduate?".
 */
define('CIG_VERSION', '0.2.0');

/**
 * CIG_BASEDIR is the SERVER-SIDE absolute path of "Can I Graduate?" (with trailing slash).
 */
define('CIG_BASEDIR', str_replace('\\', '/', dirname(__FILE__)) . '/');

/**
 * Define the list of class names for the autoloader.
 */
$GLOBALS['CIG_AUTOLOAD_FILE_MAP'] = array(
    'Context' => 'classes/context/Context.class.php',
    'Data' => 'classes/data/Data.class.php',
    'DB' => 'classes/db/DB.class.php',
    'File' => 'classes/file/File.class.php',
    'User' => 'classes/user/User.class.php',
    'View' => 'classes/view/View.class.php',
);

/**
 * Include classes.
 */
foreach ($GLOBALS['CIG_AUTOLOAD_FILE_MAP'] as $className => $fileName)
    require CIG_BASEDIR . $fileName;

/**
 * @brief Initialize by creating Context object
 * Set all Request Argument/Environment variables
 **/
Context::init();

/**
 * @brief Initialize View module and display contents
 **/
View::init();
View::displayContent();
View::close();

Context::close();

/* End of file index.php */
/* Location: ./index.php */
