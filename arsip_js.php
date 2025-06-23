<script>
    getArsip();
  

    function getArsip() {
        $(function() {
            const idTahun = <?= json_encode($id_tahun) ?>;
            $("#data").empty();

            $.ajax({
                type: "get",
                url: "<?= url_to("arsip.ajax.get") ?>",
                data: { id_tahun: idTahun },
                dataType: "json",
                success: (function(response) {
                    $i = 1;
                    $.each(response, function(index, value) {
                        let item = value.file_upload; // Asumsi value.item menyimpan path lengkap file
                        let fileExtension = item.split('.').pop().toLowerCase(); // Ambil ekstensi file

                        let fileLink = $("<a href='#'>").text(item).on('click', function(e) {
                            e.preventDefault(); // cegah link agar tidak melakukan aksi default
                            showFilePopup(item, fileExtension); // panggil fungsi showFilePopup dan kirim item & ekstensi file
                        });


                        $tr = $("<tr>").append(
                            $("<td class='text-center align-middle'>").text($i),
                            $("<td class='align-middle'>").text(value.judul_arsip),
                            $("<td class='align-middle'>").text(value.tanggal),
                            $("<td class='align-middle'>").text(value.tahun),
                            $("<td class='align-middle'>").text(value.jenis_arsip),
                            $("<td class='align-middle'>").append(fileLink) <?php if (in_array(session()->get('role'), [1, 3])): ?>,
                                $("<td class='d-flex flex-column' style='gap: 10px'>")
                                .append(
                                    $("<button class='btn btn-warning text-light' title='Edit'>")
                                    .html("<i class='fas fa-pen'></i>")
                                    .on('click', function() {
                                        goToEdit(value.id);
                                    }),
                                    $("<button class='btn btn-danger' title='Hapus'>")
                                    .html("<i class='fas fa-trash'></i>")
                                    .on('click', function() {
                                        goToDelete(value.id);
                                    })
                                ) <?php endif; ?>
                        );


                        $i++;
                        $("#data").append($tr);
                    });


                    $(document).ready(function() {
                        const documentTitle = 'Daftar Fond Aplikasi Pengarsipan SD Negeri Adipala 07'
                        $("#arsip").DataTable({
                            retrieve: true,
                            destroy: true,
                            "responsive": true,
                            "lengthChange": true,
                            "autoWidth": false,
                            "buttons": [
                                "copy",
                                {
                                    extend: 'csv',
                                    title: this.documentTitle,
                                    exportOptions: {
                                        columns: [0, 2, 3]
                                    }
                                },
                                {
                                    extend: 'excel',
                                    title: this.documentTitle,
                                    exportOptions: {
                                        columns: [0, 2, 3]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    orientation: 'portrait',
                                    pageSize: 'A4',
                                    download: 'open',
                                    exportOptions: {
                                        columns: [0, 2, 3],
                                    },
                                    title: null,
                                    customize: function(doc, buttonConfig, dataTable) {
                                        // console.log(doc);
                                        pdfMake.tableLayouts = {
                                            customLayout: {
                                                hLineWidth: function(i, node) {
                                                    return 1;
                                                },
                                                vLineWidth: function(i) {
                                                    return 1;
                                                },
                                                hLineColor: function(i) {
                                                    // return i === 1 ? 'black' : '#aaa';
                                                    return '#aaa';
                                                },
                                                vLineColor: function(i) {
                                                    return '#aaa';
                                                },
                                                fi
                                            }
                                        };
                                        doc['styles'].tableHeader.fillColor = '#f3f3f3';
                                        doc['styles'].tableHeader.color = 'black';
                                        doc['styles'].tableHeader.marginTop = 11;
                                        doc['styles'].tableBodyOdd.fillColor = 'white';
                                        doc['content'][0].layout = 'customLayout';
                                        doc['styles'] = Object.assign({
                                            tableHeaderJenisKelamin: {
                                                bold: true,
                                                color: 'black',
                                                fontSize: 11,
                                                marginTop: 5,
                                                marginBottom: 5,
                                                alignment: 'center',
                                                fillColor: '#f3f3f3',
                                            }
                                        }, doc['styles']);
                                        doc['content'][0].table.body[0][4].style = 'tableHeaderJenisKelamin';

                                        doc['header'] = function(currentPage, pageCount, pageSize) {
                                            return [{
                                                    columns: [{
                                                            image: 'building',
                                                            fit: [70, 91],
                                                            alignment: 'left',
                                                            width: '15%',
                                                            margin: [20, 10, 0, 0]
                                                        },
                                                        {
                                                            stack: [{
                                                                    text: 'PEMERINTAH KABUPATEN CILACAP',
                                                                    fontSize: 15,
                                                                    margin: 2
                                                                },
                                                                {
                                                                    text: 'DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA',
                                                                    fontSize: 15,
                                                                    margin: 2
                                                                },
                                                                {
                                                                    text: 'SD NEGERI ADIPALA 07',
                                                                    fontSize: 15,
                                                                    margin: 2
                                                                },
                                                                {
                                                                    text: 'Jl. Jambu Adipala ',
                                                                    fontSize: 12,
                                                                    margin: 2
                                                                }
                                                            ],
                                                            alignment: 'center',
                                                            width: '70%',
                                                            margin: [0, 15, 0, 10]
                                                        },
                                                        {
                                                            text: '',
                                                            width: '15%',
                                                        }
                                                    ]
                                                },
                                                {
                                                    canvas: [{
                                                        type: 'line',
                                                        x1: 10,
                                                        y1: 4,
                                                        x2: pageSize.width - 10,
                                                        y2: 4,
                                                        lineWidth: 1
                                                    }]
                                                }
                                            ];
                                        };
                                        doc['content'].push({
                                            text: '',
                                            margin: [0, 0, 0, 20]
                                        })
                                        doc['content'].push(
                                            [{
                                                stack: [{
                                                        text: 'Mengetahui,',
                                                        fontSize: 10,
                                                        alignment: 'right',
                                                        margin: [40, 0, 0, 0]
                                                    },
                                                    {
                                                        text: 'Kepala Sekolah SD NEGERI ADIPALA 07',
                                                        fontSize: 10,
                                                        alignment: 'right',
                                                        margin: [40, 3, 0, 50]
                                                    },
                                                    {
                                                        text: '(________________________)',
                                                        fontSize: 10,
                                                        alignment: 'right',
                                                        margin: [40, 3, 0, 3]
                                                    },
                                                    {
                                                        text: 'NIP.______________________',
                                                        fontSize: 10,
                                                        alignment: 'right',
                                                        margin: [40, 3, 0, 3]
                                                    },
                                                ],
                                                unbreakable: true
                                            }]
                                        );
                                        doc['images'] = {
                                            building: '<?= base_url('images/Lambang_kabupaten_cilacap.jpg') ?>'
                                        };
                                        doc['pageMargins'] = [40, 120, 40, 40];
                                    },
                                },
                                "colvis",
                            ]
                        }).buttons().container().appendTo('#Arsip_wrapper .col-md-6:eq(0)');
                    });
                })
            })


        })
    }

    function getSubFoonds() {
        var id = $('#id_fonds').val();
        $.ajax({
            url: '<?= url_to("arsip.ajax.getSubFond") ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // alert(response);
                $('#id_subfonds').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                displayErrorMessage();
            }
        })
    }

    function getSubSeriis() {
        var id = $('#id_seris').val();
        $.ajax({
            url: '<?= url_to("arsip.ajax.getSubSeri") ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // alert(response);
                $('#id_subseris').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                displayErrorMessage();
            }
        })
    }
    $(document).ready(function() {
        // CSRF Hash
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash
        $('#id_fonds').change(function() {
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url: '<?= url_to("arsip.ajax.getSubFond") ?>',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // alert(response);
                    $('#id_subfonds').html(response);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    displayErrorMessage();
                }
            })
        })
        $('#id_seris').change(function() {
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url: '<?= url_to("arsip.ajax.getSubSeri") ?>',
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // alert(response);
                    $('#id_subseris').html(response);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    displayErrorMessage();
                }
            })
        })
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.delete_check').prop('checked', true);
            } else {
                $('.delete_check').prop('checked', false);
            }
        });

        // Delete record
        $('#delete_button').click(function() {
            let modal = Swal.mixin({
                position: 'center',
                showConfirmButton: true,
            });

            var deleteids_arr = [];
            // Read all checked checkboxes
            $("input:checkbox[class=delete_check]:checked").each(function() {
                deleteids_arr.push($(this).val());
            });

            // Check checkbox checked or not
            if (deleteids_arr.length > 0) {

                modal.fire({
                    title: 'Hapus data fond',
                    text: 'Apakah Anda yakin akan menghapus ' + deleteids_arr.length + ' data fond?',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= url_to("arsip.ajax.multidelete"); ?>',
                            type: 'post',
                            data: {
                                deleteids_arr: deleteids_arr,
                                [csrfName]: csrfHash
                            },
                            dataType: "JSON",
                            success: function(response) {
                                // Update CSRF hash
                                $('.txt_csrfname').val(response.token);
                                modal.fire('Terhapus!', '', 'success')
                                    .then((result) => {
                                        if (result.isConfirmed) {
                                            location.href = '<?= url_to("arsip.index") ?>';
                                        }
                                    });
                                displaySuccessMessage();
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(xhr.status);
                                console.log(thrownError);
                                modal.fire('Gagal terhapus', '', 'error')
                                    .then((result) => {
                                        if (result.isConfirmed) {
                                            location.href = '<?= url_to("arsip.index") ?>';
                                        }
                                    });
                                displayErrorMessage();
                            }
                        });
                    }
                })
            }
        });
    });

    function goToEdit(id) {
        window.location.href = "<?= base_url('/arsip/edit/') ?>" + id;
    }

    function goToDelete(id) {
        window.location.href = "<?= base_url('/arsip/delete/') ?>" + id;
    }

    // Checkbox checked
    function check() {

        // Total checkboxes
        var length = $('.delete_check').length;

        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function() {
            if ($(this).is(':checked')) {
                totalchecked += 1;
            }
        });

        // Checked unchecked checkbox
        if (totalchecked == length) {
            $("#checkall").prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    }

    function displaySuccessMessage() {
        $("#message").append(
            $("<div class='login100-form m-t-16 alert alert-success'>").html("<strong>Note! </strong>Arsip berhasil dihapus").delay(3000).slideUp(300, function() {
                $(this).alert('close');
            })
        )
    }

    function displayErrorMessage() {
        $("#message").append(
            $("<div class='login100-form m-t-16 alert alert-danger'><strong>").html("<strong>Note! </strong>Arsip gagal dihapus").delay(3000).slideUp(300, function() {
                $(this).alert('close');
            })
        )
    }

    $(".alert-success").delay(10000).slideUp(300, function() {
        $(this).alert('close');
    });
    $(".alert-danger").delay(10000).slideUp(300, function() {
        $(this).alert('close');
    });

    function showFilePopup(item, extension) {
        let content = '';
        let basePath = '';

        if (['mp4', 'webm'].includes(extension)) {
            basePath = '/video/';
            content = `<video controls width="100%">
                      <source src="${basePath + item}" type="video/${extension}">
                      Browser Anda tidak mendukung tag video.
                   </video>`;
        } else if (['mp3', 'wav'].includes(extension)) {
            basePath = '/audio/';
            content = `<audio controls>
                      <source src="${basePath + item}" type="audio/${extension}">
                      Browser Anda tidak mendukung tag audio.
                   </audio>`;
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
            basePath = '/gambar/';
            content = `<img src="${basePath + item}" alt="Gambar" style="width:100%;">`;
        } else if (['pdf'].includes(extension)) {
            basePath = '/dokumen/';
            content = `<embed type="application/pdf" src="${basePath + item}" style="width:100%; height:500px;" frameborder="0"></embed>`;
        } else {
            basePath = '/dokumen/';
            content = `<p>File tidak dapat dipreview. <a href="${basePath + item}" download>Download file</a></p>`;
        }

        $('#filePreview').html(content);
        $('#fileModal').modal('show');
    }
</script>