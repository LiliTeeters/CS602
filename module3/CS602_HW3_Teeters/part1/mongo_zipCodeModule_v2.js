const MongoClient = require('mongodb').MongoClient;
const credentials = require("./credentials.js");

const dbUrl = 'mongodb+srv://' + credentials.username +
	':' + credentials.password + '@' + credentials.host + '/' + credentials.database;

let client = null;

const getConnection = async () => {
	if (client == null)
		client = await MongoClient.connect(dbUrl,  { useNewUrlParser: true ,  useUnifiedTopology: true });
	return client;
}

module.exports.lookupByZipCode =  async (zip) => {
		//waiting until connection is established
	let client = await getConnection();
	let collection = client.db(credentials.database).collection('zipcodes');
	
	let result = await collection.find({'_id': zip}).toArray();
	
	if (result.length > 0)
		return result[0];
	else
		return undefined;
};

// Complete the code for the following

module.exports.lookupByCityState = async (city, state) => {
//connecting to mongo database
	let client = await getConnection();
	let collection = client.db(credentials.database).collection('zipcodes');
	// Fill in the rest
	let result = await collection.find({'city': city}, {'state': state}).toArray()
	let zipPop = result.filter(value => value.city === city && value.state === state).map(value => {
        return {'zip': value._id, 'pop': value.pop}
    });

	if (result.length > 0)
		return {city, state, data: zipPop};	
	else
		return undefined;
};


module.exports.getPopulationByState = 
	async (state) => {
		let client = await getConnection();
		let collection = client.db(credentials.database).collection('zipcodes');
	
		// Fill in the rest
		let result = await collection.find({'state': state}).toArray();
		let population = result.reduce((total,current) => {
			if(current.state === state) {
				total += current.pop;
			}
			return total;
		},0)

	if (result.length > 0)
		return {state, pop: population};
	else
		return undefined;	
	};


