const express = require('express');
const app = express();

const bodyParser = require("body-parser");
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// setup handlebars view engine
const handlebars = require('express-handlebars');

app.engine('handlebars', 
	handlebars({defaultLayout: 'main'}));

app.set('view engine', 'handlebars');

// static resources
app.use(express.static(__dirname + '/public'));

// Use the employee module
const cities = require('./mongo_zipCodeModule_v2');

// GET request to the homepage

app.get('/', function (req, res){
	res.render('homeView');
});

app.get('/zip', async function(req, res) {
	if (req.query.id) {
		let id = req.query.id;
		let result = await cities.lookupByZipCode(id);
		res.render('lookupByZipView', result);
	} else {
		res.render('lookupByZipForm');
	}
});

app.post('/zip', async function(req, res) {
	let id = req.body.id;
	let result = await cities.lookupByZipCode(id);
	res.render('lookupByZipView', result);
});


app.get('/zip/:id', async function(req, res) {
	let id = req.params.id;
	let result = await cities.lookupByZipCode(id);

	res.format({

		'application/json': function() {
			res.json(result);
		},

		'application/xml': function() {
			let resultXml = 
				'<?xml version="1.0"?>\n' +
						'<zipCode id="' + result._id + '">\n' + 
						'   <city>' + result.city + '</city>\n' + 
						'   <state>' + result.state + '</state>\n' + 	
						'   <pop>' + result.pop + '</pop>\n' + 				 
						'</zipCode>\n';
					
			
			res.type('application/xml');
			res.send(resultXml);
		},

		'text/html': function() {
			res.render('lookupByZipView', result);

		}
	});
});


// Complete the code for the following

app.get('/city', async function(req, res){
	let city = req.query.city;
	let state = req.query.state;
	if(city && state) {
		let results = await cities.lookupByCityState(city,state);
		console.log(results);
		res.render('lookupByCityStateView', {cityVariable: results.city,
			stateVariable: results.state,
			data: results.data});
	} else {
		res.render('lookupByCityStateForm');
	}		
});


app.post('/city', async function(req, res){
	let city = req.body.city;
	let state = req.body.state;
	let results = await cities.lookupByCityState(city,state);
		res.render('lookupByCityStateView', {cityVariable: results.city,
			stateVariable: results.state,
			data: results.data});
});

app.get('/city/:city/state/:state', async function(req, res) {
	const city = req.params.city;
	const state = req.params.state;
	const results = await cities.lookupByCityState(city,state);
	res.render('lookupByCityStateView', {cityVariable: results.city,
		stateVariable: results.state,
		data: results.data});
/*
	res.format ({
		'application/json': function() {
			res.json(results)
		},

		'application/xml': function() {
			'<?xml version="1.0"?>\n' +
						'<zipCode id="' + results._id + '">\n' + 
						'   <city>' + results.city + '</city>\n' + 
						'   <state>' + results.state + '</state>\n' + 	
						'   <pop>' + results.pop + '</pop>\n' + 				 
						'</zipCode>\n';
					
			
			res.type('application/xml');
			res.send(resultXml);
		},

		'text/html': function() {
			res.render('lookupByCityStateView', results);
		}
	});*/
});

app.get('/pop', async function(req, res) {
	let state = req.query.state;
	if (state){
		let results = await cities.getPopulationByState(state);
		res.render('populationView', {state: results.state, population: results.pop});
	}else{
		res.render('populationForm');
	}
	
});

app.get('/pop/:state', async function(req, res) {
	let state = req.params.state;
	const results = await cities.getPopulationByState(state);
	res.render('populationView', {state: results.state, population: results.pop});
/*
	res.format ({
		'application/json': function() {
			res.json(results)
		},

		'application/xml': function() {
			'<?xml version="1.0"?>\n' +
						'<zipCode id="' + results._id + '">\n' + 
						'   <city>' + results.city + '</city>\n' + 
						'   <state>' + results.state + '</state>\n' + 	
						'   <pop>' + results.pop + '</pop>\n' + 				 
						'</zipCode>\n';
					
			
			res.type('application/xml');
			res.send(resultXml);
		},

		'text/html': function() {
			res.render('lookupByCityStateView', results);
		}
	});*/

});


app.use(function(req, res) {
	res.status(404);
	res.render('404');
});

app.listen(3000, function(){
  console.log('http://localhost:3000');
});




