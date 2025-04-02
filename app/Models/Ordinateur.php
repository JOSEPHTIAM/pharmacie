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
 * Class Ordinateur
 *
 * @property string $id_ordinateur
 * @property string|null $image_ordinateur
 * @property string $nom_ordinateur
 * 
 * @property string $processeur
 * @property string $disque
 * @property int $ram
 * @property string $core
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Service1[] $services1
 * 
 * @package App\Models
 */

 

class Ordinateur extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    // Table associée
    protected $table = 'ordinateur';

    // Clé primaire
    protected $primaryKey = 'id_ordinateur';

    // Clé primaire non auto-incrémentée
    public $incrementing = false;

    // Types des colonnes
    protected $casts = [
        'ram' => 'int',
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_ordinateur',
        'image_ordinateur',
        'nom_ordinateur',
        'processeur',
        'disque',
        'ram',
        'core',           
    ];


    // Pour l'envoie de la clé secondaire 'id_ordinateur' dans la table service1
    public function services1()
	{
		return $this->hasMany(Service1::class, 'id_ordinateur');
	}
    
    /**
     * Accesseur pour le chemin complet de l'image (utilise le stockage Laravel).
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->image_ordinateur ? asset('storage/' . $this->image_ordinateur) : asset('images/default.png');
    }
    

    /*
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_electromenager);
    }
    */
    
}
