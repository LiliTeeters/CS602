const colors = require('colors');

const ZipCodeEmitter = require('./zipCodeEmitter').ZipCodeEmitter;

const cities = new ZipCodeEmitter();

cities.on('lookupByZipCode', (index) => {
    console.log(colors.yellow('Event lookupByZipCode raised!\n', index));
});

cities.on('lookupByCityState', (output) => {
    console.log(colors.yellow('Event lookupByCityState raised! (Handler1)\n', output));
});

//event handler2
cities.on('lookupByCityState', (output) => {
    console.log(colors.blue('\nEvent lookupByCityState raised! (Handler2)\n'));
    //printing city and state
    console.log(`City: ${output.city}, State: ${output.state}`)
    //looping through again in order to restructure the output
    //exclusively looping through the output that was emmited from original function in zipCodeEmmitter.js
    for (let i = 0; i < output.data.length; i++) {
        console.log(`${output.data[i].zip} has a pop of ${output.data[i].pop}`)
    }
});

cities.on('getPopulationByState', (results) => {
    console.log(colors.yellow('Event getPopulationByState raised!\n', results));
});

console.log("\nLookupByZipCode (02215)".green);
cities.lookupByZipCode('02215');

console.log("\nLookupByCityState (BOSTON,MA)".green);
cities.lookupByCityState("BOSTON", "MA");


console.log("\ngetPopulationByState (MA)".green);
cities.getPopulationByState('MA');
