<?php

namespace TesteMadeiraMadeira\KnowledgeBase\Topic;

use TesteMadeiraMadeira\Core\ModelContract;

class Topic implements ModelContract
{

    public $id;
    public $name;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function setModel(object $object) : void
    {
        $this->id = (int) $object->id;
        $this->name = (string) $object->name;
        $this->created_at = date($object->created_at);
        $this->updated_at = date($object->updated_at);
        $this->deleted_at = date($object->deleted_at);
    }
}
