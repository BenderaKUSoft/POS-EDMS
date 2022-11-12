$.ajaxSetup({ headers: { 'Csrf-Token': $('meta[name="csrf-token"]').attr('content') } });

const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2000 });

$(function () {
    if (window.navigator.onLine) {
        $("#offline-notification").addClass('online');
    } else {
        $("#offline-notification").removeClass('online');
    }
    $(window).on('online', function () {
        $("#offline-notification").addClass('online');
    });
    $(window).on('offline', function () {
        $("#offline-notification").removeClass('online');
    });
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
});