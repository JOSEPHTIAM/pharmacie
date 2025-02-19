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
 * Class Magasin
 *
 * @property string $id_magasin
 * @property int $stock_magasin
 * 
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Service[] $services
 * @property Collection|Service1[] $services1
 *
 * @package App\Models
 */


class Magasin extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    // Table associée
    protected $table = 'magasin';

    // Clé primaire
    protected $primaryKey = 'id_magasin';

    // Clé primaire non auto-incrémentée
    public $incrementing = false;

    // Types des colonnes
    protected $casts = [
        'stock_magasin' => 'int',        
    ];

    // Colonnes modifiables
    protected $fillable = [
        'id_magasin',
        'stock_magasin',        
    ];


    // Pour l'envoie de la clé secondaire 'id_magasin' dans la table service
    public function services()
	{
		return $this->hasMany(Service::class, 'id_magasin');
	}

    // Pour l'envoie de la clé secondaire 'id_magasin' dans la table service1
    public function services1()
	{
		return $this->hasMany(Service1::class, 'id_magasin');
	}

}
