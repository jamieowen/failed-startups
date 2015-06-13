var phantom = require('x-ray-phantom');

var Xray = require('x-ray');
var x = Xray().driver(phantom());

x('https://dribbble.com', 'li.group', [{
  title: '.dribbble-img strong',
  image: '.dribbble-img [data-src]@data-src',
}])
  .paginate('.next_page@href')
  .limit(3)
  .write('results.json')