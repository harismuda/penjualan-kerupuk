<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap 5 Side Bar Navigation</title>
    <!-- bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <!-- BOX ICONS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('desain') }}/css/style.css" />
</head>

<body>
    <!-- Side-Nav -->
    <div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
        <ul class="nav flex-column text-white w-100">
            <h5 class="my-2 nav-link">Penjualan Kerupuk</h5>
            <a href="{{ url('/dashboar') }}" class="nav-link text-white {{ request()->routeIs('/dashboar') ? 'active':'' }}">
                <li>
                    <iconify-icon icon="ion:home"></iconify-icon>
                    <span class="mx-2">Home</span>
                </li>
            </a>
            <a href="#" class="nav-link text-white">
                <li>
                    <iconify-icon icon="fluent:list-bar-20-filled"></iconify-icon>
                    <span class="mx-2">List Kerupuk</span>
                </li>
            </a>
            <a href="{{ url('/activity') }}" class="nav-link text-white {{ request()->routeIs('/activity') ? 'active':'' }}">
                <li>
                    <iconify-icon icon="material-symbols:history"></iconify-icon>
                    <span class="mx-2">Activity</span>
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
        {{-- <h3 class="text-dark p-3">RESPONSIVE SIDEBAR NAV 💻 📱
        </h3>
        <p class="px-3">Responsive navigation sidebar built using <a class="text-dark"
                href="https://getbootstrap.com/">Bootstrap 5</a>.</p>
        <p class="px-3"><a href="https://github.com/harshitjain-hj" class="text-dark">Checkout my Github</a></p> --}}
    </div>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>
<script>
    var menu_btn = document.querySelector("#menu-btn");
    var sidebar = document.querySelector("#sidebar");
    var container = document.querySelector(".my-container");
    menu_btn.addEventListener("click", () => {
        sidebar.classList.toggle("active-nav");
        container.classList.toggle("active-cont");
    });
</script>

</html>
