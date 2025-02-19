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
 * Class Electromenager
 *
 * @property string $id_electromenager
 * @property string|null $image_electromenager
 * @property string $nom_electromenager
 * 
 * @property int $puissance_electromenager
 * @property int $tension_electromenager
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Service[] $services
 * 
 * @package App\Models
 */


class Electromenager extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    // Table associée
    protected $table = 'electromenager';

    // Clé primaire
    protected $primaryKey = 'id_electromenager';

    // Clé primaire non auto-incrémentée
    public $incrementing = false;

    // Types des colonnes
    protected $casts = [
        'puissance_electromenager' => 'int',
        'tension_electromenager' => 'int',
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_electromenager',
        'image_electromenager',
        'nom_electromenager',
        'puissance_electromenager',
        'tension_electromenager',       
    ];


    // Pour l'envoie de la clé secondaire 'id_localisation' dans la table service
    public function services()
	{
		return $this->hasMany(Service::class, 'id_localisation');
	}

    
    /**
     * Accesseur pour le chemin complet de l'image (utilise le stockage Laravel).
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->image_electromenager ? asset('storage/' . $this->image_electromenager) : asset('images/default.png');
    }
    

    /*
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_electromenager);
    }
    */
    
    
}
