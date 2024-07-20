@extends('layouts.app')

@section('content')


<div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                @if(Auth::user()->ut && Auth::user()->ut->profile_picture)
                  <img src="{{ asset('storage/' . Auth::user()->ut->profile_picture) }}" alt="Profile Picture" width="90">
                @else
                  <img src="{{ asset('images/avatar.png') }}" alt="Profile Picture" width="90">
                @endif
              </div>

              <h3 class="profile-username text-center">
                @if(optional(Auth::user()->ut)->nom || optional(Auth::user()->ut)->prenom)
                  {{ Auth::user()->ut->nom }}  {{ Auth::user()->ut->prenom }}
                @endif

              </h3>

              <p class="text-muted text-center">
                @if(Auth::user()->ut && Auth::user()->ut->email)
                 {{ Auth::user()->ut->email }}
                @endif
              </p>

              <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">

                  <label for="exampleInputFile">Modifier votre photo de profil</label>
                  <div class="input-group">
                  

                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="profile_picture" accept="image/*" onchange="updateFileName(this)">
                      <label class="custom-file-label" for="exampleInputFile">Choisir une image</label>
                  </div>
                  
                    
                  </div>
                </div>
                <button type="submit"  class="mt-3 btn btn-success">Enregistrer</button>
            </form>

          
            </div>


            <!-- /.card-body -->
          </div>
       
        <!-- /.card -->

        <!-- About Me Box -->
        {{-- <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">A propos de moi</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Education</strong>

            <p class="text-muted">
              B.S. in Computer Science from the University of Tennessee at Knoxville
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted">Malibu, California</p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

            <p class="text-muted">
              <span class="tag tag-danger">UI Design</span>
              <span class="tag tag-success">Coding</span>
              <span class="tag tag-info">Javascript</span>
              <span class="tag tag-warning">PHP</span>
              <span class="tag tag-primary">Node.js</span>
            </p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
          </div>
          <!-- /.card-body -->
        </div> --}}
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Information Personnelle</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Changer mot de passe</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
               
                <div class="callout callout-info">
                  <form action="{{ route('profile.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                      <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Nom</label>
                              <input type="text" name="nom" class="form-control" placeholder="Enter ..." value="{{ Auth::user()->ut ? Auth::user()->ut->nom : '' }}">
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label>Prénom</label>
                              <input type="text" name="prenom" class="form-control" placeholder="Enter ..." value="{{ Auth::user()->ut ? Auth::user()->ut->prenom : '' }}">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <label>Téléphone</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                              </div>
                              <input type="text" name="telephone" class="form-control" data-inputmask='"mask": "(+225) 99-99-99-99-99"' data-mask value="{{ Auth::user()->ut ? Auth::user()->ut->telephone : '' }}">
                            </div>

                        </div>
                        <div class="col-sm-6">
                          <label>Email</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                              </div>
                              <input type="email" name="email" class="form-control" value="{{Auth::user()->ut ? Auth::user()->ut->email : '' }}">
                            </div>

                        </div>
                    </div>
                                   
                    <button type="submit" class="mt-3  btn btn-success">Enregistrer</button>

                  </form>
                </div>

                
               

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">

                <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="callout callout-info">                      <!-- /.card-header -->
                      <!-- form start -->
                      <form role="form" method="POST" action="{{ route("auth.change_password")}}">
                        @csrf
                        @method("PATCH")
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Mot de passe actuelle</label>
                            <input type="password"  name="current_password"  class="form-control" id="current_password">
                          </div>
                          @if($errors->has('current_password'))
                            <p class="help-block">
                              {{ $errors->first('current_password') }}
                            </p>
                          @endif

                          <div class="form-group">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" name="new_password" class="form-control" id="new_password" >
                          </div>

                          @if($errors->has('new_password'))
                            <p class="help-block">
                              {{ $errors->first('new_password') }}
                            </p>
						              @endif

                          <div class="form-group">
                            <label for="new_password_confirmation">Confirmation de mot passe</label>
                            <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" >
                          </div>
                          @if($errors->has('new_password_confirmation'))
                            <p class="help-block">
                              {{ $errors->first('new_password_confirmation') }}
                            </p>
                          @endif

                          
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Enrégistrer</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->                   
                  </div>
                 
                </div>

              
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('javascript')
<script>
  function updateFileName(input) {
      var fileName = input.files[0] ? input.files[0].name : 'Choisir une image';
      var label = input.nextElementSibling;
      label.innerHTML = fileName;

      Toast.fire({
            icon: 'success',
            title: 'Image envoyé veuillez cliquer sur le bouton enrégistrer afin de confirmer'
        });
  }

   @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif
</script>
@endsection