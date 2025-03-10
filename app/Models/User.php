<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


/**
 * Class User
 *
 * @property string $matricule
 * @property string|null $photo
 * @property string $nom
 * @property string|null $prenom
 * @property string $contact
 * @property string $role
 * @property string $email
 * @property string $password
 * @property string $statut
 * @property string|null $nom_societe
 * @property int|null $numero_societe
 * @property string|null $non_redevence
 * @property bool $is_online
 * @property float|null $latitude
 * @property float|null $longitude
 * @property Carbon|null $periode
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Service[] $services
 * @property Collection|Service1[] $services1
 * @property Collection|Formation[] $formations
 * @property Collection|Formation1[] $formations1
 * 
 * @package App\Models
 */


class User extends Model
{

    use HasFactory, Notifiable, HasApiTokens;

    // Table associée
    protected $table = 'user';

    // Clé primaire
    protected $primaryKey = 'matricule';
    
    // Clé primaire non auto-incrémentée
    public $incrementing = false;

    // Types des colonnes
    protected $casts = [        
        'numero_societe' => 'int',
        'is_online' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'periode' => 'datetime'
    ];

    // Colonnes modifiables
    protected $fillable = [
        'matricule',
        'photo',
        'nom',
        'prenom',
        'contact',        
        'role',
        'email',
        'password',
        'statut',
        'nom_societe',
        'numero_societe',
        'non_redevence',
        'is_online',
        'latitude',
        'longitude',
        'periode'
    ];


    // Pour définir le champ actif par défaut.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (in_array($user->role, ['Client', 'Agent'])) {
                $user->statut = 'actif';
            }
        });
    }

    // Pour l'envoie de la clé secondaire 'matricule' dans la table service
    public function services()
	{
		return $this->hasMany(Service::class, 'matricule');
	}

    // Pour l'envoie de la clé secondaire 'matricule' dans la table service1
    public function services1()
	{
		return $this->hasMany(Service1::class, 'matricule');
	}

    // Pour l'envoie de la clé secondaire 'matricule' dans la table formation
    public function formations()
	{
		return $this->hasMany(Formation::class, 'matricule');
	}

    // Pour l'envoie de la clé secondaire 'matricule' dans la table formation1
    public function formations1()
	{
		return $this->hasMany(formations1::class, 'matricule');
	}
    
    

    // Pour générer le mot de passe 
    public function getAuthPassword()
    {
        return $this->password;
    }
    
    /**
     * Set the user's non_redevence.
     *
     * @param  string  $value
     * @return void
     */
    public function setNonRedevenceAttribute($value)
    {
        $this->attributes['non_redevence'] = $value;
    }

    /**
     * Set the user's periode.
     *
     * @param  string  $value
     * @return void
     */
    public function setPeriodeAttribute($value)
    {
        $this->attributes['periode'] = $value;
    }

    /**
     * Accesseur pour le chemin complet de l'image (utilise le stockage Laravel).
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default.png');
    }
    

    /*
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->photo);
    }
    */
    
    


}
