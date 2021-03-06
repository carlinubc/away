<?php
/**
 * @file away.aliases.drushrc.php
 *
 * @see https://www.drupal.org/node/1401522
 *
 * Site aliases for Away Project
 * Place this file at ~/.drush/  (~/ means your home path)
 *
 * Usage:
 *   To copy the development database to your local site:
 *   $ drush sql-sync @yoursite.dev @yoursite.local
 *   To copy your local database to the development site:
 *   $ drush sql-sync @yoursite.local @yoursite.dev -structure-tables-key=common --no-ordered-dump --sanitize=0 --no-cache
 *   To copy the production database to your local site:
 *   $ drush sql-sync @yoursite.prod @yoursite.local
 *   To copy all files in development site to your local site:
 *   $ drush rsync @yoursite.dev:%files @yoursite.local:%files
 *   Clear the cache in production:
 *   $ drush @yoursite.prod clear-cache all
 *
 * You can copy the site alias configuration of an existing site into a file
 * with the following commands:
 *   $ cd /path/to/settings.php/of/the/site/
 *   $ drush site-alias @self --full --with-optional >> ~/.drush/mysite.aliases.drushrc.php
 */

/**
 * Local alias
 * Set the root and site_path values to point to your local site
 */
$aliases['local'] = array(
  'root' => '/Users/pittet/Sites/away/public',
  'uri'  => 'away.dev',
  'path-aliases' => array(
    '%dump-dir' => '/tmp',
  ),
  'target-command-specific' => array(
    'sql-sync' => array(
      'sanitize' => TRUE,
      'confirm-sanitizations' => TRUE,
      'no-ordered-dump' => TRUE,
      'no-cache' => TRUE,
      'enable' => array(
        'devel',
        'stage_file_proxy',
        'fields_ui',
        'views_ui',
      ),
    ),
  ),
);

/**
 * Development alias
 * Set up each entry to suit your site configuration
 */
$aliases['stage'] = array (
  'uri' => 'http://stage-away.science.ubc.ca',
  'root' => '/var/www/html/stage-away/public',
  'remote-user' => 'fosadmin',
  'remote-host' => 'stage-away.science.ubc.ca',
  'path-aliases' => array(
    '%dump-dir' => '/tmp',
  ),
  'source-command-specific' => array (
    'sql-sync' => array (
      'no-cache' => TRUE,
      'structure-tables-key' => 'common',
    ),
  ),
  // No need to modify the following settings
  'command-specific' => array (
    'sql-sync' => array (
      'no-ordered-dump' => TRUE,
      'structure-tables' => array(
       // You can add more tables which contain data to be ignored by the database dump
        'common' => array('cache', 'cache_filter', 'cache_menu', 'cache_page', 'history', 'sessions', 'watchdog'),
      ),
    ),
  ),
);

// /**
//  * Production alias
//  * Set each option to match your configuration
//  */
// $aliases['away.prod'] = array (
//   // This is the full site alias name from which we inherit its config.
//   // 'parent' => '@yoursite.dev',
//   // 'uri' => 'yoursite.com',
//   // 'root' => '/path/to/drupal/root',
//   // 'remote-user' => 'ssh-user',
//   // 'remote-host' => 'ssh-host',
// );
