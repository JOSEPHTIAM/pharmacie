<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Storage;
use FFMpeg\FFProbe; // Assurez-vous d'avoir installé FFMpeg pour vérifier la durée des vidéos.



/**
 * Class Formation
 *
 * @property string $id_formation
 * @property string $nom_formation
 * @property string|null $description_formation 
 * @property int $prix_formation
 * @property int $total_formation
 * @property string|null $video_formation
 * 
 * @property string $id_magasin
 * @property string $matricule
 * @property string $id_localisation
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Magasin $magasin
 * @property User $user
 * @property Localisation $localisation
 *
 * @package App\Models
 */


class Formation extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    // Table associée
    protected $table = 'formation';

    // Clé primaire
    protected $primaryKey = 'id_formation';

    // Clé primaire non auto-incrémentée
    public $incrementing = false;

    // Types des colonnes
    protected $casts = [
        'prix_formation' => 'int',        
        'total_formation' => 'int',
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_formation',
        'nom_formation',
        'description_formation',        
        'prix_formation',
        'total_formation',
        'video_formation',
        'id_magasin',
        'matricule',
        'id_localisation',                 
    ];


    // Mutateur pour total_formation
    public function setPrixFormationAttribute($value)
    {
        $this->attributes['prix_formation'] = $value;
        $this->calculateTotalFormation();
    }

    public function setIdMagasinAttribute($value)
    {
        $this->attributes['id_magasin'] = $value;
        $this->calculateTotalFormation();
    }

    protected function calculateTotalFormation()
    {
        if (isset($this->attributes['prix_formation']) && isset($this->attributes['id_magasin'])) {
            $magasin = Magasin::find($this->attributes['id_magasin']);
            if ($magasin) {
                $this->attributes['total_formation'] = $this->attributes['prix_formation'] * $magasin->stock_magasin;
            }
        }
    }

    
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
     * Scope : Filtrer les formations par utilisateur.
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


    /*
    /**
     * Accesseur : Retourne le chemin de l'image complète.
     
    public function getImageUrlAttribute()
    {
        return $this->video_formation ? asset('storage/' . $this->video_formation) : asset('images/default.png');
    }
    */

    
    /**
     * Mutateur pour le champ video_formation.
     * Vérifie que la durée de la vidéo est comprise entre 1 et 18 000 secondes.
     */
    public function setVideoFormationAttribute($value)
    {
        if ($value) {
            $videoPath = storage_path('app/public/' . $value);

            if (file_exists($videoPath)) {
                $ffprobe = FFProbe::create();
                $duration = $ffprobe
                    ->format($videoPath) // Analyse le fichier vidéo
                    ->get('duration'); // Récupère la durée en secondes

                if ($duration < 1 || $duration > 18000) {
                    throw new \Exception('La durée de la vidéo doit être comprise entre 1 seconde et 5 heures (18 000 secondes) !');
                }
            }
        }

        $this->attributes['video_formation'] = $value;
    }


}
