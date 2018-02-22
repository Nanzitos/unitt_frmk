<?php

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome','sobrenome','username','email', 'password','superadmin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Variavel que contem a tabela do model
     *
     * @var string
     */

    protected $table = 'usuarios';

    const CREATED_AT = 'criado_em';
	const UPDATED_AT = 'editado_em';
}
