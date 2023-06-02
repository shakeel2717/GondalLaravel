<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    swal("oops!", "{!! $error !!}", "error");
</script>
@endforeach
@endif
@if (session('success') || session('status'))
<script>
    swal("Success!", "{!! session('success') !!}", "success");
</script>
@endif
@if (session('error'))
<script>
    swal("oops!", "{!! session('error') !!}", "error");
</script>
@endif
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cancel', function(bookingId) {
            swal({
                    title: "Confirm Cancel",
                    text: "Are you sure you want to cancel this ticket?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                })
                .then((confirm) => {
                    if (confirm) {
                        Livewire.emit('cancelTicket', bookingId);
                    } else {
                        swal("Ticket Not Cancelled!", "The Ticket is not Cancelled", "info");
                    }
                });
        });
    });
</script>