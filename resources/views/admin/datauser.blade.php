@extends('components.layouts.app.sidebar')
@section('title', 'Data User')
@section('style')
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #f5f5f5;
            --accent-color: #e8f5e9;
            --text-color: #333;
            --border-color: #ddd;
        }

        body {
            background-color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Kontainer utama untuk daftar pengguna */
        .team-container {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px;
            margin: 20px auto;
            /* Memberi jarak atas dan bawah */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            /* Sedikit bayangan */
        }

        /* Header di dalam kontainer pengguna (Judul dan tombol) */
        .team-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .team-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
        }

        .team-subtitle {
            font-size: 14px;
            color: #666;
        }

        /* Tombol 'Add User' */
        .invite-btn {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background-color 0.3s ease;
        }

        .invite-btn:hover {
            background-color: #388e3c;
            /* Warna hijau yang lebih gelap saat hover */
        }

        /* Kotak Pencarian */
        .search-box {
            background-color: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-box input {
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 0 10px;
            background-color: transparent;
        }

        .search-box i {
            color: #999;
        }

        /* Gaya Tabel */
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background-color: #f8f8f8;
            font-weight: 600;
            /* Dibuat lebih tebal */
            color: #555;
            text-transform: uppercase;
            /* Huruf besar untuk header */
            font-size: 12px;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
            /* Hapus garis bawah pada baris terakhir */
        }

        /* Info Pengguna (Avatar + Nama) */
        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 14px;
        }

        .user-name {
            font-weight: 500;
            color: var(--text-color);
        }

        /* Kolom Role */
        .table td:nth-child(3) .d-flex {
            cursor: pointer;
            display: inline-flex !important;
            /* Agar menempati ruang seperlunya */
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .table td:nth-child(3) .d-flex:hover {
            background-color: var(--accent-color);
        }

        /* Menu Aksi */
        .action-menu {
            cursor: pointer;
            color: #666;
            font-size: 18px;
            padding: 5px;
            border-radius: 4px;
            transition: color 0.2s, background-color 0.2s;
        }

        .action-menu:hover {
            color: var(--text-color);
            background-color: var(--secondary-color);
        }

        /* Hapus CSS footer yang tidak terpakai */
        .user-footer,
        .user-footer-avatar,
        .user-footer-info,
        .user-footer-name,
        .user-footer-email,
        .user-footer-menu {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="container p-0">
        <div class="row g-0 justify-content-center">
            <!-- Team Settings -->
            <div class="col-md-9">
                <div class="team-container">
                    <div class="team-header">
                        <div>
                            <h3 class="team-title">User</h3>
                            <p class="team-subtitle">Manage user</p>
                        </div>
                        <button class="invite-btn">
                            <i class="bi bi-person-plus"></i>
                            Add User
                        </button>
                    </div>

                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Username</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
if (isset($result) && is_array($result)) {
    foreach ($result as $user) {
        // Extract user data
        $username = $user->USERNAME ?? '';
        '';
        $role = $user->NAMA_ROLE ?? 'Guest';
        // Generate avatar initial
        $initial = substr($username, 0, 1);

        echo '<tr>';
        echo '<td><input type="checkbox" /></td>';
        echo '<td>';
        echo '<div class="user-info">';
        echo '<div class="user-avatar">' . htmlspecialchars($initial) . '</div>';
        echo '<div>';
        echo '<div class="user-name">' . htmlspecialchars($username) . '</div>';
        echo '</div>';
        echo '</div>';
        echo '</td>';
        echo '<td>';
        echo '<div class="d-flex align-items-center">';
        echo '<span>' . htmlspecialchars($role) . '</span>';
        echo '<i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>';
        echo '</div>';
        echo '</td>';
        echo '<td>';
        echo '<i class="bi bi-three-dots-vertical action-menu"></i>';
        echo '</td>';
        echo '</tr>';
    }
}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection