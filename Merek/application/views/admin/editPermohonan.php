<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('admin/editPermohonan/') . $permohonan['id']; ?>" method="post">
                <div class="form-row">
                    <div class="col">
                        <label for="merek">Status</label>
                        <input type="number" class="form-control" id="status" name="status" min="0" max="2" value="<?= $permohonan['status']; ?>">
                        <!-- <input type="text" class="form-control" id="merek" name="merek" value="<?= $permohonan['status']; ?>"> -->
                        <small id="emailHelp" class="form-text text-muted">0 = Belum diproses, 1 = Sedang diproses, 2 = Selesai diproses</small>
                    </div>
                    <div class="col">
                        <label for="merek">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"><?= $permohonan['keterangan']; ?></textarea><br />
                    </div>
                    <div class="col-lg-2">
                        <br />
                        <div class="float-right"><button type="submit" class="btn btn-primary">Simpan</button></div>
                    </div>
                </div>
                <div class="form-group">
                    <br />
                    <label for="no_ktp">Nomor KTP *</label>
                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="<?= $permohonan['no_ktp']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pemohon *</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $permohonan['nama_pemohon']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Kabupaten/Kota *</label>
                    <input type="text" class="form-control" id="kab_kota" name="kab_kota" value="<?= $permohonan['kab_kota']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat *</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $permohonan['alamat']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="kode_pos">Kode Pos *</label>
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?= $permohonan['kode_pos']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="no_ktp">Nomor HP *</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $permohonan['no_hp']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $permohonan['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="whatsapp">Whatsapp *</label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= $permohonan['whatsapp']; ?>" readonly>
                </div>
                <div class="form-group ">
                    <label for="no_ktp">Label Merek *</label><br>
                    <img src="<?= base_url('assets/img/merek/') . $permohonan['label_merek']; ?>" width="500" />
                </div>
                <div class="form-group">
                    <label for="merek">Merek *</label>
                    <input type="text" class="form-control" id="merek" name="merek" value="<?= $permohonan['merek']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="validationTextarea">Deskripsi label merek</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" value="<?= $permohonan['deskripsi']; ?>" readonly></textarea>
                </div>
                <div class="form-group">
                    <a href="#" onclick="history.go(-1)" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->