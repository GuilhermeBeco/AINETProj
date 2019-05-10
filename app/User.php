<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'num_socio', 'nome_informal', 'sexo', 'data_nascimento', 'tipo_socio','quota_paga','ativo','password_inicial','direcao'
    ];

   
    protected $hidden = [
        'password', 'remember_token',
    ];

    
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
    public function isPago()
    {
        return $this->quota_paga===1;
    }
    public function isPasswordInicial
    {
        return $this->password_inicial===1;
    }

}
