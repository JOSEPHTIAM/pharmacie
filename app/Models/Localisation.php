<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


/**
 * Class Localisation
 *
 * @property string $id_localisation
 * @property string $nom_localisation
 * @property string $quartier_localisation
 * @property string $ville_localisation
 * @property string $pays_localisation
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Service[] $services
 * @property Collection|Service1[] $services1
 * 
 * @property Collection|Formation[] $formations
 * @property Collection|Formation1[] $formations1
 * 
 * @package App\Models
 */

class Localisation extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    // Table associée
    protected $table = 'localisation';

    // Clé primaire
    protected $primaryKey = 'id_localisation';

    // Clé primaire non auto-incrémentée
    public $incrementing = false;

    // Types des colonnes
    protected $casts = [
        //
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_localisation',
        'nom_localisation',
        'quartier_localisation',
        'ville_localisation',
        'pays_localisation',       
    ];


    // Pour l'envoie de la clé secondaire 'id_localisation' dans la table service
    public function services()
	{
		return $this->hasMany(Service::class, 'id_localisation');
	}

    // Pour l'envoie de la clé secondaire 'id_localisation' dans la table service1
    public function services1()
	{
		return $this->hasMany(Service1::class, 'id_localisation');
	}



    // Pour l'envoie de la clé secondaire 'id_localisation' dans la table formation
    public function formations()
	{
		return $this->hasMany(Formation::class, 'id_localisation');
	}

    // Pour l'envoie de la clé secondaire 'id_localisation' dans la table formation1
    public function formations1()
	{
		return $this->hasMany(Formation1::class, 'id_localisation');
	}

    
}
