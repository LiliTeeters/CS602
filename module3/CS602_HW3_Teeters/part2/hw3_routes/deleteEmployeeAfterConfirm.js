const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports =  async (req , res , next) => {
    
    // Fill in the code
    let id = req.body.id;
    console.log(id)
    let result = await Employee.findById(id);
      if(!result){
        res.render('404');

      }else{
        await result.remove();
        res.redirect('/employees');

      }
        
  };

  