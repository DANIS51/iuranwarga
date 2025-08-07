<style>
    .dropdown-menu {
        max-height: 300px;
        overflow-y: auto;
    }

    .category-item {
        padding: 8px 16px;
        cursor: pointer;
    }

    .category-item:hover {
        background-color: #f8f9fa;
    }

    .add-category-btn {
        border-top: 1px solid #dee2e6;
        font-weight: bold;
    }
</style>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Kategori
    </a>
    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
        @foreach($categories as $category)
            <li>
                <a class="dropdown-item category-item" href="#">
                    {{ $category->period }} - Rp {{ number_format($category->nominal, 0, ',', '.') }}
                </a>
            </li>
        @endforeach

        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item add-category-btn" href="{{ route('categories.add') }}">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </li>
    </ul>
</li>
