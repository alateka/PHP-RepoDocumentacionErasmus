<?php

namespace App\Models;

use App\Models\Solicitud;
use App\Models\Idioma;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name',
        'last_name',
        'ciclo_id',
        'email',
        'password',
        'fecha_nacimiento',
        'nacionalidad',
        'dni',
        'year',
        'verified',
        'telefono',
        'localidad',
        'cp',
        'direccion',
    ];*/

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function ciclo()
    {
        return $this->belongsTo('App\Models\Ciclo');
    }

    public function solicitud(){
        return $this->hasOne(Solicitud::class);
    }

    public function idiomas(){
        return $this->belongsToMany(Idioma::class);
    }

}
