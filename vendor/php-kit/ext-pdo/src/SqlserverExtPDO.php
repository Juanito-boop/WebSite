<?php
namespace PhpKit\ExtPDO;
use PDO;

/**
 * A PDO interface to SQLServer databases.
 *
 * @see __construct
 */
class SqlserverExtPDO extends ExtPDO
{
  /**
   * PDO options to be applied when connecting to the database.
   *
   * A map of PDO::ATTR_xxx constants to the corresponding values.
   *
   * @var array
   */
  public $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_SILENT,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_TIMEOUT            => 5,
  ];

  /**
   * @param array      $settings        A configuration array with the following keys:<p>
   *                                    <table cellspacing=0 cellpadding=0>
   *                                    <tr><kbd>database        <td>The database name.
   *                                    <tr><kbd>host            <td>The database server's host IP or domain name.
   *                                    <tr><kbd>port            <td>The database server's port (optional).
   *                                    <tr><kbd>username &nbsp; <td>The username.
   *                                    <tr><kbd>password        <td>The password.
   *                                    </table>
   * @param array|null $optionsOverride Entries on this array override the default PDO connection options.
   */
  function __construct (array $settings, array $optionsOverride = null)
  {
    if (isset($optionsOverride))
      foreach ($optionsOverride as $k => $v)
        $this->options[$k] = $v;
    $dsn = "sqlsrv:Database={$settings['database']};Server={$settings['host']}";
    if (isset ($settings['port']))
      $dsn .= ",{$settings['port']}";
    parent::__construct ($dsn, $settings['username'], $settings['password'], $this->options);
    $this->exec ('SET QUOTED_IDENTIFIER ON'); // Use double quotes for quoting identifiers, to make the query syntax more ANSI compliant.
  }
}
