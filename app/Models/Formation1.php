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
* Class Formation1
*
* @property string $id_formation1
* @property string $nom_formation
* @property string|null $description_formation 
* @property int $prix_formation
* @property int $niveau_formation
* @property int $total_formation
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


class Formation1 extends Model
{

    use HasFactory, Notifiable, HasApiTokens;

    // Table associée
    protected $table = 'formation1';

    // Clé primaire
    protected $primaryKey = 'id_formation1';

    // Clé primaire non auto-incrémentée
    public $incrementing = false;

    // Types des colonnes
    protected $casts = [
        'prix_formation' => 'int',
        'niveau_formation' => 'int',
        'total_formation' => 'int',
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_formation1',
        'nom_formation',
        'description_formation',        
        'prix_formation',
        'niveau_formation',
        'total_formation',

        'matricule',
        'pdf_formation',   
    ];

    
    // Mutateur pour total_formation
    public function setTotalFormationAttribute($value)
    {
        $this->attributes['total_formation'] = $this->attributes['prix_formation'] * $this->attributes['niveau_formation'];
    }

    // Pour recevoir la clé secondaire 'matricule' de la table user
    public function user()
    {
        return $this->belongsTo(User::class, 'matricule');
    }

}
