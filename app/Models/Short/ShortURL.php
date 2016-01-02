<?php namespace App\Models\Short;

use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletingTrait;

class ShortURL extends \App\Models\aModel
{
    use SoftDeletingTrait;

    protected $table = 'short_url';
    protected $primaryKey = 'id';
}