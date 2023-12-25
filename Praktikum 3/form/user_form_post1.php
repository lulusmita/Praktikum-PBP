<?php include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header">Form Mahasiswa</div>
    <div class="card-body">
        <?php
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (isset($_POST['submit'])) {
            $nama = test_input($_POST['nama']);
            if (empty($nama)) {
                $error_nama = "Nama harus diisi";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
                $error_nama = "Nama hanya dapat berupa huruf dan spasi";
            }

            $email = test_input($_POST['email']);
            if (empty($email)) {
                $error_email = "Email harus diisi";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_email = "Format email tidak benar";
            }

            $alamat = test_input($_POST['alamat']);
            if (empty($alamat)) {
                $error_alamat = "Alamat harus diisi";
            }

            $jenis_kelamin = isset($_POST['jenis_kelamin']) ? test_input($_POST['jenis_kelamin']) : '';
            if (empty($jenis_kelamin)) {
                $error_jenis_kelamin = "Jenis kelamin harus diisi";
            }

            $kota = test_input($_POST['kota']);
            if (empty($kota)) {
                $error_kota = "Kota harus diisi";
            }

            $minat = isset($_POST['minat']) ? $_POST['minat'] : array();
            if (empty($minat)) {
                $error_minat = "Peminatan harus dipilih";
            } else {
                foreach ($minat as &$minat_item) {
                    $minat_item = test_input($minat_item);
                }
            }
        }
        ?>
        <form method="POST" autocomplete="on" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" maxlength="50">
                <div class="error"><?php if (isset($error_nama)) echo $error_nama; ?></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="error"><?php if (isset($error_email)) echo $error_email; ?></div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                <div class="error"><?php if (isset($error_alamat)) echo $error_alamat; ?></div>
            </div>
            <div class="form-group">
                <label for="kota">Kota/ Kabupaten:</label>
                <select id="kota" name="kota" class="form-control">
                    <option value="Semarang">Semarang</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Surabaya">Surabaya</option>
                </select>
                <div class="error"><?php if (isset($error_kota)) echo $error_kota; ?></div>
            </div>
            <label>Jenis Kelamin:</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria">Pria
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita">Wanita
                </label>
            </div>
            <div class="error"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
            <label>Peminatan:</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="minat[]" value="coding">Coding
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="minat[]" value="ux_design">UX Design
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="minat[]" value="data_science">Data Science
                </label>
            </div>
            <div class="error"><?php if (isset($error_minat)) echo $error_minat; ?></div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
        <?php
        if (isset($_POST["submit"])) {
            echo "<h3>Your Input:</h3>";
            echo 'Nama = ' . $_POST['nama'] . '<br />';
            echo 'Email = ' . $_POST['email'] . '<br />';
            echo 'Kota = ' . $_POST['kota'] . '<br />';
            echo 'Jenis Kelamin = ' . (isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '') . '<br />';
            $minat = isset($_POST['minat']) ? $_POST['minat'] : array();
            if (!empty($minat)) {
                echo 'Peminatan yang dipilih: ';
                foreach ($minat as $minat_item) {
                    echo '<br />' . $minat_item;
                }
            }
        }
        ?>
        <?php include('./footer.php') ?>
