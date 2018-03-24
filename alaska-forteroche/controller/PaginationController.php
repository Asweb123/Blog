<?php
require_once 'model/Pagination.php';

class PaginationController extends Pagination
{
    public function nbPage($perPage, $table)
    {
        $totalElement = parent::count($table);

        $nbPage = ceil($totalElement / $perPage);

        return $nbPage;
    }

    public function current($p, $nbPage)
    {
        if ($p > $nbPage) {
            $current = $nbPage;
        } else {
            $current = $p;
        }

        return $current;
    }

    public function elementPerPage($current, $perPage, $table)
    {

        $firstOfPage = ($current - 1) * $perPage;
        $elementPerPage = parent::elementPerPage($table, $firstOfPage, $perPage);

        return $elementPerPage;
    }
}