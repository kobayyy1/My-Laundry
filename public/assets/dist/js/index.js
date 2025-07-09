            
            
            

document.addEventListener('success', (event) => {
    Swal.fire({
        icon: 'success',
        title: 'Mantap',
        text: event.detail,
        showConfirmButton: false,
        timer: 5000
    })
});
document.addEventListener('error', (event) => {
    Swal.fire({
        icon: 'error',
        title: 'Opps...!',
        text: event.detail,
        showConfirmButton: false,
        timer: 5000
    })
});