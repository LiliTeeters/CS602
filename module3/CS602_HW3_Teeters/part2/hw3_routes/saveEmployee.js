const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {
 
    // Fill in the code
    let fname = req.body.fname
    let lname = req.body.lname
    let newEmployee = new Employee ({
      firstName:fname, lastName: lname
    });
    let result = await newEmployee.save()
    console.log(result)


    res.redirect('/employees');
  };
