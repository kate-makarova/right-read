<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'static_content';

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'name';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d h-i-s';

    public $fillable = [
        'name',
        'text_title',
        'text_content'
    ];
}
