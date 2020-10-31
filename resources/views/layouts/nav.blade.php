<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark scrolling-navbar">
    <a class="navbar-brand" href="#"><strong>Lazy Dev</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item {{ Route::current()->getName()==='index' ? "active" : '' }}">
                <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ Route::current()->getName()==='posts.all' ? "active" : '' }}">
                <a class="nav-link" href="{{ route('posts.all') }} ">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
        </ul>
        <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
                <a class="nav-link"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"><i class="fab fa-twitter"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"><i class="fab fa-instagram"></i></a>
            </li>
        </ul>
    </div>
</nav>
