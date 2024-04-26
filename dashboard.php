<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>PKK Arisan Dashboard</title>

  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="grid-container">

  <!-- Sidebar -->
  <aside id="sidebar">
    <div class="sidebar-title">
      <div class="sidebar-brand">
        <span class="material-icons-outlined">groups</span> Website Arisan
      </div>
    </div>

    <ul class="sidebar-list">
      <li class="sidebar-list-item dashboard">
        <a href="#" target="_blank">
          <span class="material-icons-outlined">dashboard</span> Dashboard
        </a>
      </li>
      <li class="sidebar-list-item grup">
        <a href="#" target="_blank">
          <span class="material-icons-outlined">group</span> Kelola Grup
        </a>
      </li>
      <li class="sidebar-list-item anggota">
        <a href="#" target="_blank">
          <span class="material-icons-outlined">person_add</span> Kelola Anggota
        </a>
      </li>
      <li class="sidebar-list-item pertemuan">
        <a href="#" target="_blank">
          <span class="material-icons-outlined">event</span> Pertemuan
        </a>
      </li>
      <li class="sidebar-list-item pembayaran">
        <a href="#" target="_blank">
          <span class="material-icons-outlined">payments</span> Pembayaran
        </a>
      </li>
      <li class="sidebar-list-item laporan">
        <a href="#" target="_blank">
          <span class="material-icons-outlined">book</span> Laporan
        </a>
      </li>
      <li class="logout">
        <a href="logout.php">
          <span class="material-icons-outlined">exit_to_app</span> Logout
        </a>
      </li>
    </ul>
  </aside>
  <!-- End Sidebar -->

  <!-- Header -->
  <header class="header">
    <div class="header-top">
      <div class="header-left">
        <p class="header-title">Dashboard</p>
      </div>
      <div class="header-right">
        <span class="material-icons-outlined">info</span>
        <span class="material-icons-outlined">account_circle</span>
      </div>
    </div>
  </header>
  <!-- End Header -->

  <!-- Main -->
  <main class="main-container">

    <div class="main-cards">

      <div class="card">
        <div class="card-inner">
          <p class="text-primary">Anggota</p>
          <span class="material-icons-outlined text-blue">person</span>
        </div>
        <span class="text-primary font-weight-bold">80</span>
      </div>

      <div class="card">
        <div class="card-inner">
          <p class="text-primary">Grup Arisan</p>
          <span class="material-icons-outlined text-orange">group</span>
        </div>
        <span class="text-primary font-weight-bold">2</span>
      </div>

      <div class="card">
        <div class="card-inner">
          <p class="text-primary">Pertemuan Arisan</p>
          <span class="material-icons-outlined text-red">event</span>
        </div>
        <span class="text-primary font-weight-bold">5</span>
      </div>

      <div class="card">
        <div class="card-inner">
          <p class="text-primary">Pembayaran</p>
          <span class="material-icons-outlined text-green">payments</span>
        </div>
        <span class="text-primary font-weight-bold">25</span>
      </div>

    </div>

    <div class="info">

      <main class="table" id="customers_table">
        <section class="table__header">
          <div class="header-content">
            <h1>Informasi Anggota</h1>
            <div class="search-container">
              <input type="text" id="searchInput" placeholder="Cari anggota...">
              <i class="material-icons-outlined">search</i>
            </div>
          </div>
        </section>
        
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Id </th>
                        <th> Nama </th>
                        <th> Grup </span></th>
                        <th> Status Pembayaran</th>
                        <th> Tanggal Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 1 </td>
                        <td> budi abcdef</td>
                        <td> Grup 1 </td>
                        <td>
                            <p class="status delivered">Sudah Bayar</p>
                        </td>
                        <td> 01/01/2024 </td>
                    </tr>
                    <tr>
                        <td> 2 </td>
                        <td> Yanto abcdef </td>
                        <td> Grup 2 </td>
                        <td>
                            <p class="status cancelled">Belum Bayar</p>
                        </td>
                        <td> 01/01/2024 </td>
                    </tr>
                    <tr>
                      <td> 1 </td>
                      <td> budi abcdef</td>
                      <td> Grup 1 </td>
                      <td>
                          <p class="status delivered">Sudah Bayar</p>
                      </td>
                      <td> 01/01/2024 </td>
                  </tr>
                  <tr>
                      <td> 2 </td>
                      <td> Yanto abcdef </td>
                      <td> Grup 2 </td>
                      <td>
                          <p class="status cancelled">Belum Bayar</p>
                      </td>
                      <td> 01/01/2024 </td>
                  </tr>
                  <tr>
                    <td> 1 </td>
                    <td> budi abcdef</td>
                    <td> Grup 1 </td>
                    <td>
                        <p class="status delivered">Sudah Bayar</p>
                    </td>
                    <td> 01/01/2024 </td>
                </tr>
                <tr>
                    <td> 2 </td>
                    <td> Yanto abcdef </td>
                    <td> Grup 2 </td>
                    <td>
                        <p class="status cancelled">Belum Bayar</p>
                    </td>
                    <td> 01/01/2024 </td>
                </tr>
                <tr>
                  <td> 1 </td>
                  <td> budi abcdef</td>
                  <td> Grup 1 </td>
                  <td>
                      <p class="status delivered">Sudah Bayar</p>
                  </td>
                  <td> 01/01/2024 </td>
              </tr>
              <tr>
                  <td> 2 </td>
                  <td> Yanto abcdef </td>
                  <td> Grup 2 </td>
                  <td>
                      <p class="status cancelled">Belum Bayar</p>
                  </td>
                  <td> 01/01/2024 </td>
              </tr>
                    
                </tbody>
            </table>
        </section>
      </main>
      
    </div>

    <div class="info2">
      <div class="kalender-card">
        <h1>Kalender</h1>
        <div class="calendar-header">
          <div class="nav-icon" id="prev-month">&#10094;</div>
          <h2 id="month-year"></h2>
          <div class="nav-icon" id="next-month">&#10095;</div>
        </div>
        <div class="calendar-body">
          <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
          </div>
          <div class="days"></div>
        </div>
      </div>

      <div class="card-kosong">
        <h1></h1>
      </div> 

    </div>
       

  </main>
  <!-- End Main -->

</div>

<script src="js/scripts.js"></script>
</body>
</html>
