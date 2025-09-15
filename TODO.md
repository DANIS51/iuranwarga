# TODO: Update Payment Status Logic for Partial Payments

## Tasks
- [x] Update DuesMember model constants and methods to use 'belum_lunas' instead of 'sebagian'
- [x] Update PaymentObserver to set status to 'belum_lunas' for partial payments
- [x] Update database migration to change enum values from 'sebagian' to 'belum_lunas'
- [x] Test the changes by running migrations and verifying status updates

## Fix Navbar Officer Error

## Tasks
- [x] Fix incorrect route in navbar-officer.blade.php for "Tambah Pembayaran" link
- [x] Add route for officer payments create
- [x] Add createForOfficer method in PaymentController
- [x] Create view for officer payments create
- [x] Update store method to redirect properly for officers
- [x] Fix "Data Anggota Iuran" and "Data Pembayaran" links to use correct routes
- [x] Add route for officer payments index
- [x] Add allPayments method in OfficerController
- [x] Create view for officer payments index
