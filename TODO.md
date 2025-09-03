# TODO: Fix Payment Coding Errors

## Issues Identified
1. Payment method options in edit view don't match controller validation (ewallet vs qris)
2. Period field not handled in controller store method
3. Petugas field type mismatch (string in migration, int in controller)
4. Bukti pembayaran file upload not handled in update method
5. Edit form missing enctype for file upload

## Steps to Fix
- [x] Update payment_method options in edit.blade.php to match controller (cash, transfer, qris)
- [x] Add period field validation and handling in PaymentController store method
- [x] Check and fix petugas field type in migration or controller
- [x] Add bukti_pembayaran handling in PaymentController update method
- [x] Add enctype="multipart/form-data" to edit form
- [x] Add period field to create and edit forms
- [x] Test payment creation and update flows
