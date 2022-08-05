<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as GeneratorUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class ProductCategory extends Model
{
    protected $table = 'mst_product_categories';
    protected $primaryKey = 'prodcat_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prodcat_uuid',
        'prodcat_company_id',
        'prodcat_outlet_id',
        'prodcat_code',
        'prodcat_name',
        'prodcat_slug',
        'prodcat_description',
        'prodcat_parent_id',
        'prodcat_label',
        'prodcat_image',
        'prodcat_featured',
        'prodcat_enabled',
    ];

    protected $casts = [
        'prodcat_company_id' => 'integer',
        'prodcat_outlet_id' => 'integer',
        'prodcat_parent_id' => 'integer',
        'prodcat_featured' => 'boolean',
        'prodcat_enabled' => 'boolean'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->prodcat_uuid = GeneratorUuid::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $ude) {
                abort(500, $ude->getMessage());
            }
        });
    }

    public function setProdcatNameAttribute($value)
    {
        $this->attributes['prodcat_name'] = $value;

        $this->attributes['prodcat_slug'] = str_slug($value);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company', 'prodcat_company_id', 'comp_id');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Master\Outlet', 'prodcat_outlet_id', 'out_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Master\Product', 'prod_category_id', 'prodcat_id');
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'prodcat_parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'prodcat_parent_id');
    }
}
