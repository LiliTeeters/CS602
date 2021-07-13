const cities = require('./zipCodeModule_v1');
const colors = require('colors');




console.log("\nLook up zip code (02215)");
console.log(cities.lookupByZipCode('02215'));

console.log("\nLook up zip code (99999)");
console.log(cities.lookupByZipCode('99999'));

console.log("\nLook up by city (BOSTON, MA)");
console.log(cities.lookupByCityState("BOSTON", "MA"));

console.log("\nLook up by city (BOSTON, TX)");
console.log(cities.lookupByCityState("BOSTON", "TX"));

console.log("\nLook up by state (MA)");
console.log(cities.getPopulationByState('MA'));

console.log("\nLook up by state (TX)");
console.log(cities.getPopulationByState('TX'));

console.log("\nLook up by state (AA)");
console.log(cities.getPopulationByState('AA'));