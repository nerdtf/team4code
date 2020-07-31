<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/contacts">Contacts</a>
            </li>

            @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link disabled">Hello, {{Auth::user()->name}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/user/destroy">Logout</a>
                </li>
            @else

            <li class="nav-item">
                <a class="nav-link" href="/registration">Registration</a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            @endif



        </ul>
    </div>
</nav>