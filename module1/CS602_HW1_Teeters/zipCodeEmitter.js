const EventEmitter = require('events').EventEmitter;
const data = require('./zips.json');

// Custom class 
class ZipCodeEmitter  extends EventEmitter {
	
	// member functions

	lookupByZipCode(zip)  {
		for(let index = 0; index < data.length; index++) {
			if(data[index]._id === zip) {
				this.emit('lookupByZipCode', data[index]);
			}
		}
	}

	lookupByCityState(city, state)  {
		const newData = []
    	let results = {'city': city, 'state': state, 'data': newData};
    	for(let index = 0; index < data.length; index++){
        	if((data[index].city === city) && (data[index].state === state)){
            newData.push({'zip': data[index]._id, 'pop': data[index].pop}	)
        	}
    	}	 
    	this.emit('lookupByCityState', results) ;	
	}

	getPopulationByState(state) {
		let population = 0;
    	for(let index = 0; index < data.length; index++){
        	if(data[index].state === state){
            population += data[index].pop;   
        	}
    	}
    	let results = {'state': state, 'pop': population};
    	this.emit('getPopulationByState', results);	
	}

}

module.exports.ZipCodeEmitter = ZipCodeEmitter;

