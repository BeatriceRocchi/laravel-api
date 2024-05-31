<header>
    <nav class="navbar-custom">
        <div class="container-fluid d-flex justify-content-between align-items-center h-100">

            {{-- Left-side --}}
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center ">
                    <i class="fa-solid fa-globe"></i>
                    <a class="ms-2" href="{{ route('home') }}" target="_blank">Go to website</a>
                </div>
            </div>

            {{-- Search --}}
            <form class="d-flex align-items-center" role="search" action="{{ route('admin.projects.index') }}"
                method="GET">
                <input class="form-control form-control-custom me-2" type="search" placeholder="Search a project"
                    aria-label="Search" name="toSearch">
                <button class="btn btn-custom-primary-outline" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            {{-- Right-side --}}
            <div class="d-flex justify-content-between align-items-center px-2">
                <div class="mx-3"><i class="fa-solid fa-user-shield"></i> {{ Auth::user()->name }}</div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-custom-primary">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>

        </div>
    </nav>
</header>
