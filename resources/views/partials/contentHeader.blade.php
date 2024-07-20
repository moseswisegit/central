 <!-- Main content -->
 <section class="content-header">
  <div class="container-fluid">

      <div class="row mb-2">
        <div class="col-sm-6">
          @if(isset($enteteContent))
              <h1>
                  {{ $enteteContent }}
              </h1>
          @endif
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">
              @if(isset($enteteContent))
                  {{ $enteteContent }}
              @endif
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>