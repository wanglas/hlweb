jQuery(document).ready(function(){	
	/* An object with element selectors and margin values */
	var buttonMargins = {
		'#step1 a.button'	: '-100%',
		'#step2 a.finish'	: '-200%',
		'#step2 a.back'		: 0,
		'#step3 a.again'	: 0
	}
	
	var b = jQuery('#step_animate');
	// Adding a click event listener to
	// every element in the object:
	jQuery.each(buttonMargins,function(key,val){
		jQuery(key).click(function(){
			b.animate({marginLeft:val});
			return false;
		});
	});
	
	// An additional click handler for the finish button:
	
	jQuery('#step2 a.finish').click(function(){	
		var resultsDiv = jQuery('#step3 .results');
		
		// Catching the errors with a try / catch statement:
		
		try{
			
			resultsDiv.empty();
			
			var	contestants = parseCSV(jQuery('#step1 textarea').val(),'contestants'),
				prizes		= parseCSV(jQuery('#step2 textarea').val(),'prizes'),
				allPrizes	= [];

			// The second element of the prizes CSV is
			// the number of copies of the prize

			jQuery.each(prizes, function(){
				for(var i=0;i<this.col2;i++){
					
					// The allPrizes array contains
					// one entry for each prize.
					
					allPrizes.push(this.col1);
				}
			});
			
			if(allPrizes.length > contestants.length){
				throw 'There are more prizes than contestants!';
			}

			// Randomizing both the contestants and the prizes:
			
			contestants = contestants.shuffle();
			allPrizes	= allPrizes.shuffle();
			
			// Using Gravatar
			//var gravatarURL = 	'http://www.gravatar.com/avatar/-REPLACE-?size=50&default='+
		//						encodeURIComponent('http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?size=50');
			
			// Generating the markup:
			/*for(var i=0;i<allPrizes.length;i++){
				var result = jQuery('<div>',{className:'result'});
				
				// Using a pure JavaScript md5 implementation to generate the hash
				// of the email so we can fetch the avatar from Gravatar:
				
				result.append(jQuery('<img>',{
					src	: gravatarURL.replace('-REPLACE-',md5(contestants[i].col2.toLowerCase()))
				}));
				
				result.append(jQuery('<p>',{
					className	: 'info',
					title		: contestants[i].col1 + ', ' +contestants[i].col2,
					html		: contestants[i].col1 + '<i>'+allPrizes[i]+'</i>'
				}));
				
				resultsDiv.append(result);
			}*/
						
		}
		catch (e){
			// Dispaly the error message:
			resultsDiv.append(jQuery('<p>',{className:'error',html:e}));
		}
	});
	
	
	function parseCSV(str, name){
		
		// A simple function for parsing CSV formatted text
		
		var arr = str.split('\n');
		
		if(!arr.length){
			throw 'The '+name+' list cannot be empty!';
		}
		
		var tmp = [];
		var retArr = [];
		
		for(var i=0;i<arr.length;i++){
			
			if(!arr[i]) continue;
			
			tmp = arr[i].split(',');
			
			if(tmp.length!=2){
				throw 'The '+name+' list is malformed!';
			}
			
			retArr.push({
				col1 : jQuery.trim(tmp[0]),
				col2 : jQuery.trim(tmp[1])
			})
		}
		
		return retArr;
	}
	
	// A method for returning a randomized array:
	Array.prototype.shuffle = function(deep){
		var i = this.length, j, t;
		while(i) {
			j = Math.floor((i--) * Math.random());
			t = deep && typeof this[i].shuffle!=='undefined' ? this[i].shuffle() : this[i];
			this[i] = this[j];
			this[j] = t;
		}
		return this;
	};

});
