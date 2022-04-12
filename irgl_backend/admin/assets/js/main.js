$(function()
{
    $('#tablePeserta').DataTable({
        pageLength: 25
    });

    $(document).on('click', 'button[data-toggle=verifikasi_peserta]', function()
    {
        const id             = $(this).attr('data-id');
        const statusDiv      = $('#status-id-'+id);
        const verificationDiv = $('#verification-id-'+id);

        $.ajax({
            type: "POST",
            data: 'verifikasi=true&id='+id,
            success: (data) =>
            {
                if (data.status == 1)
                {
                    statusDiv.html(`
                        <span class="badge badge-success">
                            <i class="fa fa-check-square-o"></i>
                        </span>
                    `);
                    
                    verificationDiv.html(`
                        - ${data.verificator}<br/>
                        - ${data.time}
                    `);
                }
                else
                    alert('Data tidak ditemukan atau sudah terverifikasi');
            },
            error:() =>
            {
                alert('Terjadi kesalahan saat memverifikasi peserta.');
            }
        });
    });
});
