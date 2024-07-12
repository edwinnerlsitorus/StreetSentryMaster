<?php
require('libs/fpdf.php');

class PDF extends FPDF {
    // Header
    function Header() {
        $this->SetLineWidth(0.5);
        // Title
        $this->SetFont('Arial', 'B', 12);
        $this->Line(10, 12, 200, 12);
        $this->Cell(0, 10, 'SURVEY PEMELIHARAAN RUTIN JALAN', 0, 1, 'C');
        $this->Line(10, 23, 200, 23);
        $this->Cell(0, 0, 'CATATAN KONDISI DAN HASIL PENGUKURAN', 0, 1, 'C');
        $this->Line(10, 12, 10, 23);
        $this->Line(200, 12, 200, 23);
        $this->Ln(5);

        // Set font
        $this->SetFont('Arial', '', 10);

        $headerInfo = [
            // Contoh baris pertama
            [
                'PROVINSI                                              :', // Teks sebelum titik dua
                'TANGGAL SURVEY              : ', // Teks setelah titik dua
                100, // Panjang sel untuk kolom pertama
                100, // Panjang sel untuk kolom kedua
            ],
            // Contoh baris kedua
            [
                'BALAI BESAR/BALAI                             :',
                'CUACA                                  :',
                100,
                100,
            ],
            // Dan seterusnya untuk setiap baris
            [
                'SATKER                                                 :',
                'STATUS JALAN                    :',
                100,
                100,
            ],
            [
                'PPK                                                        :',
                'SEGMENT JALAN                : KM :          -   KM :      ',
                100,
                100,
            ],
            [
                'NOMOR RUAS JALAN                          :',
                '',
                100,
                100,
            ],
            [
                'NAMA RUAS JALAN                             :',
                '',
                100,
                100,
            ],
        ];

        // Mendapatkan posisi awal
        $yStart = $this->GetY();
   
        // Menggambar garis vertikal
        $this->Line(10, $yStart - 0, 10, $yStart + 60); // Garis vertikal kiri
        $this->Line(200, $yStart - 0, 200, $yStart + 60); // Garis vertikal kanan

        // Menggambar garis horizontal
        $this->Line(10, $yStart - 0, 200, $yStart + 0);

        // Menggambar baris header info
        foreach ($headerInfo as $info) {
            // Teks pertama
            $this->SetFont('Arial', '', 10); // Font tebal, ukuran 10
            $this->MultiCell($info[2], 6, $info[0], 0, 'L');
            // Teks kedua
            $this->SetFont('Arial', '', 10); // Font biasa, ukuran 10
            $this->SetXY(110, $this->GetY() - 6); // Geser posisi X ke kanan
            $this->MultiCell($info[3], 6, $info[1], 0, 'L');
        }

        $this->Ln(5); // Jarak setelah header info

        // Column headers with background color
        $this->SetFont('Arial', 'B', 6.5);
        $this->SetFillColor(200, 200, 200); // Gray background
        $this->Cell(8, 20, 'NO.', 1, 0, 'C', true);
        $this->Cell(18, 20, 'STA (km)', 1, 0, 'C', true);
        $this->Cell(20, 10, 'POSISI', 1, 0, 'C', true);
        $this->Cell(30, 20, 'KATEGORI KERUSAKAN', 1, 0, 'B', true);
        $this->Cell(84, 10, 'UKURAN', 1, 0, 'C', true);
        $this->SetX($this->GetX() - 0);
        $this->Cell(30, 20, 'KETERANGAN', 1, 1, 'C', true);

        // Sub-headers for 'POSISI'
        $this->SetFont('Arial', 'B', 6);
        $this->Cell(10, 10, '', 0, 0);
        $this->Cell(20, 10, '', 0, 0);
        $this->SetX($this->GetX() - 4);
        $this->Cell(10, -10, 'KIRI', 1, 0, 'C', true);
        $this->SetX($this->GetX() + 0);
        $this->Cell(10, -10, 'KANAN', 1, 0, 'C', true);
        $this->Cell(30, 10, '', 0, 0);

        // Sub-headers for 'UKURAN'
        $ukuranHeaders = ['P (m)', 'L (m)', 'D (m)', 'A (m2)', 'V (m3)', 'J (Buah)'];
        foreach ($ukuranHeaders as $header) {
            $this->SetFont('Arial', 'B', 6);
            $this->Cell(14, -10, $header, 1, 0, 'C', true);
        }
        $this->Cell(40, 10, '', 0, 1);

        $this->Ln(5);
    }

    // Footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Table data from information_jalur
    function LoadDataInformationJalur($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Table data from information
    function LoadDataInformation($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Table for information_jalur
    function TableInformationJalur($data) {
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            $yBeforeRow = $this->GetY(); // Simpan posisi awal sebelum menggambar baris
    
            // Naikkan posisi ke atas sebelum menggambar baris
            $this->SetY($this->GetY() - 15);
    
            $this->Cell(8, 10, $row['id'], 1);
            $this->Cell(10, 10, $row['posisi_kiri'], 1); // Posisi KIRI
            $this->Cell(10, 10, $row['posisi_kanan'], 1); // Posisi KANAN
            $this->Cell(30, 10, $row['kategori_kerusakan'], 1);
            $this->Cell(14, 10, $row['ukuran_p'], 1); // Ukuran P
            $this->Cell(14, 10, $row['ukuran_l'], 1); // Ukuran L
            $this->Cell(14, 10, $row['ukuran_d'], 1); // Ukuran D
            $this->Cell(14, 10, $row['ukuran_a'], 1); // Ukuran A
            $this->Cell(14, 10, $row['ukuran_v'], 1); // Ukuran V
            $this->Cell(14, 10, $row['ukuran_j'], 1); // Ukuran J
            $this->MultiCell(30, 10, $row['keterangan'], 1);
    
            // Kembalikan posisi ke posisi awal setelah menggambar baris
            $this->SetY($yBeforeRow);
    
            $this->Ln(); // Baris baru
        }
    }

    // Table for information
    function TableInformation($data) {
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            $yBeforeRow = $this->GetY(); // Simpan posisi awal sebelum menggambar baris
    
            // Naikkan posisi ke atas sebelum menggambar baris
            $this->SetY($this->GetY() - 15);
    
            $this->Cell(8, 10, $row['id'], 1);
            // Tambahkan kolom-kolom tambahan dari tabel 'information'
            // Pastikan untuk menyesuaikan dengan struktur data di tabel 'information'
            $this->Cell(100, 10, $row['province'], 1);
            $this->Cell(100, 10, $row['balai_besar'], 1);
            $this->Cell(100, 10, $row['satker'], 1);
            $this->Cell(100, 10, $row['ppk'], 1);
            $this->Cell(100, 10, $row['nomor_ruas_jalan'], 1);
            $this->Cell(100, 10, $row['nama_ruas_jalan'], 1);
            $this->Cell(100, 10, $row['tanggal_survey'], 1);
            $this->Cell(100, 10, $row['cuaca'], 1);
            $this->Cell(100, 10, $row['status_jalan'], 1);
            $this->Cell(100, 10, $row['awal'], 1);
            $this->Cell(100, 10, $row['akhir'], 1);

            // Kembalikan posisi ke posisi awal setelah menggambar baris
            $this->SetY($yBeforeRow);
    
            $this->Ln(); // Baris baru
        }
    }
    
}

// Data fetching
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "street_sentry";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk tabel 'information_jalur'
$sql_jalur = "SELECT id, posisi_kiri, posisi_kanan, kategori_kerusakan, ukuran_p, ukuran_l, ukuran_d, ukuran_a, ukuran_v, ukuran_j, keterangan FROM information_jalur";
$result_jalur = $conn->query($sql_jalur);
if (!$result_jalur) {
    die("Query gagal: " . $conn->error);
}

// Query untuk tabel 'information'
$sql_info = "SELECT * FROM information";
$result_info = $conn->query($sql_info);
if (!$result_info) {
    die("Query gagal: " . $conn->error);
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$data_jalur = $pdf->LoadDataInformationJalur($result_jalur);
$pdf->TableInformationJalur($data_jalur);

$pdf->AddPage(); // Halaman baru untuk data dari tabel 'information'
$data_info = $pdf->LoadDataInformation($result_info);
$pdf->TableInformation($data_info);

$pdf->Output();

$conn->close();