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
* Class Formation
*
* @property string $id_formation
* @property string $nom_formation
* @property string|null $description_formation
* @property string $categorie_formation
* @property string|null $video_formation
* @property string|null $pdf_formation
* @property string $matricule
* 
* @property Carbon|null $created_at
* @property Carbon|null $updated_at
* 
* @property User $user
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
        //
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_formation',
        'nom_formation',
        'description_formation',
        'categorie_formation',
        'matricule',
        'video_formation',
        'pdf_formation',        
    ];

    // Pour recevoir la clé secondaire 'matricule' de la table user
    public function user()
    {
        return $this->belongsTo(User::class, 'matricule');
    }

}
