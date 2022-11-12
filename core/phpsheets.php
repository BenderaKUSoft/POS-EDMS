<?php
// Load file autoload.php
require '../vendor/autoload.php';

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel {
    public static function saveExcel($status_download) {
        // Koneksi DB
        include ('../config/config.php');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', "DATA WAREHOUSE"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "WAREHOUSEID"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "DISPLAY NAMA"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "PROVINSI ID"); // Set kolom E3 dengan tulisan "TELEPON"
        $sheet->setCellValue('F3', "REGENSI KOTA ID"); // Set kolom F3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "DSTRIK ID"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('H3', "KOTA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('I3', "ORIGIN ID"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('J3', "STATUS GUDANG"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('K3', "INTERNAL"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('L3', "ALAMAT"); // Set kolom C3 dengan tulisan "NAMA"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);
        $sheet->getStyle('L3')->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        $sheet->getRowDimension('1')->setRowHeight(20);
        $sheet->getRowDimension('2')->setRowHeight(20);
        $sheet->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        $sql = mysqli_query($conn, "SELECT * FROM warehouses");
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $row = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $data['warehousesId']);
            $sheet->setCellValue('C' . $row, $data['name']);
            $sheet->setCellValue('D' . $row, $data['displayName']);
            $sheet->setCellValue('E' . $row, $data['provinceId']);
            $sheet->setCellValue('F' . $row, $data['cityregencyId']);
            $sheet->setCellValue('G' . $row, $data['districtId']);
            $sheet->setCellValue('H' . $row, $data['city']);
            $sheet->setCellValue('I' . $row, $data['idorigin']);
            $sheet->setCellValue('J' . $row, $data['statusGudang']);
            $sheet->setCellValue('K' . $row, $data['internal']);
            $sheet->setCellValue('L' . $row, $data['address']);
            // Khusus untuk no telepon. kita set type kolom nya jadi STRING
            // $sheet->setCellValueExplicit('E' . $row, $data['telp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            // $sheet->setCellValue('F' . $row, $data['alamat']);
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $row)->applyFromArray($style_row);
            $sheet->getStyle('B' . $row)->applyFromArray($style_row);
            $sheet->getStyle('C' . $row)->applyFromArray($style_row);
            $sheet->getStyle('D' . $row)->applyFromArray($style_row);
            $sheet->getStyle('E' . $row)->applyFromArray($style_row);
            $sheet->getStyle('F' . $row)->applyFromArray($style_row);
            $sheet->getStyle('G' . $row)->applyFromArray($style_row);
            $sheet->getStyle('H' . $row)->applyFromArray($style_row);
            $sheet->getStyle('I' . $row)->applyFromArray($style_row);
            $sheet->getStyle('J' . $row)->applyFromArray($style_row);
            $sheet->getStyle('K' . $row)->applyFromArray($style_row);
            $sheet->getStyle('L' . $row)->applyFromArray($style_row);
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom No
            $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text left untuk kolom NIS
            $sheet->getRowDimension($row)->setRowHeight(20); // Set height tiap row
            $no++; // Tambah 1 setiap kali looping
            $row++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('H')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('I')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('J')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('K')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('L')->setWidth(30); // Set width kolom F
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        if ($status_download == True) {
            $data = $_SESSION['data'];

            if (is_array($data)) {
                $id = $data['download_id'];
            }

            // Set judul file excel nya
            $sheet->setTitle("Data Warehouse");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Warehouse.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');

            $random_number = rand();

            $writer = new Xlsx($spreadsheet);
            $writer->save('C:\xampp\htdocs\edms_ethos\storage\Warehouse_'.$random_number.'.xlsx');

            $query = mysqli_query($conn, "SELECT path_file FROM downloads WHERE Id='$id'");
            $row = mysqli_fetch_array($query);

            if ($row['path_file'] == null) {
                $path = ('storage/Warehouse_'.$random_number.'.xlsx');

                $set_path = mysqli_query($conn, "UPDATE downloads SET path_file='$path' WHERE Id='$id'");
            } else if ($row['path_file'] > 0) {
                $old_path = $row['path_file'];

                $set_old_path = mysqli_query($conn, "UPDATE downloads SET old_path_file='$old_path' WHERE Id='$id'");

                if ($set_old_path) {
                    $new_path = ('storage/Warehouse_'.$random_number.'.xlsx');

                    $update_new_path = mysqli_query($conn, "UPDATE downloads SET path_file='$new_path' WHERE Id='$id'");

                    $files = glob('../'.$old_path);

                    if ($files) {
                        foreach ($files as $file) {
                            if (is_file($file)) {
                                unlink($file); // hapus file
                            }
                        }
                    }
                }
            }
        }
    }
}

?>