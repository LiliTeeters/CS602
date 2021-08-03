<?php

// Fill in the code for the following four functions

//gets input and assigns it to $taxableIncome
$taxableIncome = filter_input(INPUT_POST, 'netIncome');

function incomeTaxSingle($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome >= 0 && $taxableIncome <= 9700) {
        $incTax = ($taxableIncome * 0.10);
    }
    elseif ($taxableIncome >= 9700 && $taxableIncome <= 39475) {
        $incTax = (($taxableIncome - 9700) * 0.12) + 970;
    } 
    elseif ($taxableIncome >= 39475 && $taxableIncome <= 84200) {
        $incTax = (($taxableIncome - 39475) * 0.22) + 4543;
    } 
    elseif ($taxableIncome >= 84200 && $taxableIncome <= 160725) {
        $incTax = (($taxableIncome - 84200) * 0.24) + 14382;
    } 
    elseif ($taxableIncome >= 160725 && $taxableIncome <= 204100) {
        $incTax = (($taxableIncome - 160725) * 0.32) + 32748;
    } 
    elseif ($taxableIncome >= 204100 && $taxableIncome <= 510300) {
        $incTax = (($taxableIncome - 204100) * 0.35) + 46628;
    } 
    elseif ($taxableIncome >= 510300) {
        $incTax = (($taxableIncome - 510300) * 0.37) + 153798;
    }
    return $incTax;

}

function incomeTaxMarriedJointly($taxableIncome) {
    $incTax = 0.0;

    if($taxableIncome >= 0 && $taxableIncome <= 19400) {
        $incTax = ($taxableIncome * 0.10);
    }
    elseif ($taxableIncome >= 19400 && $taxableIncome <= 78950) {
        $incTax = (($taxableIncome - 19400) * 0.12) + 1940;
    } 
    elseif ($taxableIncome >= 78950 && $taxableIncome <= 168400) {
        $incTax = (($taxableIncome - 78950) * 0.22) + 9086;
    } 
    elseif ($taxableIncome >= 168400 && $taxableIncome <= 321450) {
        $incTax = (($taxableIncome - 168400) * 0.24) + 28765;
    } 
    elseif ($taxableIncome >= 321450 && $taxableIncome <= 408200) {
        $incTax = (($taxableIncome - 321450) * 0.32) + 65497;
    } 
    elseif ($taxableIncome >= 408200 && $taxableIncome <= 612350) {
        $incTax = (($taxableIncome - 408200) * 0.35) + 93257;
    } 
    elseif ($taxableIncome >= 612350) {
        $incTax = (($taxableIncome - 612350) * 0.37) + 164709;
    }

    return $incTax;

}

function incomeTaxMarriedSeparately($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome >= 0 && $taxableIncome <= 9700) {
        $incTax = ($taxableIncome * 0.10);
    }
    elseif ($taxableIncome >= 9700 && $taxableIncome <= 39475) {
        $incTax = (($taxableIncome - 9700) * 0.12) + 970;
    } 
    elseif ($taxableIncome >= 39475 && $taxableIncome <= 84200) {
        $incTax = (($taxableIncome - 39475) * 0.22) + 4543;
    } 
    elseif ($taxableIncome >= 84200 && $taxableIncome <= 160725) {
        $incTax = (($taxableIncome - 84200) * 0.24) + 14382.50;
    } 
    elseif ($taxableIncome >= 160725 && $taxableIncome <= 204100) {
        $incTax = (($taxableIncome - 160725) * 0.32) + 32748.50;
    } 
    elseif ($taxableIncome >= 204100 && $taxableIncome <= 306175) {
        $incTax = (($taxableIncome - 204100) * 0.35) + 46628.50;
    } 
    elseif ($taxableIncome >= 306175) {
        $incTax = (($taxableIncome - 306175) * 0.37) + 82354.75;
    }
    
    return $incTax;

}

function incomeTaxHeadOfHousehold($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome >= 0 && $taxableIncome <= 13850) {
        $incTax = ($taxableIncome * 0.10);
    }
    elseif ($taxableIncome >= 13850 && $taxableIncome <= 52850) {
        $incTax = (($taxableIncome - 13850) * 0.12) + 1385;
    } 
    elseif ($taxableIncome >= 52850 && $taxableIncome <= 84200) {
        $incTax = (($taxableIncome - 52850) * 0.22) + 6065;
    } 
    elseif ($taxableIncome >= 84200 && $taxableIncome <= 160700) {
        $incTax = (($taxableIncome - 84200) * 0.24) + 12962;
    } 
    elseif ($taxableIncome >= 160700 && $taxableIncome <= 204100) {
        $incTax = (($taxableIncome - 160700) * 0.32) + 31322;
    } 
    elseif ($taxableIncome >= 204100 && $taxableIncome <= 510300) {
        $incTax = (($taxableIncome - 204100) * 0.35) + 45210;
    } 
    elseif ($taxableIncome >= 510300) {
        $incTax = (($taxableIncome - 510300) * 0.37) + 152380;
    }
    
    return $incTax;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HW4 Part1 - Teeters</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post" >

        
        <div class="form-group">
            <label class="control-label col-sm-2" for="netIncome">Your Net Income:</label>
            <div class="col-sm-10">
            <input type="number" step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <br>

    </form>

    <?php

        // Fill in the rest of the PHP code for form submission results

        if(isset($_POST['netIncome'])) {
            //creating and printing table with data to screen
   
            echo "With a net taxable income of $" .number_format($taxableIncome, 2);
            echo "<br><br><br>";

            echo "<table class=table table-striped>";

            echo "<tr><th>Status</th><th>Tax</th></tr>";

            echo "<tr><td>Filing Single</td><td>";
            echo "$" .number_format(incomeTaxSingle($taxableIncome), 2);
            "</td></tr>";

            echo "<tr><td>Married Filing Jointly</td><td>";
            echo "$" .number_format(incomeTaxMarriedJointly($taxableIncome), 2);
            "</td></tr>";

            echo "<tr><td>Married Filing Separately</td><td>";
            echo "$" .number_format(incomeTaxMarriedSeparately($taxableIncome), 2);
            "</td></tr>";

            echo "<tr><td>Head of Household</td><td>";
            echo "$" .number_format(incomeTaxHeadOfHousehold($taxableIncome), 2);
            "</td></tr>";

            echo "</table>";
            
        };

    ?>

</div>
</body>
</html>