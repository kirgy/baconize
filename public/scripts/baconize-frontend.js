	$(document).ready(function() {
		if(isFlashEnabled()) {
			var clip = new ZeroClipboard($("#bacon_url, .bacon-url-copy"), {
				moviePath: "/scripts/zeroclipboard-2.2.0/ZeroClipboard.swf"
			});     
		}

	// set timeout var to allow global scope of unsetting
		var successBannerTimeout;

	// Interaction functions
		$('#bacon_url').click(function() {
			$('#bacon_url').select();
		});

		if(isFlashEnabled()){
			$('.bacon-url-copy').click(function() {
				$('#global-zeroclipboard-html-bridge').remove();
				clearTimeout(successBannerTimeout);
				$('.message').text('Copied! Now your Baconized URL is on your clipboard...sexy.');
				setTimeout(function(){
					$('.message').animate({ height: 0, opacity: 0 }, 800);
				}, 5000);
			});
		}

		if(isFlashEnabled()){
			// sets flash to true in form
			$('.flash_check').val(1);
		}

		$(window).resize(function() {
			autoSetHeight('#bacon_url');
		});

	// Animations
		$('.message').slideDown( 800, function() {
				successBannerTimeout = setTimeout(function(){
					$('.message').animate({ height: 0, opacity: 0 }, 800);
				}, 5000);
				$("#bacon_url").select();
		});

	// helper functions
		function autoSetHeight(a) {
			console.log("setting height");
		    var iOriginalHeight = $(a).height();
		    $(a).height(0);
		    var scrollval = $(a)[0].scrollHeight;
		    $(a).height(scrollval-30);
		    if (parseInt(iOriginalHeight) > $(window).height()) {
		        if(j==0){
		            max=a.selectionEnd;
		        }
		        j++;
		        var i =a.selectionEnd;
		        console.log(i);
		        if(i >=max){
		            $(document).scrollTop(parseInt(a.style.height));
		        }else{
		            $(document).scrollTop(0);
		        }
		    }
		}
	
		//checks if flash is installed/enabled on the browser
		function isFlashEnabled()
		{
			var hasFlash = false;
			try
			{
				var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
				if(fo) hasFlash = true;
			}
			catch(e)
			{
				if(navigator.mimeTypes ["application/x-shockwave-flash"] != undefined) hasFlash = true;
			}
			return hasFlash;
		}

		autoSetHeight('#bacon_url');
	});



