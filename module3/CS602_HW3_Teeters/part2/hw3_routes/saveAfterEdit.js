const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {

    // Fill in the code
    /*Find the employee by id, 
    change the employee's properties with the new values, 
    save to the database, 
    and redirect to /employees*/

    let id = req.body.id;
  
    console.log(req.body)
    let data = await Employee.findById(id);
   

    if (!data){
        res.render('404')
    }else{
        data.firstName = req.body.fname;
        data.lastName = req.body.lname;
        await data.save()
        res.redirect('/employees')
    }

    
 };
