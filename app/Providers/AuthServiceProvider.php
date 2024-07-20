<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     $this->registerPolicies();

    //      // Auth gates for: User management
    //      Gate::define('user_management_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     // Auth gates for: Roles
    //     Gate::define('role_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('role_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('role_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('role_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('role_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     // Auth gates for: Users
    //     Gate::define('user_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('user_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('user_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('user_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('user_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     // Auth gates for: Folders
    //     Gate::define('folder_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('folder_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('folder_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('folder_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('folder_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     // Auth gates for: Files
    //     Gate::define('file_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('file_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('file_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('file_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('file_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     // Auth gates for: Subscriptions and Payments
    //     Gate::define('plan_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('payment_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //      // Auth gates for: categorie
    //     Gate::define('categorie_access', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('categorie_create', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('categorie_edit', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('categorie_view', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });
    //     Gate::define('categorie_delete', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //      // Auth gates for: fournisseur
    //      Gate::define('fournisseur_access', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('fournisseur_create', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('fournisseur_edit', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('fournisseur_view', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });
    //     Gate::define('fournisseur_delete', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });


    //      // Auth gates for: produits
    //      Gate::define('produits_access', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('produits_create', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('produits_edit', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('produits_view', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });
    //     Gate::define('produits_delete', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //        // Auth gates for: Letters
    //        Gate::define('lettre_access', function ($user) {
    //         return in_array($user->role_id, [2,3]);
    //     });

    //     Gate::define('recommandation_financiere', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });


    //     Gate::define('demande_renseignement', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('demande_paiement', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('audit', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('confirmation_solde', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('demission', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('remerciement', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('decharge', function ($user) {
    //         return in_array($user->role_id, [2]);
    //     });

    //     Gate::define('gestion_adresse_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('pays_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('pays_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('pays_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('pays_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('pays_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });


    //     Gate::define('ville_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('ville_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('ville_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('ville_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('ville_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('commune_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('commune_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('commune_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('commune_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('commune_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('quartier_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('quartier_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('quartier_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('quartier_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('quartier_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //      // Auth gates for: decision

    //      Gate::define('decision_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });

    //     Gate::define('decision_create', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('decision_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('decision_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('decision_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });


    //        // Auth gates for: paroisse

    //     Gate::define('paroisse_access', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('paroisse_view', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('paroisse_edit', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });
    //     Gate::define('paroisse_delete', function ($user) {
    //         return in_array($user->role_id, [1]);
    //     });    

        



        
    // }

    public function boot()
    {
        $this->registerPolicies();

        $rolesGates = [
            1 => [
                'user_management_access', 'role_access', 'role_create', 'role_edit', 'role_view', 'role_delete',
                'user_access', 'user_create', 'user_edit', 'user_view', 'user_delete',
                'folder_access', 'folder_create', 'folder_edit', 'folder_view', 'folder_delete',
                'file_access', 'file_create', 'file_edit', 'file_view', 'file_delete',
                'plan_access', 'payment_access', 'gestion_adresse_access', 'pays_access', 'pays_create',
                'pays_edit', 'pays_view', 'pays_delete', 'ville_access', 'ville_create', 'ville_edit',
                'ville_view', 'ville_delete', 'commune_access', 'commune_create', 'commune_edit',
                'commune_view', 'commune_delete', 'quartier_access', 'quartier_create', 'quartier_edit',
                'quartier_view', 'quartier_delete', 'decision_access', 'decision_create', 'decision_edit',
                'decision_delete', 'decision_view', 'paroisse_access', 'paroisse_view', 'paroisse_edit',
                'paroisse_delete', 'gestion_programme'
            ],
            2 => [
                'categorie_access', 'categorie_create', 'categorie_edit', 'categorie_view', 'categorie_delete',
                'fournisseur_access', 'fournisseur_create', 'fournisseur_edit', 'fournisseur_view', 'fournisseur_delete',
                'produits_access', 'produits_create', 'produits_edit', 'produits_view', 'produits_delete',
                'lettre_access', 'recommandation_financiere', 'demande_renseignement', 'demande_paiement',
                'audit', 'confirmation_solde', 'demission', 'remerciement', 'decharge'
            ],
            3 => [
                'liturgique_access', 'programme_semaine' ,'annonce_naissance', 'bapteme','huitaine','quaranteJour',
                'premierJeudi','viergeMarie','Oshoffa','martines','semaine_sainte','ascension','fin_annee'
            ]
        ];

        foreach ($rolesGates as $role => $gates) {
            foreach ($gates as $gate) {
                Gate::define($gate, function ($user) use ($role) {
                    return $user->role_id === $role;
                });
            }
        }
    }

}
