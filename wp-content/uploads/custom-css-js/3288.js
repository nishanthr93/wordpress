<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 
jQuery(document).ready(function( $ ){
 // alert('hello');
  setTimeout(function(){ 
    //$('.imp-shape-container .imp-shape-highlighted[id="rect-5616"]').addClass('popmake-3289'); 
   /* $( '.imp-shape-container .imp-shape-highlighted[id="rect-5616"]' ).mouseover(function() {
   		 $(this).trigger('click');
  	});*/
    
    $('.imp-shape-container .imp-shape-highlighted[id="rect-5616"]').on('click',function(){
     $('.vimeoDisplay a').click();
    });
     $('.OpnePopup').on('click',function(){
       e.preventDefault();
       if($(this).data('pdf-src') != ''){
       		$('.openPDFLight a').attr('href',$(this).data('pdf-src'));
     		$('.openPDFLight a').click();
     	}
     	$('.YtbDsply a').click();
    });
     $('.OpenInPopUp').on('click',function(e){
       e.preventDefault();
       if($(this).data('src') != ''){
         	if($(this).data('view-type') == 'pdf'){
              	$('.openPDFLight a').attr('href',$(this).data('src'));
     			$('.openPDFLight a').click();
            }else if($(this).data('view-type') == 'video'){
                $('.YtbDsply a').attr('href',$(this).data('src'));
                $('.YtbDsply a').click();
            }
       		
     	}
     });
    
    
  }, 5000);
})
</script>
<!-- end Simple Custom CSS and JS -->
