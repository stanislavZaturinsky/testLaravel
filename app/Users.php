<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Users extends Model
{
    protected $table = 'users';

    protected $fillable = ['login', 'password', 'firstname', 'lastname', 'sex', 'created_at', 'email'];

    public $timestamps = false;

    CONST SEX_MALE    = 1;
    CONST SEX_FEMALE  = 2;
    CONST SEX_NO_INFO = 3;

    public static function getSexes() {
        return [
            self::SEX_MALE    => 'Man',
            self::SEX_FEMALE  => 'Woman',
            self::SEX_NO_INFO => 'No information',
        ];
    }

    public static function getSexesList() {
        return implode(',', [
            self::SEX_MALE, self::SEX_FEMALE, self::SEX_NO_INFO
        ]);
    }

    public function addresses() {
        return $this->hasMany('App\Addresses');
    }

    public static function rules(Request $request)
    {
        $loginRule = 'unique:users,login';
        $emailRule = 'unique:users,email';

        if ($request->route()->getUri() === 'users/edit/{id}') {
            $userId     = $request->get('user_id');
            $loginRule .= ',' . $userId;
            $emailRule .= ',' . $userId;
        }

        $rules = [
            'login' => [
                'required',
                'between:4,100',
                $loginRule
            ],
            'password' => [
                'required',
                'between:6,50',
            ],
            'firstname' => [
                'required',
                'between:3,100',
                'is_uppercase_first_chr',
            ],
            'lastname' => [
                'required',
                'between:3,100',
                'is_uppercase_first_chr',
            ],
            'sex' => [
                'integer',
                'in:' . Users::getSexesList(),
            ],
            'email' => [
                'required',
                'between:5,50',
                $emailRule
            ],
        ];

        if ($request->route()->getUri() === 'users/create') {
            $rules = array_merge($rules, Addresses::rules());
        }

        return $rules;
    }

    public static function messages()
    {
        return [
            'required'               => ':attribute is required',
            'in'                     => ':attribute must contain one value from: :values',
            'unique'                 => ':attribute already exist. Field must be unique',
            'is_uppercase_first_chr' => 'First character in :attribute must be in upper case'
        ];
    }
}
