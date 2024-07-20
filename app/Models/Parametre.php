<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;

    protected $fillable = [
        'accentColor',
        'childIndentSidebarCheckbox',
        'compactSidebarCheckbox',
        'flatSidebarCheckbox',
        'logoColor',
        'sidebarDarkColor',
        'sidebarLightColor',
        'variantsBarreNavigation',
        'textSmBodyCheckbox',
        'textSmBrandCheckbox',
        'textSmFooterCheckbox',
        'textSmHeaderCheckbox',
        'textSmSidebarCheckbox',
        'created_by_id'
    ];
}
