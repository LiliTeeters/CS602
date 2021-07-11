const colors = require('colors');

const ZipCodeEmitter = require('./zipCodeEmitter').ZipCodeEmitter;

const cities = new ZipCodeEmitter();

cities.on('lookupByZipCode', (index) => {
    console.log(colors.green('\nEvent lookupByZipCode raised! \n', index));
});

cities.on('lookupByCityState', (results) => {
    console.log('\nEvent lookupByCityState raised! (Handler1) \n', results);
});

cities.on('getPopulationByState', (results) => {
    console.log('\nEvent getPopulationByState raised! (Handler2) \n', results);
});

cities.lookupByZipCode('02215');
cities.lookupByCityState("BOSTON", "MA");
cities.getPopulationByState('MA');



