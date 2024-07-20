<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.head')
</head>


<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    @include('partials.topbar')
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.contentHeader')        
        <section class="content">
            <!-- Ajoutez ce formulaire à votre code HTML -->
            <form id="logout" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @yield('content')
        </section>

        
    </div>


    {{-- {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
    <button type="submit">Logout</button>
    {!! Form::close() !!} --}}


    @include('partials.footer')

    @include('partials.controleSidebar')
</div>
@include('partials.javascripts')

</body>
</html>