<?php

// Fill in the code for the following four functions


function incomeTaxSingle($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome >= 0 && $taxableIncome <= 9700) {
        $incTax = ($taxableIncome * 0.10);

    }
    elseif ($taxableIncome >= 9700 && $taxableIncome <= 39475) {
        $incTax = incomeTaxRate($taxableIncome, 970, 12, 9699);
    } 
    elseif ($taxableIncome >= 39475 && $taxableIncome <= 84200) {
        $incTax = incomeTaxRate($taxableIncome, 4543, 22, 39474);
    } 
    elseif ($taxableIncome >= 84200 && $taxableIncome <= 160725) {
        $incTax = incomeTaxRate($taxableIncome, 14382, 24, 84199);
    } 
    elseif ($taxableIncome >= 160725 && $taxableIncome <= 204100) {
        $incTax = incomeTaxRate($taxableIncome, 32748, 32, 160724);
    } 
    elseif ($taxableIncome >= 204100 && $taxableIncome <= 510300) {
        $incTax = incomeTaxRate($taxableIncome, 46628, 35, 204099);
    } 
    elseif ($taxableIncome >= 510300) {
        $incTax = incomeTaxRate($taxableIncome, 153798, 37, 510299);
    }
    return $incTax;

}

function incomeTaxMarriedJointly($taxableIncome) {
    $incTax = 0.0;

    if($taxableIncome >= 0 && $taxableIncome <= 19400) {
        $incTax = ($taxableIncome * 0.10);
    }
    elseif ($taxableIncome >= 19400 && $taxableIncome <= 78950) {
        $incTax = incomeTaxRate($taxableIncome, 1940, 12, 19399);
    } 
    elseif ($taxableIncome >= 78950 && $taxableIncome <= 168400) {
        $incTax = incomeTaxRate($taxableIncome, 9086, 22, 78949);
    } 
    elseif ($taxableIncome >= 168400 && $taxableIncome <= 321450) {
        $incTax = incomeTaxRate($taxableIncome, 28765, 24, 168399);
    } 
    elseif ($taxableIncome >= 321450 && $taxableIncome <= 408200) {
        $incTax = incomeTaxRate($taxableIncome, 65497, 32, 321449);
    } 
    elseif ($taxableIncome >= 408200 && $taxableIncome <= 612350) {
        $incTax = incomeTaxRate($taxableIncome, 93257, 35, 408199);
    } 
    elseif ($taxableIncome >= 612350) {
        $incTax = incomeTaxRate($taxableIncome, 164709, 37, 612349);
    }

    return $incTax;

}

function incomeTaxMarriedSeparately($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome >= 0 && $taxableIncome <= 9700) {
        $incTax = ($taxableIncome * 0.10);
    }
    elseif ($taxableIncome >= 9700 && $taxableIncome <= 39475) {
        $incTax = incomeTaxRate($taxableIncome, 970, 12, 9699);
    } 
    elseif ($taxableIncome >= 39475 && $taxableIncome <= 84200) {
        $incTax = incomeTaxRate($taxableIncome, 4543, 22, 39474);
    } 
    elseif ($taxableIncome >= 84200 && $taxableIncome <= 160725) {
        $incTax = incomeTaxRate($taxableIncome, 14382.50, 24, 84199);
    } 
    elseif ($taxableIncome >= 160725 && $taxableIncome <= 204100) {
        $incTax = incomeTaxRate($taxableIncome, 32748.50, 32, 160724);
    } 
    elseif ($taxableIncome >= 204100 && $taxableIncome <= 306175) {
        $incTax = incomeTaxRate($taxableIncome, 46628.50, 35, 204099);
    } 
    elseif ($taxableIncome >= 306175) {
        $incTax = incomeTaxRate($taxableIncome, 82354.75, 37, 306174);
    }
    
    return $incTax;

}

function incomeTaxHeadOfHousehold($taxableIncome) {
    $incTax = 0.0;
    if($taxableIncome >= 0 && $taxableIncome <= 19400) {
        $incTax = ($taxableIncome * 0.10);
    }
    elseif ($taxableIncome >= 19400 && $taxableIncome <= 78950) {
        $incTax = incomeTaxRate($taxableIncome, 1940, 12, 19399);
    } 
    elseif ($taxableIncome >= 78950 && $taxableIncome <= 168400) {
        $incTax = incomeTaxRate($taxableIncome, 9086, 22, 78949);
    } 
    elseif ($taxableIncome >= 168400 && $taxableIncome <= 321450) {
        $incTax = incomeTaxRate($taxableIncome, 28765, 24, 168399);
    } 
    elseif ($taxableIncome >= 321450 && $taxableIncome <= 408200) {
        $incTax = incomeTaxRate($taxableIncome, 65497, 32, 321449);
    } 
    elseif ($taxableIncome >= 408200 && $taxableIncome <= 612350) {
        $incTax = incomeTaxRate($taxableIncome, 93257, 35, 408199);
    } 
    elseif ($taxableIncome >= 612350) {
        $incTax = incomeTaxRate($taxableIncome, 164709, 37, 612349);
    }

    
    return $incTax;

}

function incomeTaxRate($taxableIncome, $minimumTax, $taxRate, $amountOver) {
    // convert tax bracket to a percentage
    $taxRate = $taxRate / 100;
    // calculate the marginal tax rate
    $marginalTaxRate = (($taxableIncome - $amountOver) * $taxRate) + $minimumTax;
    return $marginalTaxRate;
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

    <form class="form-horizontal" method="post">

        
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

    </form>

    <?php

        // Fill in the rest of the PHP code for form submission results

        if(isset($_POST['netIncome'])) {

            echo "Results...";



        }

    ?>

</div>

</body>
</html>