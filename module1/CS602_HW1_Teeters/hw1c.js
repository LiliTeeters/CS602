const colors = require('colors');

const ZipCodeEmitter = require('./zipCodeEmitter').ZipCodeEmitter;

const cities = new ZipCodeEmitter();

cities.on('lookupByZipCode', (index) => {
    console.log(colors.yellow('Event lookupByZipCode raised!\n', index));
});

cities.on('lookupByCityState', (results) => {
    console.log(colors.yellow('Event lookupByCityState raised! (Handler1)\n', results));
});

cities.on('getPopulationByState', (results) => {
    console.log(colors.yellow('Event getPopulationByState raised! (Handler2)\n', results));
});

console.log("\nLookupByZipCode (02215)".green);
cities.lookupByZipCode('02215');

console.log("\nLookupByCityState (BOSTON,MA)".green);
cities.lookupByCityState("BOSTON", "MA");


console.log("\ngetPopulationByState (MA)".green);
cities.getPopulationByState('MA');



