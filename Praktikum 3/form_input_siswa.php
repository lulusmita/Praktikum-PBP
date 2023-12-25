<?php include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header">Form Input Siswa</div>
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
            $nis = test_input($_POST['nis']);
            if (empty($nis)) {
                $error_nis = "NIS harus diisi";
            } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
                $error_nis = "NIS hanya boleh terdiri dari 10 digit angka";
            }
            $nama = test_input($_POST['nama']);
            if (empty($nama)) {
                $error_nama = "Nama harus diisi";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
                $error_nama = "Nama hanya dapat berupa huruf dan spasi";
            } 
            $jenis_kelamin = isset($_POST['jenis_kelamin']) ? test_input($_POST['jenis_kelamin']) : '';
            if (empty($jenis_kelamin)) {
                $error_jenis_kelamin = "Jenis kelamin harus diisi";
            }
            $kelas = test_input($_POST['kelas']);
            if (empty($kelas)) {
                $error_kelas = "Kelas harus diisi";
            }
            $ekstrakurikuler = isset($_POST['ekstrakurikuler']) ? $_POST['ekstrakurikuler'] : array();
            if ($kelas == 'X' || $kelas == 'XI') {
                if (empty($ekstrakurikuler)) {
                    $error_ekstrakurikuler = "Ekstrakurikuler harus dipilih minimal satu dan maksimal tiga";
                } elseif (count($ekstrakurikuler) > 3) {
                    $error_ekstrakurikuler = "Anda hanya dapat memilih maksimal tiga ekstrakurikuler";
                }
            }
            if (!isset($error_nis) && !isset($error_nama) && !isset($error_jenis_kelamin) && !isset($error_kelas) && !isset($error_ekstrakurikuler)) {
                $reloadPage = true;
                if ($reloadPage) {
                    echo '<script>window.location.href = window.location.href;</script>';
                }
            }
    }
        ?>
        <form method="POST" autocomplete="on" action="">
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="number" class="form-control" id="nis" name="nis" maxlength="10"
                value= "<?php if(isset($nis)) {echo $nis;}  ?>">
                <div class="error"><?php if (isset($error_nis)) echo $error_nis; ?></div>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama"
                value= "<?php if(isset($nama)) {echo $nama;}  ?>">
                <div class="error"><?php if (isset($error_nama)) echo $error_nama; ?></div>
            </div>
            <label>Jenis Kelamin:</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria"
                    <?php if (isset($jenis_kelamin) && $jenis_kelamin=="pria") echo "checked";?>>Pria
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita"
                    <?php if (isset($jenis_kelamin) && $jenis_kelamin=="wanita") echo "checked";?>>Wanita
                </label>
            </div>
            <div class="error"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select id="kelas" name="kelas" class="form-control">
                    <option value="X" <?php if (isset($kelas) && $kelas=="X") echo 'selected="true"';?>>X</option>
                    <option value="XI" <?php if (isset($kelas) && $kelas=="XI") echo 'selected="true"';?>>XI</option>
                    <option value="XII" <?php if (isset($kelas) && $kelas=="XII") echo 'selected="true"';?>>XII</option>
                </select>
                <div class="error"><?php if (isset($error_kelas)) echo $error_kelas; ?></div>
            </div>
            <div id="ekstrakurikuler-options">
                <label>Ekstrakurikuler:</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="pramuka"
                        <?php if (isset($ekstrakurikuler) && in_array('pramuka',$ekstrakurikuler)) echo "checked";?>> Pramuka
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="seni_tari"
                        <?php if (isset($ekstrakurikuler) && in_array('seni_tari',$ekstrakurikuler)) echo "checked";?>> Seni Tari
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="sinematografi"
                        <?php if (isset($ekstrakurikuler) && in_array('sinematografi',$ekstrakurikuler)) echo "checked";?>> Sinematografi
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="basket"
                        <?php if (isset($ekstrakurikuler) && in_array('basket',$ekstrakurikuler)) echo "checked";?>> Basket
                    </label>
                </div>
            </div>
            <div class="error"><?php if (isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler; ?></div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
        <?php
        if (isset($_POST["submit"])) {
            echo "<h3>Your Input:</h3>";
            echo 'NIS = ' . $_POST['nis'] . '<br />';
            echo 'Nama = ' . $_POST['nama'] . '<br />';
            echo 'Jenis Kelamin = ' . (isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '') . '<br />';
            echo 'Kelas = ' . $_POST['kelas'] . '<br />';
            $ekstrakurikuler = isset($_POST['ekstrakurikuler']) ? $_POST['ekstrakurikuler'] : array();
            if (!empty($ekstrakurikuler)) {
                echo 'Ekstrakurikuler yang dipilih: ';
                foreach ($ekstrakurikuler as $ekstrakurikuler_item) {
                    echo '<br />' . $ekstrakurikuler_item;
                }
            }
        }
        ?>
         <script>
        document.getElementById("kelas").addEventListener("change", function () {
        var ekstrakurikulerOptions = document.getElementById("ekstrakurikuler-options");
        if (this.value === "XII") {
            ekstrakurikulerOptions.style.display = "none";
        } else {
            ekstrakurikulerOptions.style.display = "block";
        }
        });


        window.addEventListener("load", function () {
        var kelasSelect = document.getElementById("kelas");
        var ekstrakurikulerOptions = document.getElementById("ekstrakurikuler-options");
        if (kelasSelect.value === "XII") {
            ekstrakurikulerOptions.style.display = "none";
        }
        });
        </script>
        <?php include('./footer.php') ?>
