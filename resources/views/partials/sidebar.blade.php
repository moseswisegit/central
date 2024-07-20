@inject('request', 'Illuminate\Http\Request')

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

     <!-- Brand Logo -->
     <a href="" class="brand-link">
        <img src="{{ asset('AdminLTE3/dist/img/AdminLTELogo.png')}}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>


    <!-- Sidebar -->
    <div class="sidebar">

         <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            @if(Auth::user()->ut && Auth::user()->ut->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->ut->profile_picture) }}"  class="img-circle img-circle elevation-2" alt="Profile Picture" width="90">
            @else
            <img src="{{ asset('images/avatar.png') }}" alt="Profile Picture" class="img-circle img-circle elevation-2"  width="90">
            @endif
          </div>
            <div class="info">
            @if(optional(Auth::user()->ut)->nom || optional(Auth::user()->ut)->prenom)
              <a href="#" class="d-block">{{ Auth::user()->ut->nom }}  {{ Auth::user()->ut->prenom }}</a> 
            @endif
            </div>
        </div>


         <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ $request->segment(2) == 'home' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickadmin.qa_dashboard')
                  </p>
                </a>
              </li>
              @can('user_management_access')
              <li class="nav-item has-treeview {{ in_array($request->segment(2), ['roles', 'users']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array($request->segment(2), ['roles', 'users']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('quickadmin.user-management.title')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('role_access') 
                                <li class="nav-item {{ $request->segment(2) == 'roles' ? 'active' : '' }}">
                                    <a href="{{ route('superAdmin.roles.index') }}" class="nav-link {{ $request->segment(2) == 'roles' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickadmin.roles.title')</p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route('superAdmin.users.index') }}" class="nav-link {{ $request->segment(2) == 'users' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickadmin.users.title')</p>
                                    </a>
                                </li>
                            @endcan
                       
                        </ul>
                    </li>
              @endcan


            
            @can('folder_access')
            <li class="nav-item">
                <a href="{{ route('superAdmin.folders.index') }}" class="nav-link {{ $request->segment(2) == 'folders' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickadmin.folders.title')
                  </p>
                </a>
              </li>
            @endcan

            @can('file_access')
            <li class="nav-item">
                <a href="{{ route('superAdmin.files.index') }}" class="nav-link {{ $request->segment(2) == 'files' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickadmin.files.title')
                  </p>
                </a>
              </li>
            @endcan

            @can('categorie_access')
            <li class="nav-item">
                <a href="{{ route('user.categorie.index') }}" class="nav-link {{ $request->segment(2) == 'categorie' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickuser.categorie.title')
                  </p>
                </a>
              </li>
            @endcan

            @can('fournisseur_access')
            <li class="nav-item">
                <a href="{{ route('user.fournisseur.index') }}" class="nav-link {{ $request->segment(2) == 'fournisseur' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickuser.fournisseur.title')
                  </p>
                </a>
              </li>
            @endcan

            @can('produits_access')
            <li class="nav-item">
                <a href="{{ route('user.produits.index') }}" class="nav-link {{ $request->segment(2) == 'produits' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickuser.produits.title')
                  </p>
                </a>
              </li>
            @endcan

           


            @can('liturgique_access')
              <li class="nav-item has-treeview {{ $request->segment(2) == 'liturgique' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ $request->segment(2) == 'liturgique' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('quickuser.liturgique.title')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('programme_semaine') 
                                <li class="nav-item {{ $request->segment(2) == 'programme_semaine' ? 'active' : '' }}">
                                    <a href="#" class="nav-link {{ $request->segment(2) == 'programme_semaine' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickuser.programme_semaine.title')</p>
                                    </a>
                                </li>
                            @endcan
                            @can('annonce_naissance')
                                <li class="nav-item">
                                    <a href="#" class="nav-link {{ $request->segment(2) == 'annonce_naissance' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickuser.annonce_naissance.title')</p>
                                    </a>
                                </li>
                            @endcan

                            @can('bapteme')
                                <li class="nav-item">
                                    <a href="" class="nav-link {{ $request->segment(2) == 'bapteme' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickuser.bapteme.title')</p>
                                    </a>
                                </li>
                            @endcan



                            @can('huitaine')
                                <li class="nav-item">
                                    <a href="" class="nav-link {{ $request->segment(2) == 'huitaine' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickuser.huitaine.title')</p>
                                    </a>
                                </li>
                            @endcan
 
                            @can('quaranteJour')
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ $request->segment(2) == 'quaranteJour' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('quickuser.quaranteJour.title')</p>
                                </a>
                            </li>
                           @endcan

                           @can('premierJeudi')
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ $request->segment(2) == 'premierJeudi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('quickuser.premierJeudi.title')</p>
                                </a>
                            </li>
                           @endcan

                           @can('viergeMarie')
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ $request->segment(2) == 'viergeMarie' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('quickuser.viergeMarie.title')</p>
                                </a>
                            </li>
                           @endcan 

                           @can('Oshoffa')
                            <li class="nav-item">
                                <a href="" class="nav-link {{ $request->segment(2) == 'Oshoffa' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('quickuser.Oshoffa.title')</p>
                                </a>
                            </li>
                           @endcan

                           @can('martines')
                           <li class="nav-item">
                               <a href="" class="nav-link {{ $request->segment(2) == 'martines' ? 'active' : '' }}">
                               <i class="far fa-circle nav-icon"></i>
                               <p>@lang('quickuser.martines.title')</p>
                               </a>
                           </li>
                          @endcan

                          @can('semaine_sainte')
                           <li class="nav-item">
                               <a href="" class="nav-link {{ $request->segment(2) == 'semaine_sainte' ? 'active' : '' }}">
                               <i class="far fa-circle nav-icon"></i>
                               <p>@lang('quickuser.semaine_sainte.title')</p>
                               </a>
                           </li>
                          @endcan

                          @can('ascension')
                          <li class="nav-item">
                              <a href="" class="nav-link {{ $request->segment(2) == 'ascension' ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>@lang('quickuser.ascension.title')</p>
                              </a>
                          </li>
                         @endcan

                         @can('fin_annee')
                         <li class="nav-item">
                             <a href="" class="nav-link {{ $request->segment(2) == 'fin_annee' ? 'active' : '' }}">
                             <i class="far fa-circle nav-icon"></i>
                             <p>@lang('quickuser.fin_annee.title')</p>
                             </a>
                         </li>
                        @endcan
                       
                        </ul>
                    </li>
              @endcan

             
             

              @can('gestion_adresse_access')
              <li class="nav-item has-treeview {{ in_array($request->segment(2), ['pays', 'ville','commune', 'quartier']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array($request->segment(2), ['pays', 'ville','commune', 'quartier']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('quickadmin.gestion_adresse.title')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('pays_access') 
                                <li class="nav-item {{ $request->segment(2) == 'pays' ? 'active' : '' }}">
                                    <a href="{{ route('superAdmin.pays.index') }}" class="nav-link {{ $request->segment(2) == 'pays' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickadmin.pays.title')</p>
                                    </a>
                                </li>
                            @endcan
                            @can('ville_access')
                                <li class="nav-item">
                                    <a href="{{ route('superAdmin.ville.index') }}" class="nav-link {{ $request->segment(2) == 'ville' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickadmin.ville.title')</p>
                                    </a>
                                </li>
                            @endcan

                            @can('commune_access')
                                <li class="nav-item">
                                    <a href="{{ route('superAdmin.commune.index') }}" class="nav-link {{ $request->segment(2) == 'commune' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickadmin.commune.title')</p>
                                    </a>
                                </li>
                            @endcan

                            @can('quartier_access')
                                <li class="nav-item">
                                    <a href="{{ route('superAdmin.quartier.index') }}" class="nav-link {{ $request->segment(2) == 'quartier' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('quickadmin.quartier.title')</p>
                                    </a>
                                </li>
                            @endcan
                       
                        </ul>
                    </li>
              @endcan

              @can('paroisse_access')
              <li class="nav-item">
                  <a href="{{ route('superAdmin.paroisse.index') }}" class="nav-link {{ $request->segment(2) == 'paroisse' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      @lang('quickadmin.paroisse.title')
                    </p>
                  </a>
                </li>
              @endcan

              @can('decision_access')
              <li class="nav-item">
                  <a href="{{ route('superAdmin.decision.index') }}" class="nav-link {{ $request->segment(2) == 'decions' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      @lang('quickadmin.decision.title')
                    </p>
                  </a>
                </li>
              @endcan
  


            {{-- @can('lettres')
            <li class="nav-item">
                <a href="{{ route('admin.files.index') }}" class="nav-link {{ $request->segment(2) == 'files' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickadmin.files.title')
                  </p>
                </a>
              </li>
            @endcan --}}

            {{-- @can('plan_access')
            <li class="nav-item">
                <a href="{{ route('admin.subscriptions.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    My Plan
                  </p>
                </a>
              </li>
            @endcan --}}

            
            
            {{-- <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link {{ $request->segment(2) == 'change_password' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickadmin.qa_change_password')
                  </p>
                </a>
              </li> --}}
            

              {{-- <li class="nav-item">
                <a href="#logout" onclick="$('#logout').submit();"  class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    @lang('quickadmin.qa_logout')
                  </p>
                </a>
              </li> --}}

              @can('gestion_programme')
              <li class="nav-item">
                  <a href="{{ route('superAdmin.gestion_programme.index') }}" class="nav-link {{ $request->segment(2) == 'gestion_programme' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      @lang('quickuser.gestion_programme.title')
                    </p>
                  </a>
                </li>
              @endcan
        </ul>

      
      </nav>
    </div>
</aside>
            








