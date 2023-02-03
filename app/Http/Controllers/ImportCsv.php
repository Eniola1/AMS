<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportCsv extends Controller
{
    public function importCsv()
    {
        global $con; 

        if(isset($_POST['import']))
        {
            $ctrfName = $_FILES['ctrFile']['tmp_name'];
            $crncyfName = $_FILES['crncyFile']['tmp_name'];

            if($_FILES['ctrFile']['size'] > 0)
            {
                $file = fopen($ctrfName, 'r');

                while(($column = fgetcsv($file, 1000, ',')) !== FALSE)
                {
                    $SqlInsert = "Insert into countries(continent_code,currency_code,iso2_code,iso3_code,iso_numeric_code,fips_code,calling_code,common_name,official_name, endonym, demonym) values ('". $column[0] ."', '" . $column[1] ."', '" . $column[2] ."', '" . $column[3] ."', '" . $column[4] ."', '" . $column[5] ."', '" . $column[6] ."', '" . $column[7] ."', '" . $column[8] ."', '" . $column[9] ."', '" . $column[10] ."')";

                    $result = mysqli_query($con, $SqlInsert);

                    if(!empty($result))
                    {
                        echo "CSV Data Imported into the database";
                    }

                    else
                    {
                        echo "Problem in importing csv";    
                    }
                }
            }

            if($_FILES['crncyFile']['size'] > 0)
            {
                $file = fopen($crncyfName, 'r');

                while(($column = fgetcsv($file, 1000, ',')) !== FALSE)
                {
                    $SqlInsert = "Insert into currencies(iso_code,iso_numeric_code,common_name,official_name,symbol) values ('". $column[0] ."', '" . $column[1] ."', '" . $column[2] ."', '" . $column[3] ."', '" . $column[4] ."')";

                    $result = mysqli_query($con, $SqlInsert);

                    if(!empty($result))
                    {
                        echo "CSV Data Imported into the database";
                    }

                    else
                    {
                        echo "Problem in importing csv";    
                    }
                }
            }
        }
    }
}
    csv::program();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method = "post" name="uploadCsv" enctype="multipart/form-data">
        <div>
            <p>Choose CSV files</p>
            <label>Country:</label>
            <input type="file" name="ctrFile" accept=".csv">
            <label>Currency:</label>
            <input type="file" name="crncyFile" accept=".csv">
            <br>
            <button type="submit" name="import" style = "margin-left:250px; margin-top:10px;">Import</button>
        </div>
    </form>
</body>
</html> 
