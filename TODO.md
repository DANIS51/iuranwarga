# TODO: Update Payment Status Logic for Partial Payments

## Tasks
- [ ] Update DuesMember model constants and methods to use 'belum_lunas' instead of 'sebagian'
- [ ] Update PaymentObserver to set status to 'belum_lunas' for partial payments
- [ ] Update database migration to change enum values from 'sebagian' to 'belum_lunas'
- [ ] Test the changes by running migrations and verifying status updates
