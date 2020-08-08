<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('merek/tambah'); ?>" method="post">
                <div class="form-group">
                    <label for="no_ktp">Nomor KTP *</label>
                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="<?= $user['no_ktp']; ?>">
                    <?= form_error('no_ktp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pemohon *</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama">Kabupaten/Kota *</label>
                    <select name="kab_kota" id="kab_kota" class="custom-select">
                        <option value="" selected>---Pilih Kabupaten/Kota---</option>
                        <option value="Kabupaten Bengkalis">Kabupaten Bengkalis</option>
                        <option value="Kabupaten Indragiri Hilir">Kabupaten Indragiri Hilir</option>
                        <option value="Kabupaten Indragiri Hulu">Kabupaten Indragiri Hulu</option>
                        <option value="Kabupaten Kampar">Kabupaten Kampar</option>
                        <option value="Kabupaten Kepulauan Meranti">Kabupaten Kepulauan Meranti</option>
                        <option value="Kabupaten Kuantan Singingi">Kabupaten Kuantan Singingi</option>
                        <option value="Kabupaten Pelalawan">Kabupaten Pelalawan</option>
                        <option value="Kabupaten Rokan Hilir">Kabupaten Rokan Hilir</option>
                        <option value="Kabupaten Rokan Hulu">Kabupaten Rokan Hulu</option>
                        <option value="Kabupaten Siak">Kabupaten Siak</option>
                        <option value="Kabupaten Siak">Kabupaten Siak</option>
                        <option value="Kota Dumai">Kota Dumai</option>
                        <option value="Kota Pekanbaru">Kota Pekanbaru</option>
                    </select>
                    <?= form_error('kab_kota', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat *</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>">
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="kode_pos">Kode Pos *</label>
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                    <?= form_error('kode_pos', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="no_ktp">Nomor HP *</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $user['no_hp']; ?>">
                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="whatsapp">Whatsapp *</label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp">
                    <?= form_error('whatsapp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan dan Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->