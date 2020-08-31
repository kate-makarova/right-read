<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public $fillable = ['index_link',
        'site_name',
        'cofig',
        ];
}
