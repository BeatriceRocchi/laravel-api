<aside>
    <nav>
        <ul>
            <li>
                <i class="fa-solid fa-house"></i>
                <a href="{{ route('admin.home') }}">Home</a>
            </li>
            <li>
                <i class="fa-solid fa-folder-open"></i>
                <a href="{{ route('admin.projects.index') }}">Projects records</a>
            </li>
            <li>
                <i class="fa-solid fa-tag"></i>
                <a href="{{ route('admin.projects-type') }}">Projects by type</a>
            </li>
            <li>
                <i class="fa-solid fa-folder-plus"></i>
                <a href="{{ route('admin.projects.create') }}">Add project</a>
            </li>

            <li>
                <i class="fa-solid fa-wrench"></i>
                <button class="btn collapse-btn-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                    Manage attributes
                </button>
                <div>
                    <div class="collapse collapse-vertical" id="collapseWidthExample">
                        <ul>
                            <li>
                                <a href="{{ route('admin.technologies.index') }}">Manage technologies</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.types.index') }}">Manage types</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

        </ul>
    </nav>
</aside>
