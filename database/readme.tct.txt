1. Manajement Users
 - Validasi User Jabatan
 - Validasi User Level

2. Manajemen Inventori (Stok dan persediaan alat)
 #! Inventori
 # Location
 # Suppliers
 # Customers
 # Categories
 # Transaction
 # History

 - Daftar Barang
 - Location
 - Suppliers
 - Customers
 - Categories
 - Transaction
 - History

// create table tb_im_inventori (id, location_id, suppliers_id, customer_id, categories_id, nama_barang, stok, satuan, harga_satuan, keterangan, foto, created_at, updated_at)

//create table tb_im_inv_location (id, nama_lokasi, penanggung_jawab, telpon, alamat, created_at, updated_at)

// create table tb_im_inv_supliers (id, nama_lengkap, telpon, no_rek, nama_no_rek, nama_toko, alamat, created_at, updated_at)

// create table tb_im_inv_customers (id, nama_lengkap, telpon, alamat, created_at, updated_at)

// create table tb_im_inv_categories (id, nama_kategori, keterangan, created_at, updated_at)

// create table tb_im_inv_transaction (id, keterangan, supliers_id, customers_id, inventory_id, pemasukan, pengeluaran, created_at, updated_at)

// create table tb_im_inv_history (id, keterangan, jenis)

4. Manajement Aset 

5. Manajement Server (server ini terkait dengan user pengelola)

6. Manajement Pelanggan (id pelanggan, nama pelanggan, alamat pelanggan, no telpon)

7. Manajement Ticket Gangguan

8. Manajement Validasi Gangguan Pelanggan
 - 

9. Manajement Keuangan Pengeluaran dan Pemasukan
 - Pemasukan 
 - Pengeluaran
 - Laporan Pemasukan dan Pengeluaran

10. Manajement Persediaan Kartu Voucher
 - Persediaan Stok Voucher Terkait dengan Server id
 - Pemindahan Pengelolaan Di User Terkait ID user
 - Laporan Pendapatan Seluruh Transaksi
 - Laporan User Poin Pengiriman

11. Management Pendapatan User
 - Pendapatan Dari Pemeliharaan Gangguan Jaringan
 - Pendapatan Dari Pengiriman Kartu Voucher

