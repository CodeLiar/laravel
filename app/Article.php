<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $title="";
    public $body="";
    public $user_id=0;
}

