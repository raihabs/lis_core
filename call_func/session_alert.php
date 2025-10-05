<style>
    .colored-toast.swal2-icon-success {
        background-color: #a5dc86 !important;
    }

    .colored-toast.swal2-icon-error {
        background-color: #f27474 !important;
    }

    .colored-toast.swal2-icon-warning {
        background-color: #f8bb86 !important;
    }

    .colored-toast.swal2-icon-info {
        background-color: #3fc3ee !important;
    }

    .colored-toast.swal2-icon-question {
        background-color: #87adbd !important;
    }

    .colored-toast .swal2-title {
        color: white;
    }

    .colored-toast .swal2-close {
        color: white;
    }

    .colored-toast .swal2-html-container {
        color: white;
    }
</style>


<script>
    function msg_alert(title, icon) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            customClass: {
                popup: 'colored-toast'
            }
        });
        Toast.fire({
            icon: icon,
            title: title
        });
    }

    function msg_hmtl(title, icon) {
        Swal.fire({
            icon: icon,
            html: '<span style="font-size:15pt; font-weight:600;">' + title + '</span>',
            timer: 15000
        });
    }

    function msg_redirect(title, icon, url) {
        Swal.fire({
            icon: icon,
            html: '<span style="font-size:15pt; font-weight:600;">' + title + '</span>',
            timer: 5000,
            showConfirmButton: false,
            timerProgressBar: true,
        }).then(function() {
            window.location = url;
        });
    }
</script>