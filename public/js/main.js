"use strict";

$(function () {
    $(document).on('click', '.modal-show', function () {
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('.modal-content')
                .load($(this).attr('value'));
        } else {
            $('#modal').modal('show')
                .find('.modal-content')
                .load($(this).attr('value'));
        }
    });
    $(".modal").on("hidden.bs.modal", function () {
        $('.modal-content').html('');
    });
});

function deletealert() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
    swal({
         title: "Are you sure ?",
         text: "Apakah anda yakin akan menghapus data ini ?",
         icon: "warning",
         buttons: true,
         dangerMode: true,
       })
      .then((willDelete) => {
           if (willDelete) {
                 form.submit();
           }
    });
}

// function cheangeRole(obj) {
//     event.preventDefault();
//     var id = $(obj).attr('id');
//     swal({
//          title: "Are you sure ?",
//          text: "Apakah anda yakin akan mengubah role anda ?",
//          icon: "warning",
//          buttons: true,
//          dangerMode: true,
//        })
//       .then((willDelete) => {
//            if (willDelete) {
//             $.ajax({
//                 type:'POST',
//                 data:{"_token": $('meta[name="csrf-token"]').attr('content'),"id": id},
//                 url: url + '/home/'+id+'/role',
//                 dataType: "json",
//                 success:function(data) {
//                     if(data.status==true){
//                         window.location.href = url;
//                     //   location.reload();
//                     }
//                 }
//             });
//            }
//     });
// }

// function cheangeYear(obj) {
//     event.preventDefault();
//     var id = $(obj).attr('id');
//     swal({
//         title: "Are you sure ?",
//         text: "Apakah anda yakin akan mengubah data tahun ini ?",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     })
//         .then((willDelete) => {
//             if (willDelete) {
//                 $.ajax({
//                     type: 'POST',
//                     data: { "_token": $('meta[name="csrf-token"]').attr('content'), "id": id },
//                     url: url + '/home/' + id + '/year',
//                     dataType: "json",
//                     success: function (data) {
//                         if (data.status == true) {
//                             window.location.href = url;
//                             // location.reload();
//                         }
//                     }
//                 });
//             }
//         });
// }

function number_format(number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
            .toFixed(prec)
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}

// function set_datetimeclock(id) {
//     var sekarang = new Date();
//     var tanggal = sekarang.getDate();
//     var hari = sekarang.getDay();
//     if (hari === 0) {
//         hari = 'Minggu';
//     } if (hari === 1) {
//         hari = 'Senin';
//     } if (hari === 2) {
//         hari = 'Selasa';
//     } if (hari === 3) {
//         hari = 'Rabu';
//     } if (hari === 4) {
//         hari = 'Kamis';
//     } if (hari === 5) {
//         hari = 'Jumat';
//     } if (hari === 6) {
//         hari = 'Sabtu';
//     }
//     var bulan = sekarang.getMonth();
//     if (bulan === 0) {
//         bulan = 'Januari';
//     } if (bulan === 1) {
//         bulan = 'Februari';
//     } if (bulan === 2) {
//         bulan = 'Maret';
//     } if (bulan === 3) {
//         bulan = 'April';
//     } if (bulan === 4) {
//         bulan = 'Mei';
//     } if (bulan === 5) {
//         bulan = 'Juni';
//     } if (bulan === 6) {
//         bulan = 'Juli';
//     } if (bulan === 7) {
//         bulan = 'Agustus';
//     } if (bulan === 8) {
//         bulan = 'September';
//     } if (bulan === 9) {
//         bulan = 'Oktober';
//     } if (bulan === 10) {
//         bulan = 'November';
//     } if (bulan === 11) {
//         bulan = 'Desember';
//     }
//     var tahun = sekarang.getFullYear();
//     var detik = sekarang.getSeconds();
//     if (detik < 10) {
//         detik = '0' + detik;
//     }
//     var menit = sekarang.getMinutes();
//     if (menit < 10) {
//         menit = '0' + menit;
//     }
//     var jam = sekarang.getHours();
//     if (jam < 10) {
//         jam = '0' + jam;
//     }
//     var showdate = '' + hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun + ' - ' + jam + ':' + menit + ':' + detik + '';

//     document.getElementById(id).innerHTML = showdate;
//     setTimeout('set_datetimeclock(\'' + id + '\')', 1000);
// }

$(document).ready(function () {
    // set_datetimeclock('liveclock');
});
