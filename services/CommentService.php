<?php

namespace Pandao\Services;

class CommentService
{
    protected $pms_db;

    public function __construct($db)
    {
        $this->pms_db = $db;
    }

    public function getComments($itemType, $itemId)
    {
        $comments = [];

        $stmt = $this->pms_db->prepare('SELECT * FROM pm_comment WHERE id_item = :id_item AND item_type = :item_type AND checked = 1 ORDER BY add_date DESC');
        $stmt->bindParam(':id_item', $itemId, \PDO::PARAM_INT);
        $stmt->bindParam(':item_type', $itemType, \PDO::PARAM_STR);

        if ($stmt->execute()) {
            $comments = $stmt->fetchAll();
        }

        return $comments;
    }
}
