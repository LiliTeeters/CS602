const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {
    
    // Fill in the code
    let id = req.params.id;
    let deleteEmployee = Employee({
      id
    });
    let result = await deleteEmployee.remove()
    console.log(result)
    
    res.redirect('/deleteEmployee');
    }
  
      

  