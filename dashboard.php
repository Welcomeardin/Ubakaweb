<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --bg-light: #f3f2ef;
            --bg-dark: #1c1c1e;
            --text-light: #000000;
            --text-dark: #ffffff;
            --card-light: #ffffff;
            --card-dark: #2c2c2e;
            --primary: #2B2D42;
        }

        [data-theme="dark"] {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        [data-theme="dark"] .navbar-custom,
        [data-theme="dark"] .sidebar,
        [data-theme="dark"] .card,
        [data-theme="dark"] .create-post {
            background-color: var(--card-dark) !important;
            color: var(--text-dark);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            overflow-x: hidden;
            color: var(--text-light);
        }

        .navbar-custom {
            background-color: var(--bg-light);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #2B2D42;
        }

        .navbar-left .search-container {
            position: relative;
        }

        .navbar-left input[type="text"] {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 5px 15px 5px 35px;
            width: 250px;
            background-color: #e0e0e0;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .search-icon-mobile {
            display: none;
            background: #eaeaea;
            padding: 8px;
            border-radius: 50%;
        }

        .nav-icons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-icons i {
            cursor: pointer;
            transition: color 0.2s;
        }

        .hamburger {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--primary);
        }

        .user-profile {
            position: relative;
            cursor: pointer;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            min-width: 180px;
            z-index: 1001;
            display: none;
        }

        .user-dropdown a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            color: #333;
        }

        .user-dropdown a:hover {
            background-color: #f5f5f5;
        }

        .user-profile:hover .user-dropdown {
            display: block;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 60px;
            left: 0;
            background-color: var(--card-light);
            border-right: 1px solid #e0e0e0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px;
            text-decoration: none;
            color: #666;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background 0.2s;
        }

        .sidebar-nav a i {
            margin-right: 10px;
        }

        .sidebar-nav a.active {
            background-color: #2B2D42;
            color: white;
        }

        .sidebar-nav a:hover {
            background-color: #eef3f8;
            color: #666;
        }

        .main {
            margin-left: 270px;
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .left-sidebar,
        .center-feed,
        .right-sidebar {
            flex-grow: 1;
        }

        .left-sidebar {
            max-width: 250px;
            position: sticky;
            top: 80px;
            height: fit-content;
            display: flex;
            flex-direction: column;
        }

        .right-sidebar {
            max-width: 250px;
            position: sticky;
            top: 80px;
            height: fit-content;
        }

        .center-feed {
            flex: 2;
        }

        .card {
            border: none;
            border-radius: 12px;
            background: var(--card-light);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .story-container {
            overflow-x: auto;
            display: flex;
            gap: 10px;
            padding: 10px;
            scroll-snap-type: x mandatory;
            position: sticky;
            top: 70px;
            background-color: var(--bg-light);
            z-index: 999;
        }

        .story {
            flex: 0 0 auto;
            width: 120px;
            height: 180px;
            background: #ccc;
            border-radius: 12px;
            scroll-snap-align: start;
            transition: transform 0.3s ease;
        }

        .story:hover {
            transform: scale(1.05);
        }

        .create-post {
            background-color: #eef3f8;
            border-radius: 12px;
            padding: 15px;
        }

        .create-post textarea {
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .create-post input[type="file"] {
            display: block;
            margin-bottom: 10px;
        }

        .deconnexion {
            margin-top: auto;
        }

        .btn-theme-toggle {
            background: none;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .main {
                flex-direction: column;
                margin-left: 0;
            }

            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1001;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .hamburger {
                display: block;
            }

            .navbar-left input[type="text"] {
                display: none;
            }

            .search-icon-mobile {
                display: block;
            }

            .story-container {
                position: sticky;
                top: 60px;
            }

            .left-sidebar {
                order: 4;
            }
        }

        @media (max-width: 767px) {
            .nav-icons {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: #fff;
                padding: 10px 0;
                justify-content: space-around;
                z-index: 1002;
                box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
            }

            .nav-icons i {
                font-size: 24px;
            }

            .navbar-custom {
                padding-bottom: 60px;
            }
        }

        @media (max-width: 767.98px) {
            .card {
                width: 100vw;
                margin-left: -12px;
                /* Adjust if your container has padding */
                margin-right: -12px;
                border-radius: 0;
                /* Optional: make it edge-to-edge */
            }
        }
    </style>
</head>

<body>
    <div class="navbar-custom">
        <div class="navbar-inner">
            <div class="navbar-left">
                <div class="nav-brand">OpenRoots</div>
                <div class="search-container">
                    <i data-feather="search" class="search-icon mr-2"></i>
                    <input type="text" placeholder=" Rechercher Openroots" style="border: 0; border-radius:3px;" />
                </div>
            </div>
            <div class="nav-icons">
                <i data-feather="home"></i>
                <i data-feather="message-circle"></i>
                <i data-feather="plus-square"></i>
                <i data-feather="users"></i>
                <div class="user-profile">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                    <div class="user-dropdown">
                        <a href="#"><i data-feather="user"></i> Profile</a>
                        <a class="btn-theme-toggle" onclick="toggleTheme()">
                            <i data-feather="sun"></i>Light
                        </a>
                        <a href="#"><i data-feather="settings"></i> Settings</a>
                        <a href="#"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </div>
                <i data-feather="menu" class="hamburger" onclick="toggleSidebar()"></i>
            </div>
        </div>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-nav">
            <a href="#" class="active"><i data-feather="home" class=""></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a>
            <a href="#"><i data-feather="message-circle"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Messages</a>
            <a href="#"><i data-feather="plus-square"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Publication</a>
            <a href="#"><i data-feather="users"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Communauté</a>
            <a href="#"><i data-feather="bell"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notifications</a>
            <a href="#"><i data-feather="user"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profile</a>
            <a href="#"><i data-feather="settings"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parametre</a>
        </div>
        <div class="deconnexion">
            <a href="#"><i data-feather="log-out"></i> Déconnexion</a>
        </div>
    </div>

    <div class="main">
        <div class="left-sidebar">
            <div class="card p-3 rounded-2">
                <h6 style="font-weight:bold; font-family:sans-serif;">Utilisateurs</h6>
                <p>Liste de membres actifs.</p>
            </div>
            <div class="card p-3 rounded-2">
                <button class="btn w-100" style="background-color: #2B2D42; color:white; font-family:sans-serif;">+ Créer une communauté</button>
            </div>
        </div>

        <div class="center-feed">
            <div class="card p-3 rounded-2">
                <h6 style="font-weight:bold; font-family:sans-serif;">Stories</h6>
                <div class="story-container">
                    <div class="story"></div>
                    <div class="story"></div>
                    <div class="story"></div>
                    <div class="story"></div>
                </div>
            </div>
            <div class="card create-post p-3 shadow-sm rounded-2 border-0" style="background-color: white;">
                <h6 class="fw-bold mb-3" style="font-family: sans-serif;">Créer une publication</h6>

                <textarea class="form-control mb-3 rounded-2" rows="2" placeholder="Exprimez-vous..."></textarea>

                <!-- Action buttons row -->
                <div class="d-flex justify-content-between align-items-center gap-2">
                    <!-- Image Upload Icon Button -->
                    <label for="imageUpload" class="btn bg-light border-0 rounded-1 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i data-feather="image" class="text-secondary"></i>
                    </label>
                    <input type="file" id="imageUpload" class="d-none" />

                    <!-- Publish Button -->
                    <button class="btn flex-grow-1 rounded-1 text-light" style="background-color: #2B2D42;"><i data-feather="send"></i> Publier </button>
                </div>
            </div>

            <div class="card p-3 rounded-2">
                <p><strong>Mr Ardin</strong> - Bonjour, bienvenue!</p>
            </div>
        </div>

        <div class="right-sidebar">
            <div class="card p-3 rounded-2">
                <h6 style="font-weight:bold; font-family:sans-serif;">Demandes d'ami</h6>
                <p>Aucune nouvelle demande.</p>
            </div>
            <div class="card p-3 rounded-2">
                <h6 style="font-weight:bold; font-family:sans-serif;">Suggestions</h6>
                <p>Rejoignez de nouvelles communautés.</p>
            </div>
            <div class="card p-3 rounded-2">
                <h6 style="font-weight:bold; font-family:sans-serif;">Activités</h6>
                <p>Vos dernières interactions.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        function toggleTheme() {
            const root = document.documentElement;
            const isDark = root.getAttribute('data-theme') === 'dark';
            root.setAttribute('data-theme', isDark ? 'light' : 'dark');

            // Change the icon based on theme
            const themeIcon = document.querySelector('.btn-theme-toggle i');
            if (isDark) {
                themeIcon.setAttribute('data-feather', 'sun');
            } else {
                themeIcon.setAttribute('data-feather', 'moon');
            }
            feather.replace();
        }

        feather.replace();
    </script>
</body>

</html>