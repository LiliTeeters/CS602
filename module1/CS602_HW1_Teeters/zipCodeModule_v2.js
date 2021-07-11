const data = require('./zips.json');

module.exports.lookupByZipCode = (zip) => {
    //items stores the data from array in which _id equals zip
    var items = data.find(data => data._id === zip);
    return items;           
};


module.exports.lookupByCityState = (city, state) => {
    //results stores the filter data from array if city matches as well as state
    var results = data.filter(value => value.city === city && value.state === state)
    //map the results and return the objects zip and pop only
    .map(value => {
        return {'zip': value._id, 'pop': value.pop}
    });
    //returning all data designated
    return {city, state, data: results};	
};

module.exports.getPopulationByState = (state) => {
    let population = data.reduce((total,current) => {
        //checking if current item is the same as the state. If so, add that current item to total
        if(current.state === state) {
            total += current.pop;
        }
        return total;
    },0)
	return {state, pop: population};	
};


console.log("\nLook up zip code (02215)");
console.log(module.exports.lookupByZipCode('02215'));

console.log("\nLook up zip code (99999)");
console.log(module.exports.lookupByZipCode('99999'));

console.log("\nLook up by city and state (BOSTON, MA)");
console.log(module.exports.lookupByCityState("BOSTON", "MA"));

console.log("\nLook up by city and state (BOSTON, TX)");
console.log(module.exports.lookupByCityState("BOSTON", "TX"));

console.log("\nLook up by state (MA)");
console.log(module.exports.getPopulationByState('MA'));

console.log("\nLook up by state (TX)");
console.log(module.exports.getPopulationByState('TX'));

console.log("\nLook up by state (AA)");
console.log(module.exports.getPopulationByState('AA'));