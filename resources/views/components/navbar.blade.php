<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('invoice') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsNavbar" aria-controls="collapsNavbar"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-list    "></i>
    </button>
    <div class="collapse navbar-collapse" id="collapsNavbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('invoice') }}">{{ __('invoice.home') }} <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('invoice.create') }}">{{ __('invoice.create') }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#">Action 1</a>
                    <a class="dropdown-item" href="#">Action 2</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="d-inline mx-4">
            <a href="{{ route('change_locale', 'ar') }}" class="btn {{ app()->getLocale() == 'ar'? 'btn-primary' :'btn-outline-primary' }}">Arabic</a>
            <a href="{{ route('change_locale', 'en') }}" class="btn {{ app()->getLocale() == 'en'? 'btn-primary' :'btn-outline-primary' }}">english</a>
        </div>
    </div>
</nav>
