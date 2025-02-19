<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Service
 *
 * @property string $id_service
 * @property string|null $description_service
 * @property int $prix_service
 * @property int $total_service
 * 
 * @property string $id_magasin
 * @property string $matricule
 * @property string $id_localisation
 * 
 * @property string|null $id_electromenager
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Magasin $magasin
 * @property User $user
 * @property Localisation $localisation
 * 
 * @property Electromenager $electromenager
 * 
 */



class Service extends Model
{
    use HasFactory, HasApiTokens;

    // Table associée
    protected $table = 'service';

    // Clé primaire
    protected $primaryKey = 'id_service';
    public $incrementing = false;
    protected $keyType = 'string';

    // Sérialisation JSON : Ajout automatique de l’URL de l’image
    protected $appends = ['image_url'];

    // Types des colonnes
    protected $casts = [
        'prix_service' => 'int',
        'total_service' => 'int',
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_service',
        'description_service',
        'prix_service',
        'total_service',
        'id_magasin',
        'matricule',
        'id_localisation',
        'id_electromenager',
    ];


    /**
     * Relation : Un service appartient à un magasin.
     */
    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'id_magasin', 'id_magasin');
    }

    /**
     * Relation : Un service appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'matricule', 'matricule');
    }

    /**
     * Relation : Un service appartient à une localisation.
     */
    public function localisation()
    {
        return $this->belongsTo(Localisation::class, 'id_localisation', 'id_localisation');
    }


    /**
     * Relation : Un service appartient à un electromenager.
     */
    public function electromenager()
    {
        return $this->belongsTo(Electromenager::class, 'id_electromenager', 'id_electromenager');
    }


    /**
     * Accesseur : Retourne le chemin de l'image complète.
     */
    public function getImageUrlAttribute()
    {
        return $this->image_service ? asset('storage/' . $this->image_service) : asset('images/default.png');
    }

    
    /**
     * Scope : Filtrer les services par utilisateur.
     */
    public function scopeByUser($query, $matricule)
    {
        return $query->where('matricule', $matricule);
    }


    /**
     * Accesseur pour afficher soit un administrateur, soit un agent.
     */
    public function adminOrAgent()
    {
        return $this->belongsTo(User::class, 'matricule', 'matricule')
            ->whereIn('role', ['Administrateur', 'Agent']);
    }

    
}
