
var request  = require( 'request' );
var natural  = require( 'natural' );
var cheerio  = require( 'cheerio' );
var unfluff  = require( 'unfluff' );
var minimist = require( 'minimist' );
var glob     = require( 'glob' );

var fs 		 = require( 'fs' );
var path 	 = require( 'path' );


var argv = minimist( process.argv.slice(2) );

// Fetch Contents.

var fetchContent = function(){

	if( argv.fetch ){

		console.log( 'Fetching Content..' );
		var linkUrl = 'http://autopsy.io';	

		request( linkUrl, function( err, res, body ){
			if( !err && res.statusCode === 200 ){
				
				var $ = cheerio.load( body );

				// fetch all links.

				var links = $( 'td.s12, td.s18' ).find( 'a' ).map( function( idx, ele ){
					return $( ele ).attr( 'href' );
				}).get();

				var contentFolder = path.join( '.','content' );

				if( !fs.existsSync( contentFolder ) ){
					fs.mkdirSync( contentFolder );
				}

				// fetch http content
				var next = function(){				
					if( links.length === 0 ){
						end(); 
						return;
					}

					var link = links.shift();
					var filename = link.replace( /http(s)?:\/\//ig, '' )
					filename = filename.replace( /\//ig, '_^_' )
					var filePath = path.join( contentFolder, filename );

					if( !fs.existsSync( filePath ) ){
						console.log( 'Writing : ', filePath );
						request.get( link )
						.on( 'response', function( res ){
							next();
						})
						.on( 'error', function( err ){
							console.log( '(ERROR) Fetching ' + link );
						})
						.pipe( fs.createWriteStream( filePath ) );
					}else{
						console.log( 'Exists : ', filePath );
						next();
					}
					
				}

				var end = function(){
					nextCommand();
				}

				next();

			}
		});
	}else{
		nextCommand();
	}

}

// Unfluff Contents.

var unfluffContent = function(){

	if( argv.unfluff ){

		console.log( 'Unfluff Contents' );

		var unfluffedFolder = path.join( '.','unfluffed' );

		if( !fs.existsSync( unfluffedFolder ) ){
			fs.mkdirSync( unfluffedFolder );
		}

		glob( 'content/*', function(err, files){
			console.log( 'globbed', files.length );
			if( !err ){

				var next = function(){
					if( files.length > 0 ){

						var file = files.shift();

						var unfluffedFile = path.join( unfluffedFolder, path.basename(file) + '.json' );

						if( !fs.existsSync(unfluffedFile) ){
							fs.readFile( file, {encoding:'utf-8'}, function( err, content ){

								var unfluffed = unfluff( content, 'en' );	
								fs.writeFileSync( unfluffedFile, JSON.stringify( unfluffed ), { encoding:'utf-8' } );

								console.log( 'Unfluffed ', unfluffedFile );

								next();
							} );
							
						}else{
							next();
						}

					}else{	
						end();
					}
				}

				var end = function(){
					console.log( 'Unfluffed..' );
					nextCommand();
				}

				next();

			}else{
				console.log( 'Glob error' );
				nextCommand();
			}
		});

		

	}else{
		nextCommand();
	}

};


// Iterate over commands.

var commands = [ fetchContent, unfluffContent ];

var nextCommand = function(){
	if( commands.length > 0 ){
		var command = commands.shift();
		command();		
	}else{
		console.log( 'DONE.' );
	}
}

nextCommand();




