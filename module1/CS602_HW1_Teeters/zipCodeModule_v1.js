const data = require('./zips.json');

module.exports.lookupByZipCode = (zip) => {
    //looping through data
    for(let index = 0; index < data.length; index++) {
        if(data[index]._id === zip) {
            return data[index];
        }
    }
};


module.exports.lookupByCityState = (city, state) => {
    //new array to hold all zip and pop data for a specific city and state
    const newData = []
    let results = {'city': city, 'state': state, 'data': newData};
    //looping through file
    for(let index = 0; index < data.length; index++){
        //if city in data matches city and statem in data matches state then push all zip and pop data to newData array
        if((data[index].city === city) && (data[index].state === state)){
            newData.push({'zip': data[index]._id, 'pop': data[index].pop})
        }
    }	 
    //returning results in above format
    return results;	
};

module.exports.getPopulationByState = (state) => {
    //population counter 
    let population = 0;

    //looping to find if state data matches state then look for population and add that pop to population varialbe for printing
    for(let index = 0; index < data.length; index++){
        if(data[index].state === state){
            population += data[index].pop;   
        }
    }
    //does not work above for loop. This is the format for printing
    let results = {'state': state, 'pop': population};
    return results	
};

console.log("Look up zip code (02215)");
console.log(module.exports.lookupByZipCode('02215'));

console.log("Look up zip code (99999)");
console.log(module.exports.lookupByZipCode('99999'));

console.log("Look up by city (BOSTON, MA)");
console.log(module.exports.lookupByCityState("BOSTON", "MA"));

console.log("Look up by city (BOSTON, TX)");
console.log(module.exports.lookupByCityState("BOSTON", "TX"));

console.log("Look up by state (MA)");
console.log(module.exports.getPopulationByState('MA'));

console.log("Look up by state (TX)");
console.log(module.exports.getPopulationByState('TX'));

console.log("Look up by state (AA)");
console.log(module.exports.getPopulationByState('AA'));