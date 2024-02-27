var toastMixin = Swal.mixin({
  toast: true,
  icon: 'success',
  title: 'General Title',
  animation: false,
  position: 'top-right',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});


Swal.fire({
  toast: true,
  icon: 'success',
  title: 'Posted successfully',
  animation: false,
  position: 'bottom',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})



toastMixin.fire({
  animation: true,
  title: 'Signed in Successfully'
});


document.querySelector(".third").addEventListener('click', function () {
  toastMixin.fire({
    title: 'Wrong Password',
    icon: 'error'
  });
});