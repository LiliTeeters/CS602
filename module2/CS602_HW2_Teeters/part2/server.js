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
	let replacement = {message: "Welcome to CS602 Week 2 homework assignment"};
	res.render('homeView', replacement);
});

app.get('/zip', (req, res) => {
	const id = req.query.id;
	if(id) {
		const results = cities.lookupByZipCode(id);
		//we want to render the page look up zipView with the results
		const replacement = {zipVariable: results.city}
		return res.render('lookupByZipView', replacement);
	}
	res.render('lookupByZipForm');
	
});

app.post('/zip', (req, res) => {
	const id = req.body.id;
	//console.log(req.body);
	const results = cities.lookupByZipCode(id);
	const replacement = {
		zipVariable: results._id,
		city: results.city, 
		state: results.state,
		population: results.pop};
	return res.render('lookupByZipView', replacement);
});

// Implement the JSON, XML, & HTML formats

app.get('/zip/:id', (req, res) => {
	

});



app.get('/city', (req, res) => {
	const city = req.query.city;
	if(city) {
		const results = cities.lookupByCityState(city);
		const replacement = {cityVariable: results.city}
		return res.render('lookupByCityStateView', replacement);
	}
	res.render('lookupByCityStateForm');

});

app.post('/city', (req, res) => {
	const city = req.body.city;
	const results = cities.lookupByCityState(city);
	const replacement = {
		cityVariable: results.city,
		//stateVariable: results.state,
		zip: results._id,
		population: results.pop};
		return res.render('lookupByCityStateView', replacement);

});

// Implement the JSON, XML, & HTML formats

app.get('/city/:city/state/:state', (req, res) => {
	


});



app.get('/pop', (req, res) => {
	
	
});

// Implement the JSON, XML, & HTML formats

app.get('/pop/:state', (req, res) => {
	

});


app.use((req, res) => {
	res.status(404);
	res.render('404');
});

app.listen(3000, () => {
  console.log('http://localhost:3000');
});




