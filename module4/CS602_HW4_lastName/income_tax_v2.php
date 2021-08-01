<?php

define('TAX_RATES',
  array(
    'Single' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,510300),
      'MinTax' => array(0, 970,4543,14382,32748,46628,153798)
      ),
    'Married_Jointly' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,19400,78950,168400,321450,408200,612350),
      'MinTax' => array(0, 1940,9086,28765,65497,93257,164709)
      ),
    'Married_Separately' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,306175),
      'MinTax' => array(0, 970,4543,14382.50,32748.50,46628.50,82354.75)
      ),
    'Head_Household' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,13850,52850,84200,160700,204100,510300),
      'MinTax' => array(0, 1385,6065,12962,31322,45210,152380)
      )
    )
);

// Fill in the code for the following function
$taxableIncome = (double)filter_input(INPUT_POST, 'netIncome', FILTER_SANITIZE_NUMBER_FLOAT);

function incomeTax($taxableIncome, $status) {
    $incTax = 0.0;
    $rates = TAX_RATES[$status]['Rates'];
    $ranges = TAX_RATES[$status]['Ranges'];
		$minTax = TAX_RATES[$status]['MinTax'];

    $maxIndex = max(array_keys($ranges));

    foreach ($ranges as $index => $range) {

      // if taxableIncome is greater than the maximum range value  
      if($taxableIncome > $ranges[$maxIndex]) {								
        // convert the rate at the max index to a decimal
        $rateDecimal = $rates[$maxIndex] / 100;
        // determine taxes owed
        $incTax = (($taxableIncome - $ranges[$maxIndex]) * $rateDecimal) + $minTax[$maxIndex]; 
        break;
      }

      // if taxableIncome falls within the ranges in the array
      elseif(($taxableIncome <= $range) and ($taxableIncome > $ranges[$index - 1])) {									
        $rateDecimal = $rates[$index - 1] / 100; // convert to decimal
        $incTax =  (($taxableIncome - $ranges[$index]) * $rateDecimal) + $minTax[$index];
        break;
      }   
    }     
    return $incTax;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HW4 Part2 - LastName</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post">

      <div class="form-group">
        <label class="control-label col-sm-2">Enter Net Income:</label>
        <div class="col-sm-10">
          <input type="number"  step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
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

            echo "With a net taxable income of $" .number_format($taxableIncome, 2);

            echo "<table>";

            echo "<tr><th>Status</th><th>Tax</th></tr>";

            echo "<tr><td>Filing Single</td><td>";
            echo "$" .number_format(incomeTax($taxableIncome, 'Single'), 2);
           
            "</td></tr>";
            echo "<tr><td>Married Filing Jointly</td><td>";
            echo "$" .number_format(incomeTax($taxableIncome, 'Married_Jointly'), 2);
           
            "</td></tr>";
            echo "<tr><td>Married Filing Separately</td><td>";
            echo "$" .number_format(incomeTax($taxableIncome, 'Married_Separately'), 2);
           
            "</td></tr>";
            echo "<tr><td>Head of Household</td><td>";
            echo "$" .number_format(incomeTax($taxableIncome, 'Head_Household'), 2);
           
            "</td></tr>";

            echo "</table>";

        }

    ?>

    
    <br><br>
    <h3>2019 Tax Tables</h3>
    <br><br>

    <?php

      // Fill in the code for Tax Tables display

     
      // print out the tax table 
				foreach(TAX_RATES as $index => $taxArray) {

					// print the filing status headers
					echo "<strong>" .$index ."</strong>";

					// create the table
					echo '<table class="table table-striped">
										<thead class="table-success">
											<tr>
												<th scope="col">Taxable Income</th>
												<th scope="col">Tax Rate</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td scope="row">';		
													// print first row only						
													echo "$" .number_format(TAX_RATES[$index]['Ranges'][0]);
													echo " - $" .number_format(TAX_RATES[$index]['Ranges'][1]);
									echo '</td>
												<td>';
													echo TAX_RATES[$index]['Rates'][0] ."%";
									echo '</td>
											</tr>';

									// count the number of array elements 
									$loopCount = count(TAX_RATES[$index]['Ranges']);		
									// get the highest index position in the array
									$maxTaxIndex = max(array_keys(TAX_RATES[$index]['Rates']));

									// loop to print the remaining rows, except the last row			
									// start loop at 1 to skip first row, use -1 with $loopCount to skip last row
									for($i=1; $i < ($loopCount - 1); $i++) {
								
											echo '<tr>
															<td scope="row">';								
																echo "$" .number_format((TAX_RATES[$index]['Ranges'][$i])+1);
																echo " - $" .number_format(TAX_RATES[$index]['Ranges'][$i + 1]);
											echo  '</td>
															<td>';
																echo "$" .number_format(TAX_RATES[$index]['MinTax'][$i], 2) ." plus ";
																echo TAX_RATES[$index]['Rates'][$i] ."% of the amount over ";
																echo "$" .number_format(TAX_RATES[$index]['Ranges'][$i]);
											echo  '</td>
														</tr>';
										}

										// print the last array element row that was left out of the for loop
										echo '<tr>
														<td scope="row">';		
															// print last row 						
															echo "$" .number_format((TAX_RATES[$index]['Ranges'][$maxTaxIndex]) + 1);
															echo " or more"; 
											echo '</td>
														<td>';
															echo "$" .number_format(TAX_RATES[$index]['MinTax'][$maxTaxIndex], 2) ." plus ";
															echo TAX_RATES[$index]['Rates'][$maxTaxIndex] ."% of the amount over ";
															echo "$" .number_format(TAX_RATES[$index]['Ranges'][$maxTaxIndex]);		
											echo '</td>
													</tr>															
								  </tbody>
							  </table> ';
							}

    ?>

   
       
</div>

</body>
</html>