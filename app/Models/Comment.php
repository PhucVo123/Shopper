<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = ['comment_name','comment_email','comment_content','comment_date','product_id','comment_status','comment_id_reply'];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';
}
