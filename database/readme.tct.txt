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

2. Manajement Server 
 # Pengelola Server
 # Users Pengelola

// create table tb_im_server (id, kode_server, nama_server, alamat_server, link kordinat server, latitude, longitude, pengelola_id, created_at, updated_at)

// create table tb_im_srv_pengelola (id, nama_lengkap, alamat, telpon, created_at, updated_at)

3. Manajement Asets
# Data Asets
# Kategori Assets

// create tb_im_assets (id, kategori_id, nama_assets, keterangan, penanggung_jawab
latitude, longitude, harga_satuan, jumlah, satuan, created_at, updated_at)

// create tb_im_assets_kategori ( id, nama_kategori, keterangan)

4. Manajement Pelanggan
 - Data Pelanggan

// create table (id, id_pelanggan, nama_pelanggan, alamat, telpon, latitude, longitude, status, created_at, updated_at)

5. Manajement Keuangan Pengeluaran dan Pemasukan
 - Data Keuangan
 - Kategori Keuangan
 - Jenis Keuangan
 - Pengelola Keuangan
 - Riwayat Transaksi
 - Laporan Keuangan

// create table tb_im_keuangan (id, kategori_id, jenis_id, pengelola_id, 
pemasukan, pengeluaran, keterangan, foto, created_at, updated_at, no_referensi)

// create table tb_im_keu_kategori (id, nama_kategori, keterangan)

// create table tb_im_keu_jenis (id, nama_jenis, keterangan)

// create table tb_im_keu_pengelola (id, nama_lengkap, telpon, alamat, saldo, created_at, updated_at)

// create table tb_im_keu_riwayat (id, keuangan_id, kategori_id, jenis_id, pengelola_id, keterangan, created_at, updated_at)

6. Manajement Persediaan Kartu Voucher
 - Persediaan Stok Voucher Terkait dengan Server id
 - Pemindahan Pengelolaan Di User Terkait ID user
 - Laporan Pendapatan Seluruh Transaksi
 - Laporan User Poin Pengiriman

# Data Voucher
# Paket Voucher
# Resseler Voucher
# Pengirim Voucher
# Laporan Pendapatan Voucher

7. Management Teksini
 - Pendapatan Dari Pemeliharaan Gangguan Jaringan
 - Pendapatan Dari Pengiriman Kartu Voucher

8. Manajement Ticket Gangguan
 - 


