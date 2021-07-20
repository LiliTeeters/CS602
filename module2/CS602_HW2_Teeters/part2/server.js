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

// Use the zipCode module
const cities = require('./zipCodeModule_v2');

// GET request to the homepage

app.get('/',  (req, res) => {
	//res.render('homeView');
	let welcome = {message: "Welcome to CS602 Week 2 homework assignment"};
	//render welcome message
	res.render('homeView', welcome);
});

app.get('/zip', (req, res) => {
	const id = req.query.id;
	if(id) {
		//calling function from zipCodeModule_v2.js and rendering information to the objects in handlebars file
		const results = cities.lookupByZipCode(id);
		res.render('lookupByZipView', {
			zipVariable: results._id,
			city: results.city, 
			state: results.state,
			population: results.pop});
	}else {
		res.render('lookupByZipForm');
	}	
});

app.post('/zip', (req, res) => {
	const id = req.body.id;
	const results = cities.lookupByZipCode(id);
	res.render('lookupByZipView', {
		zipVariable: results._id,
		city: results.city, 
		state: results.state,
		population: results.pop});
});

// Implement the JSON, XML, & HTML formats
app.get('/zip/:id', (req, res) => {
	const id = req.params.id;
	//console.log(id);
	res.format({
		 'application/json': () => {
			 res.json(cities.lookupByZipCode(id));
		 }
	})
});

app.get('/city', (req, res) => {
	const city = req.query.city;
	const state = req.query.state;
	if(city && state) {
		const results = cities.lookupByCityState(city,state);
		res.render('lookupByCityStateView', {cityVariable: results.city,
			stateVariable: results.state,
			data: results.data});
	};
	res.render('lookupByCityStateForm');
});

app.post('/city', (req, res) => {
	const city = req.body.city;
	const state = req.body.state;
	const results = cities.lookupByCityState(city,state);
		res.render('lookupByCityStateView', {cityVariable: results.city,
			stateVariable: results.state,
			data: results.data});
});

// Implement the JSON, XML, & HTML formats
app.get('/city/:city/state/:state', (req, res) => {
	const city = req.params.city;
	const state = req.params.state;
	const results = cities.lookupByCityState(city,state);
	res.render('lookupByCityStateView', {cityVariable: results.city,
		stateVariable: results.state,
		data: results.data});
});

app.get('/pop', (req, res) => {
	const state = req.query.state;
	if (state){
		const results = cities.getPopulationByState(state);
		res.render('populationView', {state: results.state, population: results.pop});
	}else{
		res.render('populationForm');
	}
});

// Implement the JSON, XML, & HTML formats
app.get('/pop/:state', (req, res) => {
	const state = req.params.state;
	const results = cities.getPopulationByState(state);
	res.render('populationView', {state: results.state, population: results.pop})
});


app.use((req, res) => {
	res.status(404);
	res.render('404');
});

app.listen(3000, () => {
  console.log('http://localhost:3000');
});




