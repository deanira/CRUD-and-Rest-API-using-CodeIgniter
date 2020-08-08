<div class="container-fluid">
    <div class="card w-75 mr-3 mb-3">
        <h4 class="card-header font-weight-bold">Pratinjau Dokumen</h4>
        <div class="card-body">
            <h5 class="card-title font-weight-bold"><?= $permohonan['merek']; ?></h5>
            <p class="card-text">
                <table>
                    <tr>
                        <td>Nama Pemohon</td>
                        <td>:</td>
                        <td><?= $permohonan['nama_pemohon']; ?></td>
                    </tr>
                    <tr>
                        <td>Nomor KTP Pemohon</td>
                        <td>:</td>
                        <td><?= $permohonan['no_ktp']; ?></td>
                    </tr>
                    <tr>
                        <td>Kabupaten / Kota</td>
                        <td>:</td>
                        <td><?= $permohonan['kab_kota']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $permohonan['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Kode Pos</td>
                        <td>:</td>
                        <td><?= $permohonan['kode_pos']; ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone Pemohon</td>
                        <td>:</td>
                        <td><?= $permohonan['no_hp']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $permohonan['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Whatsapp</td>
                        <td>:</td>
                        <td><?= $permohonan['whatsapp']; ?></td>
                    </tr>
                    <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td><?= $permohonan['merek']; ?></td>
                    </tr>
                    <tr>
                        <td>Label Merek</td>
                        <td>:</td>
                        <td><img src="<?= base_url('assets/img/merek/') . $permohonan['label_merek']; ?>" height="200" /></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><?= $permohonan['deskripsi']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Permohonan</td>
                        <td>:</td>
                        <td><?= date('d F Y', $permohonan['date_created']); ?></td>
                    </tr>
                </table>
            </p>
            <a href="#" onclick="history.go(-1)" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>