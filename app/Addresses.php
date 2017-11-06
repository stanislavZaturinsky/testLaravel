<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $table = 'addresses';

    protected $fillable = ['user_id', 'postcode', 'country', 'city', 'street', 'house', 'office'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Users');
    }

    public static function rules() {
        return [
            'postcode' => [
                'required',
                'numeric'
            ],
            'country' => [
                'required',
                'size:2',
                'is_uppercase'
            ],
            'city' => [
                'required',
                'between:3,100',
            ],
            'street' => [
                'required',
                'between:3,100',
            ],
            'house' => [
                'required',
                'numeric',
            ],
            'office' => [
                'numeric',
            ],
        ];
    }

    public static function messages()
    {
        return [
            'required'     => ':attribute is required',
            'size'         => ':attribute must contain :size characters',
            'is_uppercase' => 'Characters in :attribute must be in upper case'
        ];
    }
}
