<?php
/**
 * Set of rules and paths to run PHP CS Fixer on "classic" sources (not templates)
 * 
 * Usage from the sources:
 *      make devtools-run-code-fixer
 * 
 * Usage from inside the cmta_php docker container:
 *      /usr/local/bin/php-cs-fixer --config=/data/htdocs/.phpcs.php fix
 * 
 * @see <https://github.com/FriendsOfPHP/PHP-CS-Fixer>
 */

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/includes',
    ])
    ->exclude([
    ])
;

$config = new PhpCsFixer\Config();
$config
    ->setUsingCache(false)
    ->setRules([
        '@PSR2' => true,
        '@PSR12' => true,
    ])
    ->setFinder($finder)
;

return $config;
