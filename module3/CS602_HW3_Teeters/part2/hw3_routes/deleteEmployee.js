const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {
    
    // Fill in the code
    let id = req.params.id;
      
//destructuring
    let { _id, firstName, lastName } = await Employee.findById(id);
    let data = { id: _id, firstName, lastName }
  
    console.log(data);
      if(!data){
        res.render('404');
        

      }else{
        res.render('deleteEmployeeView', {title: 'delete', data});

      }

    };
    
    
    
  
      

  