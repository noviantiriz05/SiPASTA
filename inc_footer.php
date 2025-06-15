</div>

<style>
    .footer {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background-color: #f1f1f1;
    padding: 20px;
    gap: 20px;
}

.footer-section {
    flex: 1 1 200px;
    min-width: 200px;
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 0;
}

@media screen and (max-width: 768px) {
    .footer {
        flex-direction: column;
        align-items: flex-start;
    }

    .footer-section {
        width: 100%;
    }
}
</style>

<script>
    $(document).ready(function () {
        // Tambahkan fungsi upload gambar
        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);

            $.ajax({
                method: 'POST',
                url: 'upload_gambar.php',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#summernote').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        // Tambahkan fungsi upload file
        function handleFileUpload(context) {
            const input = $('<input type="file" accept=".pdf,.doc,.docx,.xls,.xlsx" style="display:none;">');
            input.on('change', function () {
                const file = this.files[0];
                if (file) {
                    const formData = new FormData();
                    formData.append("file", file);

                    $.ajax({
                        url: "upload_file.php", // buat file PHP ini sendiri nanti
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (url) {
                            // Sisipkan sebagai link ke dalam editor
                            context.invoke('editor.pasteHTML', `<a href="${url}" target="_blank">${file.name}</a>`);
                        },
                        error: function () {
                            alert("Gagal upload file");
                        }
                    });
                }
            });
            input.trigger('click');
        }

        // Inisialisasi Summernote
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function (files) {
                    for (let i = 0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                }
            },
            height: 300,
            toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["fontsize", ["fontsize"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["height", ["height"]],
                ["insert", ["link", "picture", "imageList", "video", "hr", "uploadFile"]],
                ["help", ["help"]]
            ],
            dialogsInBody: true,
            imageList: {
                endpoint: "daftar_gambar.php",
                fullUrlPrefix: "../gambar/",
                thumbUrlPrefix: "../gambar/"
            },
            buttons: {
                uploadFile: function (context) {
                    var ui = $.summernote.ui;
                    return ui.button({
                        contents: '<i class="bi bi-upload"></i>',
                        tooltip: 'Upload File',
                        click: function () {
                            handleFileUpload(context);
                        }
                    }).render();
                }
            }
        });
    });
</script>

<div id="contact">
    <div class="wrapper">
        <div class="footer">
            <div class="footer-section">
                <h3>Kelompok 9</h3>
                <p>Kami adalah Kelompok 9 dari Matakuliah Kearsipan Digital Universitas Negeri Jakarta</p>
            </div>
            <div class="footer-section">
                <h3>About</h3>
                <p>SiPASTA Merupakan Aplikasi Arsip Digital yang Efisien, Aman, dan Terintegrasi</p>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Universitas Negeri Jakarta,
                    PAP 2023 Kelas A,
                    Kelompok 9</p>
            </div>
            <div class="footer-section">
                <h3>Social</h3>
                <p><b>YouTube: </b>-</p>
            </div>
        </div>
    </div>
</div>

<div id="copyright">
    <div class="wrapper">
        &copy; 2025. <b>SiPASTA.</b> All Rights Reserved.
    </div>
</div>

</body>

</html>