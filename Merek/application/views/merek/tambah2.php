<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            Merek yang didaftarkan harus sesuai dengan syarat dan ketentuan
            <a href="" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#SKModal">Lihat syarat dan ketentuan</a>
            <?php echo form_open_multipart('merek/tambah2'); ?>
            <div class="form-group ">
                <label for="no_ktp">Label Merek *</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                    <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="merek">Merek *</label>
                <input type="text" class="form-control" id="merek" name="merek">
                <?= form_error('merek', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="validationTextarea">Deskripsi label merek</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
            </div>
            <div class="form-group">
                <a href="#" onclick="history.go(-1)" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan dan Lanjutkan</button>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="SKModal" tabindex="-1" role="dialog" aria-labelledby="SKModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SKModalLabel">Syarat dan Ketentuan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p align="justify">
                    1. Merek ini tidak bertentangan dengan ideologi negara, peraturan perundang - undangan, moralitas, agama,
                    kesusilaan, ketertiban umum. <br />
                    2. Merek ini tidak merupakan nama umum dan/atau lambang milik umum. <br />
                    3. Merek ini tidak menyerupai nama
                    atau singkatan nama orang terkenal, foto, atau nama badan hukum yang dimiliki orang lain dan diajukan tanpa persetujuan tertulis dari yang berhak.<br />
                    4. Merek ini tidak menyerupai nama atau singkatan nama, bendera, lambang atau simbol atau emblem suatu negara, atau lembaga nasional maupun internasional
                    dan diajukan tanpa persetujuan tertulis dari pihak berwenang. <br />
                    5. Merek ini tidak menyerupai tanda atau cap atau stempel resmi yang digunakan
                    oleh negara atau lembaga pemerintah dan diajukan tanpa persetujuan tertulis dari pihak berwenang. <br />
                    6. Merek ini tidak memuat unsur yang
                    dapat menyesatkan masyarakat tentang asal, kualitas, jenis, ukuran, macam, tujuan penggunaan barang dan/atau jasa yang dimohonkan pendaftarannya.<br />
                    7. Merek ini tidak merupakan nama varietas tanaman yang dilindungi untuk barang dan/atau jasa yang sejenis.
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Saya menyetujui Syarat dan Ketentuan yang berlaku</button>
                <!-- <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Logout</a> -->
            </div>
        </div>
    </div>
</div>