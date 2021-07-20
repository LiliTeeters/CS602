const net = require('net');

const colors = require('colors');

const cities = require('./zipCodeModule_v2');

const server = net.createServer((socket) => {

	console.log("Client connection...".red);

	socket.on('end', () => {
		console.log("Client disconnected...".red);
	});

	// HW Code - Write the following code to process data from client
	
	socket.on('data', (data) => {
		//convertind data to a string and spliting data at the comma
		let input = data.toString('utf8').split(",");
		console.log(colors.blue('...Received %s'), input);

		// Fill in the rest
		if (input[0] === 'lookupByZipCode'){
			let zipcode = cities.lookupByZipCode(input[1]);
			socket.write(JSON.stringify(zipcode));
		} 

		if (input[0] === 'lookupByCityState') {
			let cityState = cities.lookupByCityState(input[1],input[2]);
			socket.write(JSON.stringify(cityState));
		}

		if (input[0] === 'getPopulationByState') {
			let popState = cities.getPopulationByState(input[1]);
			socket.write(JSON.stringify(popState));
		}
	});

});

// listen for client connections
server.listen(3000, () => {
	console.log("Listening for connections on port 3000");
});
