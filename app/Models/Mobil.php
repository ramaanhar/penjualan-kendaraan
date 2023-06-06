<?php

namespace App\Models;

class Mobil extends Kendaraan {
    protected $connection = $this->connection;
    protected $collection = $this->collection;

    protected $fillable = $this->fillable . [
        "deskripsi" => [
            "mesin", "suspensi" => ["depan", "belakang"], "tipe_transisi"
        ]
    ];
}