
// Show loading
function showLoading() {
    $(".loading-page").fadeIn();
}
// $(".btn-load").on('click', function(){
//     console.log('a')
//     showLoading();
// });


function Export(v) {
    console.log(v)
    $('#type').val(v);
}


$( ".save" ).click(function() {
  alert( "Handler for .click() called." );
});

// $(".save").on('click',function() {
//     console.log('a');
//     // $(this).before('<input type="hidden" name="save" value="1">');

//     // (FormObj = this.form), (SwalOptions.text = "Submit?");
//     // Swal.fire(SwalOptions).then(result => {
//     //     if (result.value) {
//     //         showLoading();
//     //         FormObj.submit();
//     //     }
//     // });
//     // return false;
// });

// $(".save-close").click(function() {
//     (FormObj = this.form), (SwalOptions.text = "Submit?");
//     Swal.fire(SwalOptions).then(result => {
//         if (result.value) {
//             showLoading();
//             FormObj.submit();
//         }
//     });
//     return false;
// });
$('a[rel="delete"]').click(function() {

href = $(this).prop("href");
console.log(href)
  Swal.fire({
    title: 'Apakah anda yakin?',
    text: "Untuk menghapus data!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Batal',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      href = $(this).prop("href");
      let formDelete = $("<form/>", {
      action: href,
      method: "post",
      id: "form-delete"
    })
      .append(
          $("<input>", {
              type: "hidden",
              name: "_method",
              value: "DELETE"
          })
      )
      .append(
          $("<input>", {
              type: "hidden",
              name: "_token",
              value: $('meta[name="csrf-token"]').attr("content")
          })
      );
      $("body").append(formDelete);
      $("#form-delete").submit();

      showLoading();
  
    }
  })
  return false;
});


$(function() {
$('.date').daterangepicker({
  autoApply:true,
  autoUpdateInput: true,
  singleDatePicker: true,
  showDropdowns: true,
  // minYear: 1901,
  // maxYear: parseInt(moment().format('YYYY'),10),
  locale: {
    format: 'Y-MM-DD',
    cancelLabel: 'Clear'
  }
});

$('.monthYear').daterangepicker({
  autoApply:true,
  singleDatePicker: true,
  showDropdowns: true,
  // minYear: 1901,
  // maxYear: parseInt(moment().format('YYYY'),10),
  locale: {
    format: 'Y-MM',
    cancelLabel: 'Clear'
  }
});

});