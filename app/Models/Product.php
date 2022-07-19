<?php
namespace Hasinur\Xspeed\Models;

class Product extends Model
{
    /**
     * Store table name
     *
     * @var string
     */
    public $table = 'products';

    public function getProductWithDate($from, $to) {
        if ( empty($from) && empty($to) ) {
            return $this->get();
        }

        $this->query("SELECT * FROM {$this->table} 
        WHERE entry_at between {$from} and ${$to} 
        ORDER BY entry_at DESC");

        return $this->results;
    }
}