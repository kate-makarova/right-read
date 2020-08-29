<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'texts';

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
    public $timestamps = true;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d h-i-s';

    public $fillable = ['text_title',
        'publication_date',
        'site_name',
        'direct_link',
        'lang',
        'blurb',
        'total_words'];
}
