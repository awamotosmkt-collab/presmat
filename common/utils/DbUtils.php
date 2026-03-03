<?php

namespace Pandao\Common\Utils;

class DbUtils
{
    /**
     * Prepares an INSERT statement from an associative array of data.
     *
     * @param Database $db The database connection.
     * @param string $table The target table name.
     * @param array $data Associative array of column => value.
     * @return PDOStatement The prepared statement (not yet executed).
     */
    public static function dbPrepareInsert($db, $table, $data)
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ':' . $col, $columns);

        $sql = 'INSERT INTO `' . $table . '` (`' . implode('`, `', $columns) . '`) VALUES (' . implode(', ', $placeholders) . ')';

        $stmt = $db->prepare($sql);
        foreach ($data as $col => $val) {
            $stmt->bindValue(':' . $col, $val);
        }
        return $stmt;
    }

    /**
     * Prepares an UPDATE statement from an associative array.
     *
     * @param Database $db The database connection.
     * @param string $table The target table.
     * @param array $data Associative array of column => value.
     * @param string $where The WHERE clause (e.g. "id = :id").
     * @return PDOStatement Prepared statement.
     */
    public static function dbPrepareUpdate($db, $table, $data, $where)
    {
        $sets = array_map(fn($col) => '`' . $col . '` = :' . $col, array_keys($data));

        $sql = 'UPDATE `' . $table . '` SET ' . implode(', ', $sets) . ' WHERE ' . $where;
        $stmt = $db->prepare($sql);
        foreach ($data as $col => $val) {
            $stmt->bindValue(':' . $col, $val);
        }
        return $stmt;
    }

    /**
     * Returns the number of rows from the last SELECT query using SQL_CALC_FOUND_ROWS.
     *
     * @param Database $db The database connection.
     * @return int The total found rows count.
     */
    public static function lastRowCount($db)
    {
        return (int) $db->query('SELECT FOUND_ROWS()')->fetchColumn();
    }
}
