$('#sliderButton').click(function (event) {
    if ($('#sliderExample').hasClass('active')) {
        $('#sliderExample').removeClass('active');
        $('#sliderBackground').removeClass('active');
    } else {
        $('#sliderExample').addClass('active');
        $('#sliderBackground').addClass('active');
    }
});
$('#sliderBackground').click(function () {
    $('#sliderExample').removeClass('active');
    $('#sliderBackground').removeClass('active');
})

document.addEventListener("DOMContentLoaded", function () {
    const logoutButton = document.getElementById("LogOut");
    const logoutForm = document.getElementById("logoutForm");

    if (logoutButton && logoutForm) {
        logoutButton.addEventListener("click", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Apakah Anda yakin ingin keluar?",
                text: "Anda akan keluar dari sistem.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, keluar!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    logoutForm.submit();
                }
            });
        });
    }
});



