window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

//kalender
    // Fungsi untuk membuat kalender
    function createCalendar(year, month) {
        // Array untuk nama-nama bulan
        var months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // Membuat objek Date untuk tanggal yang diberikan
        var currentDate = new Date(year, month - 1, 1);
        // Mendapatkan hari pertama dalam bulan (0: Minggu, 1: Senin, ..., 6: Sabtu)
        var firstDay = currentDate.getDay();
        // Mendapatkan jumlah hari dalam bulan yang diberikan
        var daysInMonth = new Date(year, month, 0).getDate();

        // Mendapatkan tanggal hari ini
        var today = new Date();
        var todayYear = today.getFullYear();
        var todayMonth = today.getMonth() + 1;
        var todayDate = today.getDate();

        // Mendapatkan elemen div kalender
        var calendar = document.getElementById("calendar");

        // Menghapus konten kalender sebelumnya
        calendar.innerHTML = "";

        // Membuat judul kalender dengan nama bulan dan tahun
        var header = document.createElement("div");
        header.className = "d-flex justify-content-center align-items-center";
        
        // Tombol Previous
        var prevButton = document.createElement("button");
        prevButton.className = "btn btn-sm btn-primary me-2";
        prevButton.innerHTML = "<i class='fas fa-chevron-left'></i>";
        prevButton.addEventListener("click", function () {
            month -= 1;
            if (month < 1) {
                month = 12;
                year -= 1;
            }
            createCalendar(year, month);
        });
        header.appendChild(prevButton);

        // Teks Bulan dan Tahun
        var monthYearText = document.createElement("h2");
        monthYearText.textContent = months[month - 1] + " " + year;
        header.appendChild(monthYearText);

        // Tombol Next
        var nextButton = document.createElement("button");
        nextButton.className = "btn btn-sm btn-primary ms-2";
        nextButton.innerHTML = "<i class='fas fa-chevron-right'></i>";
        nextButton.addEventListener("click", function () {
            month += 1;
            if (month > 12) {
                month = 1;
                year += 1;
            }
            createCalendar(year, month);
        });
        header.appendChild(nextButton);

        calendar.appendChild(header);

        // Membuat tabel untuk menampilkan kalender
        var table = document.createElement("table");
        table.classList.add("table", "table-info", "table-striped");

        // Membuat baris untuk nama-nama hari
        var headerRow = document.createElement("tr");
        for (var i = 0; i < 7; i++) {
            var cell = document.createElement("th");
            cell.textContent = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"][i];
            headerRow.appendChild(cell);
        }
        table.appendChild(headerRow);

        // Membuat baris-baris untuk setiap minggu dalam bulan
        var row = document.createElement("tr");
        for (var i = 0; i < firstDay; i++) {
            var cell = document.createElement("td");
            cell.textContent = "";
            row.appendChild(cell);
        }
        var day = 1;
        for (var i = firstDay; i < 7; i++) {
            var cell = document.createElement("td");
            if (day === todayDate && year === todayYear && month === todayMonth) {
                cell.classList.add("today");
            }
            cell.textContent = day;
            row.appendChild(cell);
            day++;
        }
        table.appendChild(row);

        // Menambahkan baris-baris untuk sisa hari dalam bulan
        while (day <= daysInMonth) {
            var newRow = document.createElement("tr");
            for (var i = 0; i < 7 && day <= daysInMonth; i++) {
                var cell = document.createElement("td");
                if (day === todayDate && year === todayYear && month === todayMonth) {
                    cell.classList.add("today");
                }
                cell.textContent = day;
                newRow.appendChild(cell);
                day++;
            }
            table.appendChild(newRow);
        }

        // Menambahkan tabel ke dalam div kalender
        calendar.appendChild(table);
    }

    // Memanggil fungsi createCalendar untuk menampilkan kalender saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function () {
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth() + 1; // Bulan dimulai dari 0 (Januari) hingga 11 (Desember)
        createCalendar(currentYear, currentMonth);
    });

