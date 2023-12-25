<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rata-rata nilai mahasiswa</title>
</head>
<body>
    <?php
      $array_mhs = array('Abdul'    => array(89,90,54),
                    'Budi' => array(98,65,74),
                    'Nina' => array(67,56,84));
        function hitung_rata($array){
            return $rata2 = array_sum($array)/count($array);
        }

        function print_mhs($array_mhs){
            foreach($array_mhs as $nama => $nilai ){
                echo '<tr>
                        <td>'.$nama.'</td>
                        <td>'.$nilai[0].'</td>
                        <td>'.$nilai[1].'</td>
                        <td>'.$nilai[2].'</td>
                        <td>'.hitung_rata($nilai).'</td>
                      </tr>';
            }
        }
        
        echo '<table border="1">';
        echo '<tr>
                <th>Nama</th>
                <th>Nilai 1</th>
                <th>Nilai 2</th>
                <th>Nilai 3</th>
                <th>Rata2</th>
              </tr>';
              print_mhs($array_mhs);
        echo '</table>';
        
    ?>
</body>
</html>