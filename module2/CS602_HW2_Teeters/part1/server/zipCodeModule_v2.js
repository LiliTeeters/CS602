// Copy your solution from Assignment1


let data = require('./zips.json');

module.exports.lookupByZipCode =  (zip) => {
    var items = data.find(data => data._id === zip);
    return items;   	
};

module.exports.lookupByCityState = (city, state) => {
    var results = data.filter(value => value.city === city && value.state === state).map(value => {
        return {'zip': value._id, 'pop': value.pop}
    });
    return {city, state, data: results};	
};

module.exports.getPopulationByState = (state) => {
    let population = data.reduce((total,current) => {
        if(current.state === state) {
            total += current.pop;
        }
        return total;
    },0)
	return {state, pop: population};	
};

