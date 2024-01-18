<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apps Penjualan Kerupuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <link rel="stylesheet" href="{{ asset('desain') }}/css/style.css" />
</head>

<body>
    <div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
        <ul class="nav flex-column text-white w-100">
            <h5 class="my-2 nav-link text-white">Penjualan Kerupuk</h5>
            <a href="{{ url('/dashboar') }}"
                class="nav-link text-white {{ request()->routeIs('/dashboar') ? 'active' : '' }}">
                <li>
                    <iconify-icon icon="ion:home"></iconify-icon>
                    <span class="mx-2">Home</span>
                </li>
            </a>
            <a href="{{ url('/kerupuk') }}" class="nav-link text-white">
                <li>
                    <iconify-icon icon="fluent:list-bar-20-filled"></iconify-icon>
                    <span class="mx-2">Kerupuk</span>
                </li>
            </a>
            <a href="{{ url('/sell') }}"
                class="nav-link text-white {{ request()->routeIs('/activity') ? 'active' : '' }}">
                <li>
                    <iconify-icon icon="ep:sell"></iconify-icon>
                    <span class="mx-2">Sell</span>
                </li>
            </a>
            <a href="{{ url('/activity') }}"
                class="nav-link text-white {{ request()->routeIs('/activity') ? 'active' : '' }}">
                <li>
                    <iconify-icon icon="material-symbols:history"></iconify-icon>
                    <span class="mx-2">Log / Activity</span>
                </li>
            </a>
            <a href="{{ url('logout') }}" class="nav-link text-white">
                <li>
                    <iconify-icon icon="tdesign:logout"></iconify-icon>
                    <span class="mx-2">Logout</span>
                </li>
            </a>
        </ul>
    </div>
    <div class="p-1 my-container active-cont">
        <nav class="navbar top-navbar navbar-light bg-light px-5">
            <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
        </nav>
        @yield('konten')
    </div>
</body>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('desain') }}/js/script.js"></script>
</html>
