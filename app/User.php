<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'informal name', 'gender', 'birth date', 'NIF', 'Phone','Adress','type','check_pay','check_active','check_pass','check_dir'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     public function typeToStr()
    {
        switch ($this->tipo_socio) {
            case 'P':
                return 'Piloto';
            case 'NP':
                return 'Normal';
            case 'A':
                return 'Aeromodelista';
        }

        return 'Unknown';
    }
    public function isPiloto()
    {
        return $this->tipo_socio === 'P';
    }

    public function isNormal()
    {
        return $this->tipo_socio === 'NP';
    }

    public function isAeromodelista()
    {
        return $this->tipo_socio === 'A';
    }

    public function isAtivo()
    {
        return $this->ativo === 1;
    }
    public function isInstrutor()
    {
        return $this->instrutor===1;
    }
    public function isAluno()
    {
        return $this->aluno===1;
    }
    public function isDirecao()
    {
        return $this->direcao===1;
    }
}
