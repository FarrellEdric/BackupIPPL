<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>

    <style>
        /* ===== RESET & FONT ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Poppins", system-ui, sans-serif;
            background: linear-gradient(135deg, #e0e7ff, #f3f4f6);
            color: #1f2937;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== CONTAINER ===== */
        .container {
            display: flex;
            min-height: 100vh;
            backdrop-filter: blur(10px);
        }

        /* ===== SIDEBAR (Glass Morphism) ===== */
        .sidebar {
            width: 260px;
            background: rgba(67, 56, 202, 0.85);
            color: white;
            display: none;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(16px);
        }

        .sidebar-header {
            padding: 1.5rem;
            font-size: 1.6rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .sidebar-header span {
            color: #fde047;
        }

        .sidebar-nav {
            flex-grow: 1;
            padding: 1rem;
        }

        .sidebar-nav a {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            transition: 0.3s;
            margin-bottom: 0.5rem;
        }

        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.25);
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .btn-logout {
            width: 100%;
            background: rgba(239, 68, 68, 0.8);
            border: none;
            padding: 0.5rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: 600;
            cursor: pointer;
            backdrop-filter: blur(8px);
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: rgba(220, 38, 38, 1);
            transform: scale(1.03);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex-grow: 1;
            padding: 2rem;
            position: relative;
        }

        /* ===== MOBILE HEADER ===== */
        .mobile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .mobile-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4338CA;
        }

        .menu-toggle {
            font-size: 2rem;
            background: none;
            border: none;
            color: #4338CA;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .menu-toggle.open {
            transform: rotate(90deg);
        }

        /* ===== MOBILE MENU ===== */
        .mobile-menu {
            background: rgba(79, 70, 229, 0.85);
            color: white;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(16px);
            animation: fadeIn 0.3s ease;
        }

        .mobile-menu a {
            display: block;
            padding: 0.6rem 0.8rem;
            border-radius: 0.4rem;
            color: white;
            text-decoration: none;
            transition: 0.2s;
        }

        .mobile-menu a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* ===== CARDS (Glass Style) ===== */
        .card-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: 1fr;
        }

        .card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(12px);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 25px rgba(67, 56, 202, 0.2);
        }

        .card h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #4338CA;
            margin-bottom: 0.75rem;
        }

        .card p {
            color: #4B5563;
            margin-bottom: 1rem;
        }

        .card .btn {
            display: inline-block;
            background: rgba(79, 70, 229, 0.9);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        .card .btn:hover {
            background: rgba(67, 56, 202, 1);
            transform: scale(1.05);
        }

        /* ===== UTILITIES ===== */
        .hidden {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== RESPONSIVE ===== */
        @media (min-width: 768px) {
            .sidebar {
                display: flex;
            }

            .mobile-header {
                display: none;
            }

            .mobile-menu {
                display: none !important;
            }

            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <span>Owner</span> Dashboard
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="active">📊 Dashboard</a>
                <a href="#">🛍️ Produk</a>
                <a href="#">👨‍💼 Kasir</a>
                <a href="#">📑 Laporan</a>
            </nav>
            <div class="sidebar-footer">
                <button class="btn-logout">🚪 Logout</button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <div class="mobile-header">
                <h1 class="mobile-title">Owner Dashboard</h1>
                <button id="menu-toggle" class="menu-toggle">☰</button>
            </div>

            <div id="mobile-menu" class="mobile-menu hidden">
                <a href="#">📊 Dashboard</a>
                <a href="#">🛍️ Produk</a>
                <a href="#">👨‍💼 Kasir</a>
                <a href="#">📑 Laporan</a>
                <button class="btn-logout">🚪 Logout</button>
            </div>

            <div class="card-grid">
                <div class="card">
                    <h2>🛍️ Manajemen Produk</h2>
                    <p>Tambah, ubah, atau hapus produk yang tersedia di sistem kasir.</p>
                    <a href="#" class="btn">Kelola Produk</a>
                </div>

                <div class="card">
                    <h2>👨‍💼 Akun Kasir</h2>
                    <p>Atur akun pengguna dengan peran kasir dan kelola hak akses mereka.</p>
                    <a href="#" class="btn">Kelola Kasir</a>
                </div>

                <div class="card">
                    <h2>📑 Laporan Penjualan</h2>
                    <p>Lihat laporan penjualan dan ekspor data ke PDF atau Excel.</p>
                    <a href="#" class="btn">Lihat Laporan</a>
                </div>
            </div>
        </main>
    </div>

    <script>
        const menuToggle = document.getElementById("menu-toggle");
        const mobileMenu = document.getElementById("mobile-menu");

        menuToggle?.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
            menuToggle.classList.toggle("open");
            menuToggle.textContent = menuToggle.classList.contains("open") ? "✕" : "☰";
        });
    </script>
</body>

</html>
