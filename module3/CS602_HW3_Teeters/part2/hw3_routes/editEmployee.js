const employeeDB = require('../employeeDB.js');
const Employee = employeeDB.getModel();

module.exports = async (req , res , next) => {

    // Fill in the code
    let id = req.params.id;
    let { _id, firstName, lastName } = await Employee.findById(id);
    let data = { id: _id, firstName, lastName }

    if (!data){
        res.render('404');
    }else{
        res.render('editEmployeeView', {
            title: 'edit', data})
    }
    
};

