DROP DATABASE IF EXISTS careon_db;
CREATE DATABASE careon_db;
USE careon_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE assessment_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL
);

CREATE TABLE user_answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    question_id INT NOT NULL,
    chosen_option CHAR(1) NOT NULL,
    score INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES assessment_questions(id) ON DELETE CASCADE
);

INSERT INTO assessment_questions (question_text, option_a, option_b, option_c, option_d) VALUES
('Apa yang paling kamu pahami dalam pengelolaan data?', 'Menyimpan data di database', 'Membuat desain poster', 'Mengedit video', 'Membuat animasi'),
('Apa fungsi utama database dalam aplikasi backend?', 'Menyimpan dan mengelola data', 'Mengatur warna website', 'Membuat logo aplikasi', 'Mengatur font'),
('Apa yang biasanya digunakan backend untuk berkomunikasi dengan frontend?', 'API', 'Poster', 'Gambar', 'Slide'),
('Jika ada error pada program, apa yang akan kamu lakukan?', 'Mencari penyebab dan memperbaiki logikanya', 'Langsung menghapus semua file', 'Mengabaikannya', 'Mengganti warna website'),
('Bahasa atau teknologi mana yang sering digunakan untuk backend?', 'PHP', 'Canva', 'Photoshop', 'Figma'),
('Apa yang dimaksud login pada aplikasi?', 'Proses verifikasi pengguna', 'Mengubah warna halaman', 'Menghapus database', 'Membuka browser'),
('Apa fungsi server dalam website?', 'Menjalankan proses dan mengirim data ke pengguna', 'Menggambar ilustrasi', 'Membuat ikon', 'Mengatur ukuran gambar'),
('Apa yang perlu diperhatikan saat menyimpan password?', 'Password harus di-hash', 'Password ditulis di kertas', 'Password dibuat sama semua', 'Password disimpan tanpa keamanan'),
('Apa yang dilakukan query SQL SELECT?', 'Mengambil data dari database', 'Menghapus semua tabel', 'Mengganti nama komputer', 'Membuat desain UI'),
('Jika kamu membuat fitur register, data apa yang wajib disimpan?', 'Username dan password', 'Warna favorit saja', 'Nama browser', 'Ukuran layar');
