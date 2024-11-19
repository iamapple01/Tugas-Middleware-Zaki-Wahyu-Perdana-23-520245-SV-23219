<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <style>
        body {
            padding: 20px;
            font-family: Arial, sans-serif;
            margin: 10px;
        }
        .book-list {
            margin-top: 5px;
        }
        .book-item {
            border-bottom: 2px solid #ccc;
            padding: 5px 0;
        }
        .pagination {
            margin-top: 5px;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1>List Data Buku</h1>
    <div class="book-list" id="bookList">
        <!-- API data will be displayed here -->
    </div>
    <div class="pagination" id="pagination">
        <!-- Pagination links will be displayed here -->
    </div>

    <script>
        const apiBaseURL = 'http://127.0.0.1:8000/api/buku'; // Sesuaikan dengan URL API Anda
        let currentPage = 1;

        // Fungsi untuk mengambil data dari API
        function fetchBooks(page = 1) {
            fetch(`${apiBaseURL}?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    displayBooks(data.data.data);
                    displayPagination(data.data.links);
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk menampilkan data buku di halaman
        function displayBooks(books) {
            const bookList = document.getElementById('bookList');
            bookList.innerHTML = ''; // Kosongkan data sebelumnya

            books.forEach(book => {
                const bookItem = document.createElement('div');
                bookItem.classList.add('book-item');
                bookItem.innerHTML = `
                    <h2>${book.judul}</h2>
                    <p><strong>Penulis:</strong> ${book.penulis}</p>
                    <p><strong>Harga:</strong> Rp ${book.harga.toLocaleString()}</p>
                    <p><strong>Tanggal Terbit:</strong> ${book.tgl_terbit}</p>
                `;
                bookList.appendChild(bookItem);
            });
        }

        // Fungsi untuk menampilkan tautan pagination
        function displayPagination(links) {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = ''; // Kosongkan data pagination sebelumnya

            links.forEach(link => {
                const pageLink = document.createElement('a');
                pageLink.href = '#';
                pageLink.innerHTML = link.label;
                pageLink.classList.add(link.active ? 'active' : '');
                
                if (link.url) {
                    pageLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        const url = new URL(link.url);
                        const page = url.searchParams.get('page');
                        fetchBooks(page);
                    });
                }

                pagination.appendChild(pageLink);
            });
        }

        // Panggil fetchBooks pertama kali untuk halaman pertama
        fetchBooks(currentPage);
    </script>

</body>
</html>
