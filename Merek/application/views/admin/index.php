<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg 6">

            <?= $this->session->flashdata('message'); ?>

            <div class="float-left">
                <button class="tablinks btn btn-info mb-3" onclick="openTable(event, 'Semua')">Semua</button>
                <button class="tablinks btn btn-info mb-3" onclick="openTable(event, 'Belum')">Belum diproses</button>
                <button class="tablinks btn btn-info mb-3" onclick="openTable(event, 'Sedang')">Sedang diproses</button>
                <button class="tablinks btn btn-info mb-3" onclick="openTable(event, 'Selesai')">Selesai diproses</button>
            </div>
            <!-- <a href="<?= base_url('merek/tambah'); ?>" class="btn btn-success mb-3"><i class="fas fa-fw fa-edit"></i>Tambah permohonan baru</a> -->

            <div id="Semua" class="tabcontent">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($permohonansemua as $p) :
                        ?>
                            <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <td><?php echo date('d F Y', $p['date_created']); ?></td>
                                <td><?= $p['merek']; ?></td>
                                <td><?php if ($p['status'] == 0) { ?>
                                        Belum diproses
                                    <?php } else if ($p['status'] == 1) { ?>
                                        Sedang diproses
                                    <?php } else { ?>
                                        Selesai diproses
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($p['keterangan'] == null) : ?>
                                        <p class="font-weight-bold">--</p>
                                    <?php else : ?>
                                        <?= $p['keterangan']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/lihatPermohonan/') . $p['id']; ?>" class="badge badge-warning">Lihat</a>
                                    <a href="<?= base_url('admin/editPermohonan/') . $p['id']; ?>" class="badge badge-success">Edit</a>
                                    <a href="<?= base_url('admin/hapusPermohonan/') . $p['id']; ?>" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="Belum" class="tabcontent">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($permohonanbelum as $p) :
                        ?>
                            <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <td><?php echo date('d F Y', $p['date_created']); ?></td>
                                <td><?= $p['merek']; ?></td>
                                <td><?php if ($p['status'] == 0) { ?>
                                        Belum diproses
                                    <?php } else if ($p['status'] == 1) { ?>
                                        Sedang diproses
                                    <?php } else { ?>
                                        Selesai diproses
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($p['keterangan'] == null) : ?>
                                        <p class="font-weight-bold">--</p>
                                    <?php else : ?>
                                        <?= $p['keterangan']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/lihatPermohonan/') . $p['id']; ?>" class="badge badge-warning">Lihat</a>
                                    <a href="<?= base_url('admin/editPermohonan/') . $p['id']; ?>" class="badge badge-success">Edit</a>
                                    <a href="<?= base_url('admin/hapusPermohonan/') . $p['id']; ?>" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="Sedang" class="tabcontent">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($permohonansedang as $p) :
                        ?>
                            <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <td><?php echo date('d F Y', $p['date_created']); ?></td>
                                <td><?= $p['merek']; ?></td>
                                <td><?php if ($p['status'] == 0) { ?>
                                        Belum diproses
                                    <?php } else if ($p['status'] == 1) { ?>
                                        Sedang diproses
                                    <?php } else { ?>
                                        Selesai diproses
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($p['keterangan'] == null) : ?>
                                        <p class="font-weight-bold">--</p>
                                    <?php else : ?>
                                        <?= $p['keterangan']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/lihatPermohonan/') . $p['id']; ?>" class="badge badge-warning">Lihat</a>
                                    <a href="<?= base_url('admin/editPermohonan/') . $p['id']; ?>" class="badge badge-success">Edit</a>
                                    <a href="<?= base_url('admin/hapusPermohonan/') . $p['id']; ?>" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="Selesai" class="tabcontent">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($permohonanselesai as $p) :
                        ?>
                            <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <td><?php echo date('d F Y', $p['date_created']); ?></td>
                                <td><?= $p['merek']; ?></td>
                                <td><?php if ($p['status'] == 0) { ?>
                                        Belum diproses
                                    <?php } else if ($p['status'] == 1) { ?>
                                        Sedang diproses
                                    <?php } else { ?>
                                        Selesai diproses
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($p['keterangan'] == null) : ?>
                                        <p class="font-weight-bold">--</p>
                                    <?php else : ?>
                                        <?= $p['keterangan']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/lihatPermohonan/') . $p['id']; ?>" class="badge badge-warning">Lihat</a>
                                    <a href="<?= base_url('admin/editPermohonan/') . $p['id']; ?>" class="badge badge-success">Edit</a>
                                    <a href="<?= base_url('admin/hapusPermohonan/') . $p['id']; ?>" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->